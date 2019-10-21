<?php

namespace App\Business;

use App\FoodDish;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;

class FoodDishBusiness{

    public function getById($id){
        try{
            $foodDish = FoodDish::with('category')->with('state')->find($id);
            return $foodDish;
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function create($foodDish){
        $this->validate($foodDish);
        return $foodDish->create($foodDish->toArray());
    }

    public function update($id, $newData){
        $foodDish = FoodDish::findOrFail($id);
        $foodDish->id_category = $newData['id_category'];
        $foodDish->id_state = $newData['id_state'];
        $foodDish->image_url = $newData['image_url'];
        $foodDish->name = $newData['name'];
        $foodDish->description = $newData['description'];
        $this->validate($foodDish);
        $foodDish->save();
        return $foodDish;
    }

    public function delete($id){
        try{
            $foodDish = FoodDish::findOrFail($id)->delete();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function getFoodDishes(){
        try{
            return FoodDish::all();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function validate($foodDish){
        if(ValidatorUtil::isBlank($foodDish->id_category)){
            throw new \Exception('No se especifica la categoría');
        }

        if(ValidatorUtil::isBlank($foodDish->id_state)){
            throw new \Exception('Estado vacío');
        }

        if(ValidatorUtil::isBlank($foodDish->image_url)){
            throw new \Exception('Correo vacío');
        }

        if(ValidatorUtil::isBlank($foodDish->name)){
            throw new \Exception('Nombre vacío');
        }

        if(ValidatorUtil::isBlank($foodDish->description)){
            throw new \Exception('Descripción vacía');
        }
    }

}