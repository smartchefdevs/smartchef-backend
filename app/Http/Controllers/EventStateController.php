<?php

namespace App\Http\Controllers;

use App\Business\EventStateBusiness;
use App\EventState;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventStateController extends Controller
{
    
    private $business;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->business = new EventStateBusiness;
    }

    public function create(Request $request){
        try {
            $eventState = $this->buildEvent($request);
            $eventState = $this->business->create($eventState);
            return response()->json(['id'=>1,'msg'=>'Estado evento creado','event'=>$eventState],201);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request){
        try {
            $data = [
                'name' => $request['name']
            ];
            $eventState = $this->business->update($request['id'], $data);
            return response()->json(['id'=>1,'msg'=>'Estado evento actualizado','event'=>$eventState],201);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function delete($id){
        try {
            $eventState = $this->business->delete($id);
            return response()->json(['id'=>1,'msg'=>'Estado evento eliminado'],200);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage()],500);
        }
    }

    public function getEventStateById($id){
        try {
            $eventState = $this->business->getById($id);
            return response()->json(['id'=>1,'data'=>$eventState],200);
        } catch (\Exception $e) {
            return response()->json(['id'=>1,'msg'=>$e->getMessage()],500);
        }
    }

    public function list(Request $request){
        try {
            $eventState = $this->business->getEventState();
            return response()->json(['id'=>1,'data'=>$eventState],200);
        } catch (\Exception $e) {
            return response()->json(['id'=>-1,'msg'=>$e->getMessage(),500]);
        }
    }

    public function buildEvent(Request $request){
        $eventState = new EventState;
        $eventState->name = $request->input('name');
        return $eventState;
    }
}
