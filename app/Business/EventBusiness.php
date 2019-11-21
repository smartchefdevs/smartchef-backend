<?php

namespace App\Business;

use App\Event;
use App\Utils\ValidatorUtil;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EventBusiness{

    public function getById($id){
        try {
            $event = Event::with('state')->with('chef')->with('dishes')->find($id);
            return $event;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getByChef($id_chef){
        try {
            $event = Event::where('id_chef',$id_chef)->with('state')
                        ->with('dishes')->get();
            return $event;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create($event){
        $this->validate($event);
        return $event->create($event->toArray());
    }

    public function update($event){
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
            return Event::with('chef')->with('dishes')->get();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addFoodDish($id,$foodDish){
        DB::insert('INSERT INTO food_dish_x_event(id_dish, id_event) VALUES(?,?)',[$foodDish->id,$id]);
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
