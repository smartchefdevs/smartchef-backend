<?php

namespace App\Http\Controllers;

use App\Business\CalificationCategoryBusiness;

class CalificationCategoryController extends Controller
{
    private $business; 

    public function __construct()
    {
        $this->business = New CalificationCategoryBusiness;
    }

    public function getAll(){
        try{
            $categories = $this->business->getAll();
            return response()->json(['id'=>1,'msg'=>$categories],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }
}