<?php

namespace App\Http\Controllers;

use App\Service\ReportService;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    private $service;

    public function __construct(){
        $this->service = new ReportService;
    }

    public function userPerProfileCount(){
        try{
            return response()->json(['id'=>1,'data'=>$this->service->userPerProfileCount()],200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }
}