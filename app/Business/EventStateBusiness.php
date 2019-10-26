<?php

namespace App\Business;

use App\EventState;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;

class EventStateBusiness 
{
    
    public function getById($id){
        try {
            $eventState = EventState::find($id);
            return $eventState;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, $newData){
        $eventState = EventState::findOrFail($id);
        $eventState->name = $newData['name'];
        $this->validate($eventState);
        $eventState->save();
        return $eventState;
    }

    public function delete($id){
        try {
            $eventState = EventState::findOrFail($id)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getEventState(){
        try {
            return EventState::all();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function validate($eventState){
        if(ValidatorUtil::isBlank($eventState->name)){
            throw new \Exception('No se especifica el nombre');
        }
    }
}
