<?php

namespace App\Business;

use App\FoodDishState;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;

class FoodDishStateBusiness{

    public function getById($id){
        try{
            $foodDishState = FoodDishState::find($id);
            return $foodDishState;
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function create($foodDishState){
        $this->validate($foodDishState);
        return $foodDishState->create($foodDishState->toArray());
    }

    public function update($id, $newData){
        $foodDishState = FoodDishState::findOrFail($id);
        $foodDishState->name = $newData['name'];
        $this->validate($foodDishState);
        $foodDishState->save();
        return $foodDishState;
    }

    public function delete($id){
        try{
            $foodDishState = FoodDishState::findOrFail($id)->delete();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function getFoodDishStates(){
        try{
            return FoodDishState::all();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function validate($foodDishState){
        if(ValidatorUtil::isBlank($foodDishState->name)){
            throw new \Exception('No se especifica el nombre');
        }
    }

}