<?php

namespace App\Utils;

class ValidatorUtil{

    public static function isBlank($str){
        if($str == null){
            return true;
        }
        if($str == ""){
            return true;
        }
    }
}