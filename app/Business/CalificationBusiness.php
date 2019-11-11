<?php

namespace App\Business;

use App\Calification;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CalificationBusiness{

    public function getByIdCostumerAndChef($id_costumer, $id_chef){
        return Calification::where('id_costumer', $id_costumer)->where('id_chef',$id_chef)->first();
    }

    public function getByChef($id_chef){
        return Calification::where('id_chef', $id_chef)->with('category')->with('costumer')->get();
    }

    public function create($calification){
        if($calification->id != null){
            return $calification->save();
        }
        return $calification->create($calification->toArray());
    }

    public function buildCalification(Request $request){
        
        $idChef = $request->input('id_chef');
        $idCostumer = $request->input('id_costumer');
        $calification = $this->getByIdCostumerAndChef($idCostumer, $idChef);

        if($calification == null){
            $calification = new Calification;            
        }

        $calification->category = $request->input('category');
        $calification->id_costumer = $idCostumer;
        $calification->id_chef = $idChef;
        $calification->commentary = $request->input('commentary');
        $calification->date_calification = date('Y-m-d');
        return $calification;
    }

    public function validate($calification){
        if(ValidatorUtil::isBlank($calification->category)){
            throw new \Exception('No se especifica la categoría de la calificación');
        }

        if(ValidatorUtil::isBlank($calification->id_costumer)){
            throw new \Exception('Falta el cliente');
        }

        if(ValidatorUtil::isBlank($calification->id_chef)){
            throw new \Exception('Chef no especificado');
        }
    }

}