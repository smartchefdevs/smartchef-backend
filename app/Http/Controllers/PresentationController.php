<?php

namespace App\Http\Controllers;

use App\Business\UserBusiness;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function presentation(){
        return response()->json(['project'=>'SmartChef',
            'organization'=>'SUUB',
            'framework'=>'Laravel Lumen 5.8'],200);
    }
}