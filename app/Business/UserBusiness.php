<?php

namespace App\Business;

use App\User;
use App\Profile;
use App\Utils\ValidatorUtil;

class UserBusiness{

    public function getAll(){
        return User::with('state')->with('profile')->get();
    }

    public function getById($id){
        return User::with('state')->with('profile')->find($id);
    }

    public function getByMail($mail){
        return User::where('mail', $mail)->first();
    }

    public function create($user){
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

        if(ValidatorUtil::isBlank($user->image_url)){
            $user->image_url = 'def.png';
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