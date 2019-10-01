<?php

namespace App\Business;

use App\User;

class UserBusiness{

    public function create($user){
        try{
            $user->pass = hash('sha256',md5($user->pass));
            
            return $user->create($user->toArray());
        }catch(Exception $e){

        }
    }

}