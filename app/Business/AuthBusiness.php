<?php

namespace App\Business;

use App\User;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;
use App\Business\UserBusiness;
use Illuminate\Http\Request;

class AuthBusiness
{
    private $userBusiness;

    public function __construct(){
        $this->userBusiness = new UserBusiness;
    }

    public function validateAdmin($user, Request $request){
        $this->validate($user, $request);
        
        if($user->profile->id != 1){
            throw new \Exception("El usuario no es administrador");    
        }
    }

    public function validateChef($user, Request $request){
        $this->validate($user, $request);
        
        if($user->profile->id != 2){
            throw new \Exception("El usuario no es chef");    
        }
    }

    public function validateCostumer($user, Request $request){
        $this->validate($user, $request);
        
        if($user->profile->id != 3){
            throw new \Exception("El usuario no es cliente");    
        }
    }

    public function validate($user, Request $request){
        if($user == null){
            throw new \Exception("No existe el usuario ".$request->input('mail')); 
        }
        
        if($user->pass != $this->userBusiness->encryptPass($request->input('pass'))){
            throw new \Exception("Contraseña incorrecta");     
        }
        
        if($user->state->id != 1){
            throw new \Exception("El usuario no se encuentra activo");    
        }
    }
}
