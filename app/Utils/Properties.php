<?php

namespace App\Utils;

class Properties{

    public static function getImagePath(){
        return base_path('public')."/storage/imgs/";
    }

    public static function getImageUserPath(){
        return Properties::getImagePath()."user/";
    }

    public static function getImageEventPath(){
        return Properties::getImagePath()."event/";
    }

    public static function getImageFoodPath(){
        return Properties::getImagePath()."food/";
    }
}