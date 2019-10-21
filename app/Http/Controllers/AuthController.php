<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Business\UserBusiness;
use App\Business\AuthBusiness;

class AuthController extends Controller{

    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    /**
     * @var App\Business\UserBusiness
     */
    private $userBusiness;

    /**
     * @var App\Business\AuthBusiness
     */
    private $authBusiness;

    public function __construct(JWTAuth $jwt){
        $this->jwt = $jwt;
        $this->userBusiness = new UserBusiness;
        $this->authBusiness = new AuthBusiness;
    }

    public function loginAdmin(Request $request){
        try{
            $user = $this->userBusiness->getByMail($request->input('mail'));
            $this->authBusiness->validateAdmin($user, $request);
            return $this->login($request);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],401);
        }
    }

    public function loginChef(Request $request){
        try{
            $user = $this->userBusiness->getByMail($request->input('mail'));
            $this->authBusiness->validateChef($user, $request);
            return $this->login($request);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],401);
        }
    }

    public function loginCostumer(Request $request){
        try{
            $user = $this->userBusiness->getByMail($request->input('mail'));
            $this->authBusiness->validateCostumer($user, $request);
            return $this->login($request);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],401);
        }
    }

    public function login(Request $request){
        /** Validate inpits */
        $this->validate($request, [
            'mail' => 'required|email|max:255',
            'pass' => 'required',
        ]);

        try {
            /** Encrypt pass with your method */
            $pass=hash('sha256',md5($request->input('pass')));
            $data=[
                /** Column on DB mail */
                "mail"=>$request->input('mail'),
                /** Column on DB pass */
                "pass"=>$pass
            ];
            //return $data;
            if (! $token = $this->jwt->attempt($data)){
                return response()->json(['id'=>-1,'msg'=>'Credenciales incorrectas'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['id'=>-1,'msg'=>'token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['id'=>-1,'msg'=>'token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['id'=>-1,'msg'=>'Error fatal','token_absent' => $e->getMessage()], 500);

        }

        $usuario=$this->jwt->user();

        return response()->json(['id'=>1,'msg'=>'Login realizado con éxito',
                                'user'=>$usuario,'token'=>$token],200);
    }

	//*******Make Sure to use this on What you put on $request->auth, Normally toyu put Whole Token
	public function logout(Request $request){
        return response()->json(["id"=>1,"msg"=>$request->auth->invalidate()],201);
    }

    public function cleanBlacklist(Request $request){
        return response()->json(["id"=>1,"msg"=>$request->auth->blacklist()->clear()],200);
    }

    public function getClaims(Request $request){
        return response()->json(["id"=>1,"msg"=>$request->auth->payload()],200);
        //return response()->json(["id"=>1,"data"=>$request->auth->payload()->getClaims()->getByClaimName('exp')],200);
    }
}