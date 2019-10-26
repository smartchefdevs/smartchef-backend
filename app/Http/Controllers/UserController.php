<?php

namespace App\Http\Controllers;

use App\Business\UserBusiness;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $business;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->business = new UserBusiness;
    }

    public function getById($id){
        return response()->json(['id'=>1,'msg'=>$this->business->getById($id)],200); 
    }

    public function getAll(){
        return response()->json(['id'=>1,'msg'=>$this->business->getAll()],200); 
    }

    public function updateState(Request $request){
        try{
            $user = $this->business->getById($request->input('id'));
            $this->business->updateState($user,$request->input('id_state'));
            return response()->json(['id'=>1,
                    'msg'=>'Estado cambiado'],200);
        }catch(Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function create(Request $request){
        try{
            $user = $this->buildUser($request);
            $user = $this->business->create($user);
            return response()->json(['id'=>1,'msg'=>'Usuario creado',
                                'user'=>$user],201);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request){
        try{
            $user = $this->buildUser($request);
            $this->business->update($user);
            return response()->json(['id'=>1,'msg'=>'Usuario actualizado'],201);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function updatePassword(Request $request){
        try{
            $user = $this->business->getById($request->input('id'));
            $this->business->updatePassword($user, $request->input('actualPass'),
                                            $request->input('newPass'));
            return response()->json(['id'=>1,'msg'=>'Contraseña actualizada'],201);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function buildUser(Request $request){
        $user = null;
        if($request->input('id') != null){
            $user = $this->business->getById($request->input('id'));
            
        } else {
            $user = new User;        
            $user->pass = $request->input('pass'); //REQ
        } 

        if($request->input('id_profile') != null){
            $user->id_profile = $request->input('id_profile');
        }
        
        $user->full_name = $request->input('full_name'); //REQ
        $user->mail = $request->input('mail'); //REQ
        $user->birthday = $request->input('birthday');
        $user->address = $request->input('address');

        return $user;
    }

    public function listProfiles(){
        try{
            $profiles = $this->business->listProfiles();
            return response()->json(['id'=>1,'msg'=>$profiles],200);
        }catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }
}
