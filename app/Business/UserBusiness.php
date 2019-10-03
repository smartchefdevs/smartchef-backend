<?php

namespace App\Business;

use App\User;
use App\Utils\ValidatorUtil;

class UserBusiness{

    public function getById($id){
            return User::find($id);
    }

    public function getByMail($mail){
            return User::where('mail', $mail)->first();
    }

    public function create($user){
        $this->validate($user);
        $user->pass = $this->encryptPass($user->pass);
        return $user->create($user->toArray());
    }

    public function validate($user){
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
    }

    public function encryptPass($pass){
        return hash('sha256',md5($pass));
    }
}