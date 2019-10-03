<?php

namespace App\Http\Controllers;

use App\Business\FoodDishBusiness;
use App\FoodDish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodDishController extends Controller
{

    private $business;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->business = new FoodDishBusiness;
    }

    public function create(Request $request){
        try{
            $foodDish = $this->buildFoodDish($request);
            $foodDish = $this->business->create($foodDish);
            return response()->json(['id'=>1,'msg'=>'Plato creado','foodDish'=>$foodDish],201);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request){
        try{
            $data = [
                'id_category' => $request['id_category'],
                'id_state' => $request['id_state'],
                'image_url' => $request['image_url'],
                'name' => $request['name'],
                'description' => $request['description']
            ];
            $foodDish = $this->business->update($request['id'], $data);
            return response()->json(['id'=>1,'msg'=>'Plato Actualizado','foodDish'=>$foodDish],201);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function delete($id){
        try{
            $foodDish = $this->business->delete($id);
            return response()->json(['id'=>1,'msg'=>'Plato Eliminado'],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function getFoodDishById($id){
        try{
            $foodDish = $this->business->getById($id);
            return response()->json(['id'=>1,'data'=>$foodDish],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function list(Request $request){
        try{
            $foodDishes = $this->business->getFoodDishes();
            return response()->json(['id'=>1,'data'=>$foodDishes],200);
        }
        catch(\Exception $e){
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
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
}
