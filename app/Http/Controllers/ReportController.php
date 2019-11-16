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

    public function userPerProfilePerStateCount($id_profile, $id_state){
        try{
            return response()->json(['id'=>1,
                                    'data'=>$this->service->userPerProfilePerStateCount($id_profile, $id_state)],
                                    200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function eventsCount(){
        try{
            return response()->json(['id'=>1,
                                    'data'=>$this->service->eventsCount()],
                                    200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function eventsPerChefCount(){
        try{
            return response()->json(['id'=>1,
                                    'data'=>$this->service->eventsPerChefCount()],
                                    200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }
}