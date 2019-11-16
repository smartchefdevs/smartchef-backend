<?php

namespace App\Http\Controllers;

use App\Business\ReservationBusiness;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private $business; 

    public function __construct()
    {
        $this->business = new ReservationBusiness;
    }

    public function getById($id){
        try{
            return response()->json(['id'=>1,
                                'data'=>$this->business->getById($id)],200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }       
    }

    public function getByCostumer($id_costumer){
        try{
            return response()->json(['id'=>1,
                                'data'=>$this->business->getByCostumer($id_costumer)],200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }       
    }

    public function getByChef($id_chef){
        try{
            return response()->json(['id'=>1,
                                'data'=>$this->business->getByChef($id_chef)],200);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }     
    }

    public function create(Request $request){
        try{
            $reservation = $this->business->buildReservation($request);
            $this->business->validate($reservation);
            $reservation = $this->business->create($reservation);
            return response()->json(['id'=>1,'msg'=>'Reserva realizada con éxito'],201);
        } catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }       
    }
}
