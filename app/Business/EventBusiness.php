<?php

namespace App\Business;

use App\Event;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;

class EventBusiness{
    public function getById($id){
        try {
            $event = Event::with('state')->with('chef')->find($id);
            return $event;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create($event){
        $this->validate($event);
        return $event->create($event->toArray());
    }

    public function update($id, $newData){
        $event = $this->getById($id);
        $event->id_state = $newData['id_state'];
        $event->id_chef = $newData['id_chef'];
        $event->image_url = $newData['image_url'];
        $event->name = $newData['name'];
        $event->description = $newData['description'];
        $event->price = $newData['price'];
        $event->lat_addr = $newData['lat_addr'];
        $event->lon_addr = $newData['lon_addr'];
        $event->address = $newData['address'];
        $this->validate($event);
        $event->save();
        return $event;
    }

    public function delete($id){
        try {
            $event = Event::findOrFail($id)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getEvent(){
        try {
            return Event::all();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function validate($event){
        if(ValidatorUtil::isBlank($event->id_state)){
            throw new \Exception("No se especifica el estado");            
        }

        if(ValidatorUtil::isBlank($event->id_chef)){
            throw new \Exception("chef vacio");            
        }

        if(ValidatorUtil::isBlank($event->image_url)){
            throw new \Exception("image_url vacio");            
        }

        if(ValidatorUtil::isBlank($event->name)){
            throw new \Exception("name vacio");            
        }

        if(ValidatorUtil::isBlank($event->description)){
            throw new \Exception("description");            
        }

        if(ValidatorUtil::isBlank($event->price)){
            throw new \Exception("precio vacio");            
        }

        if(ValidatorUtil::isBlank($event->lat_addr)){
            throw new \Exception("lat_addr vacio");            
        }

        if(ValidatorUtil::isBlank($event->lon_addr)){
            throw new \Exception("lon_addr");            
        }

        if(ValidatorUtil::isBlank($event->address)){
            throw new \Exception("address vacio");            
        }
    }
}
