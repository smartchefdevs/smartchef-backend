<?php

namespace App\Http\Controllers;

use App\Business\CalificationBusiness;
use Illuminate\Http\Request;

class CalificationController extends Controller
{
    private $business; 

    public function __construct()
    {
        $this->business = New CalificationBusiness;
    }

    public function getByChef($id_chef){
        try{
            $califications = $this->business->getByChef($id_chef);
            return response()->json(['id'=>1,'msg'=>$califications],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function create(Request $request){
        try{
            $calification = $this->business->buildCalification($request);
            $this->business->validate($calification);
            $calification = $this->business->create($calification);
            return response()->json(['id'=>1,'msg'=>'Calificación realizada',
                                        'data'=>$calification],201);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }
}