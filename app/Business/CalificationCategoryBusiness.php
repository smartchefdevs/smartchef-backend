<?php

namespace App\Business;

use App\CalificationCategory;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\DB;

class CalificationCategoryBusiness{

    public function getAll(){
        return CalificationCategory::all();
    } 

}