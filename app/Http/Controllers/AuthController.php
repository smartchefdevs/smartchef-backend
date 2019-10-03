<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Business\UserBusiness;

class AuthController extends Controller{

    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    /**
     * @var App\Business\UserBusiness
     */
    private $userBusiness;

    public function __construct(JWTAuth $jwt){
        $this->jwt = $jwt;
        $this->userBusiness = new UserBusiness;
    }

    public function loginAdmin(Request $request){
        $usuario = $this->userBusiness->getByMail($request->input('mail'));
        if($usuario == null){
            return response()->json(['id'=>-1,'msg'=>'El usuario no existe'],401);
        } else if($usuario->state->id != 1){
            return response()->json(['id'=>-1,'msg'=>'Usuario está bloqueado'],401);    
        } else if($usuario->profile->id != 1){
            return response()->json(['id'=>-1,'msg'=>'No eres administrador'],401);    
        }

        return $this->login($request);
    }

    public function loginChef(Request $request){
        $usuario = $this->userBusiness->getByMail($request->input('mail'));
        if($usuario == null){
            return response()->json(['id'=>-1,'msg'=>'El usuario no existe'],401);
        } else if($usuario->state->id != 1){
            return response()->json(['id'=>-1,'msg'=>'Usuario está bloqueado'],401);    
        } else if($usuario->profile->id != 2){
            return response()->json(['id'=>-1,'msg'=>'No eres un Chef'],401);    
        }

        return $this->login($request);
    }

    public function loginCostumer(Request $request){
        $usuario = $this->userBusiness->getByMail($request->input('mail'));
        if($usuario == null){
            return response()->json(['id'=>-1,'msg'=>'El usuario no existe'],401);
        } else if($usuario->state->id != 1){
            return response()->json(['id'=>-1,'msg'=>'Usuario está bloqueado'],401);    
        } else if($usuario->profile->id != 3){
            return response()->json(['id'=>-1,'msg'=>'No eres un Cliente'],401);    
        }

        return $this->login($request);
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