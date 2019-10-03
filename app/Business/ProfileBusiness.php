<?php

namespace App\Business;

use App\Profile;
use Illuminate\Support\Facades\Log;

class ProfileBusiness{

    public function create($name){
        $profile = new Profile;
        $profile->name = $name;
        return $profile->create($profile->toArray());
    }
}