<?php

namespace App\Http\Controllers;

use App\Business\CategoryFoodBusiness;
use App\CategoryFood;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryFoodController extends Controller
{

    private $business;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->business = new CategoryFoodBusiness;
    }

    public function create(Request $request){
        try{
            $categoryFood = $this->buildFoodDish($request);
            $categoryFood = $this->business->create($categoryFood);
            return response()->json(['id'=>1,'msg'=>'Categoría Plato creado','foodDish'=>$categoryFood],201);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request){
        try{
            $data = [
                'name' => $request['name']
            ];
            $categoryFood = $this->business->update($request['id'], $data);
            return response()->json(['id'=>1,'msg'=>'Categoría Plato Actualizado','categoryFood'=>$categoryFood],201);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function delete($id){
        try{
            $categoryFood = $this->business->delete($id);
            return response()->json(['id'=>1,'msg'=>'Categoría Plato Eliminado'],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function getFoodDishStateById($id){
        try{
            $categoryFood = $this->business->getById($id);
            return response()->json(['id'=>1,'data'=>$categoryFood],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function list(Request $request){
        try{
            $categoryFood = $this->business->getCategoryFoods();
            return response()->json(['id'=>1,'data'=>$categoryFood],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function buildFoodDish(Request $request){
        $categoryFood = new CategoryFood;
        $categoryFood->name = $request->input('name'); //REQ
        return $categoryFood;
    }
}
