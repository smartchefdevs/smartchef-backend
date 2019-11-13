<?php

namespace App\Business;

use App\FoodDish;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
            return FoodDish::with('category')->get();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function getFoodDishesByCategory($id_category){
        try{
            return FoodDish::where('id_category','=',$id_category)->get();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function buildFoodDish(Request $request){
        $foodDish = new FoodDish;
        $foodDish->id_category = $request->input('id_category'); //REQ
        $foodDish->id_state = $request->input('id_state');//REQ
        $foodDish->image_url = $request->input('image_url'); //REQ
        $foodDish->name = $request->input('name');//REQ
        $foodDish->description = $request->input('description'); //REQ
        return $foodDish;
    }

    public function validate($foodDish){
        if(ValidatorUtil::isBlank($foodDish->id_category)){
            throw new \Exception('No se especifica la categoría');
        }

        if(ValidatorUtil::isBlank($foodDish->id_state)){
            throw new \Exception('Estado vacío');
        }

        if(ValidatorUtil::isBlank($foodDish->name)){
            throw new \Exception('Nombre vacío');
        }

        if(ValidatorUtil::isBlank($foodDish->description)){
            throw new \Exception('Descripción vacía');
        }

        if(ValidatorUtil::isBlank($foodDish->image_url)){
            $foodDish->image_url = 'def.png';
        }
    }

}