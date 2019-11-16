<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PresentationController extends Controller
{
    public function presentation(){
        return response()->json(['project'=>'SmartChef',
            'organization'=>'SUUB',
            'framework'=>'Laravel Lumen 5.8'],200);
    }
}