<?php

namespace App\Business;

use App\CategoryFood;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;

class CategoryFoodBusiness{

    public function getById($id){
        try{
            $categoryFood = CategoryFood::find($id);
            return $categoryFood;
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function create($categoryFood){
        $this->validate($categoryFood);
        return $categoryFood->create($categoryFood->toArray());
    }

    public function update($id, $newData){
        $categoryFood = CategoryFood::findOrFail($id);
        $categoryFood->name = $newData['name'];
        $this->validate($categoryFood);
        $categoryFood->save();
        return $categoryFood;
    }

    public function delete($id){
        try{
            $foodDishState = CategoryFood::findOrFail($id)->delete();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function getCategoryFoods(){
        try{
            return CategoryFood::orderBy('name','asc')->get();
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