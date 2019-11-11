<?php

namespace App\Http\Controllers;

use App\Business\EventBusiness;
use App\Business\FoodDishBusiness;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $business;
    private $businessDish;

    public function __construct()
    {
        $this->business = new EventBusiness;
        $this->businessDish = new FoodDishBusiness;
    }

    public function create(Request $request){
        try {
            $event = $this->buildEvent($request);
            $event = $this->business->create($event);
            return response()->json(['id'=>1,'msg'=>'Evento creado','event'=>$event],201);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function addFoodDish(Request $request){
        try {
            $foodDish = $this->businessDish->buildFoodDish($request);
            $this->businessDish->validate($foodDish);
            $foodDish = $this->businessDish->create($foodDish);
            $this->business->addFoodDish($request->input('id_event'),$foodDish);
            return response()->json(['id'=>1,'msg'=>'Plato agregado'],201);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request){
        try {
            $event = $this->buildEvent($request);
            $this->business->validate($event);
            $event = $this->business->update($event);
            return response()->json(['id'=>1,'msg'=>'evento actualizado','event'=>$event],201);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function delete($id){
        try {
            $event = $this->business->delete($id);
            return response()->json(['id'=>1,'msg'=>'Evento eliminado'],200);
        } catch (\Exception $e) {
            return response()->json(['id'=>1,'msg'=>$e->getMessage()],500);
        }
    }

    public function getEventById($id){
        try {
            $event = $this->business->getById($id);
            return response()->json(['id'=>1,'data'=>$event],200);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function list(Request $request){
        try {
            $event = $this->business->getEvent();
            return response()->json(['id'=>1,'data'=>$event],200);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function buildEvent(Request $request){
        $id = $request->input('id');
        $event = null;
        
        if($id != null || $id != ''){
            $event = $this->business->getById($id);
        } else {
            $event = new Event;
            $event->image_url = 'def.png';
            $event->id_chef = $request->input('id_chef');
        }
        
        if($request->input('id_state') == null){
            $event->id_state = 1;
        } else {
            $event->id_state = $request->input('id_state');
        }
        
        $event->name = $request->input('name');//REQ
        $event->description = $request->input('description'); //REQ
        $event->price = $request->input('price'); //REQ
        $event->lat_addr = $request->input('lat_addr'); //REQ
        $event->lon_addr = $request->input('lon_addr'); //REQ
        $event->address = $request->input('address'); //REQ
        return $event;
    }
}
