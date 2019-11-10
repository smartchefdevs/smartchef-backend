<?php

namespace App\Utils;

class ImageCreator{

    public static function createImage($path,$imageName,
                                        $type,$base64){
        file_put_contents($path.$imageName.".".$type,
                            base64_decode($base64));
    }

    public static function deleteImage($path,$imageName){
        unlink($path.$imageName);
    }

    public static function generateRandomStr(){
        return str_random(30);
    }
}