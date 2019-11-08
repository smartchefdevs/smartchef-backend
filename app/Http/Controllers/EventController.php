<?php

namespace App\Http\Controllers;

use App\Business\EventBusiness;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $business;

    public function __construct()
    {
        $this->business = new EventBusiness;
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

    public function update(Request $request){
        try {
            $data = [
                'id_state' => $request->input('id_state'),
                'id_chef' => $request->input('id_chef'),
                'image_url' => $request->input('image_url'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'lat_addr' => $request->input('lat_addr'),
                'lon_addr' => $request->input('lon_addr'),
                'address' => $request->input('address')
            ];
            $event = $this->business->update($request->input('id'), $data);
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
        $event = new Event;
        $event->id_state = $request->input('id_state');//REQ
        $event->id_chef = $request->input('id_chef');//REQ
        $event->image_url = $request->input('image_url'); //REQ
        $event->name = $request->input('name');//REQ
        $event->description = $request->input('description'); //REQ
        $event->price = $request->input('price'); //REQ
        $event->lat_addr = $request->input('lat_addr'); //REQ
        $event->lon_addr = $request->input('lon_addr'); //REQ
        $event->address = $request->input('address'); //REQ
        return $event;
    }
}
