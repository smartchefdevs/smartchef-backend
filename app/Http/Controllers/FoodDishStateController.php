<?php

namespace App\Http\Controllers;

use App\Business\FoodDishStateBusiness;
use App\FoodDishState;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodDishStateController extends Controller
{

    private $business;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->business = new FoodDishStateBusiness;
    }

    public function create(Request $request){
        try{
            $foodDishState = $this->buildFoodDish($request);
            $foodDishState = $this->business->create($foodDishState);
            return response()->json(['id'=>1,'msg'=>'Estado Plato creado','foodDish'=>$foodDishState],201);
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
            $foodDishState = $this->business->update($request['id'], $data);
            return response()->json(['id'=>1,'msg'=>'Estado Plato Actualizado','foodDish'=>$foodDishState],201);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function delete($id){
        try{
            $foodDishState = $this->business->delete($id);
            return response()->json(['id'=>1,'msg'=>'Estado Plato Eliminado'],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function getFoodDishStateById($id){
        try{
            $foodDishState = $this->business->getById($id);
            return response()->json(['id'=>1,'data'=>$foodDishState],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function list(Request $request){
        try{
            $foodDishState = $this->business->getFoodDishStates();
            return response()->json(['id'=>1,'data'=>$foodDishState],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function buildFoodDish(Request $request){
        $foodDishState = new FoodDishState;
        $foodDishState->name = $request->input('name'); //REQ
        return $foodDishState;
    }
}
