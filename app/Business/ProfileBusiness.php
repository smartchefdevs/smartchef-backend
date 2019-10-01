<?php

namespace App\Business;

use App\Profile;
use Illuminate\Support\Facades\Log;

class ProfileBusiness{

    public function create($name){
        $profile = new Profile;
        $profile->name = $name;
        try{
            return $profile->create($profile->toArray());
        }catch(Exception $e){
            Log::error($e);
            return null;
        }
    }
}