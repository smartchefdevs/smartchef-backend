<?php

namespace App\Business;

use App\User;
use App\Profile;
use App\Utils\ValidatorUtil;
use Illuminate\Http\Request;

class UserBusiness{

    public function getAll(){
        return User::with('state')->with('profile')->get();
    }

    public function getById($id){
        return User::with('state')->with('profile')->with('events')->with('events.dishes')->find($id);
    }

    public function getByMail($mail){
        return User::where('mail', $mail)->first();
    }

    public function getByProfile($profile){
        return User::where('id_profile', $profile)->with('state')->with('profile')
                    ->with('events')->with('events.dishes')->orderBy('full_name','asc')->get();
    }

    public function create($user){
        $mail = $user->mail;
        if($this->getByMail($mail) != null){
            throw new \Exception('El usuario ya se encuentra registrado con el correo '.$mail);
        }
        $this->validate($user);
        $user->pass = $this->encryptPass($user->pass);
        return $user->create($user->toArray());
    }

    public function update($user){
        $this->validate($user);
        return $user->save();
    }

    public function updateState($user,$id_state){
        $user->id_state=$id_state;
        $user->save();
    }

    public function updatePassword($user,$actualPass,$newPass){
        if($user->pass != $this->encryptPass($actualPass)){
            throw new \Exception('Contraseña actual incorrecta');
        }

        $user->pass = $this->encryptPass($newPass);
        $user->save();
    }

    public function listProfiles(){
        return Profile::all();
    }

    public function buildUser(Request $request){
        $user = null;
        if($request->input('id') != null){
            $user = $this->getById($request->input('id'));
            
        } else {
            $user = new User;        
            $user->pass = $request->input('pass'); //REQ
        }
        
        $user->full_name = $request->input('full_name'); //REQ
        $user->mail = $request->input('mail'); //REQ
        $user->birthday = $request->input('birthday');
        $user->address = $request->input('address');
        $user->id_profile = $request->input('id_profile');
        $user->id_state = $request->input('id_state');
        
        return $user;
    }

    public function validate($user){
        if(ValidatorUtil::isBlank($user->id_profile)){
            throw new \Exception('No se especifica perfil');
        }

        if(ValidatorUtil::isBlank($user->full_name)){
            throw new \Exception('Nombre vacío');
        }

        if(ValidatorUtil::isBlank($user->mail)){
            throw new \Exception('Correo vacío');
        }

        if(ValidatorUtil::isBlank($user->pass)){
            throw new \Exception('Contraseña vacía');
        }

        if(ValidatorUtil::isBlank($user->id_state)){
            $user->id_state = 1;
        }

        if(ValidatorUtil::isBlank($user->image_url)){
            $user->image_url = 'def.png';
        }
    }

    public function encryptPass($pass){
        return hash('sha256',md5($pass));
    }
}