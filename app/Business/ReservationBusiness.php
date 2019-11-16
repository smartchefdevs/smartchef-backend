<?php

namespace App\Business;

use App\EventReservation;
use Illuminate\Http\Request;
use App\Utils\ValidatorUtil;

class ReservationBusiness{

    public function getById($id){
        return EventReservation::where('id',$id)->with('event')
                                ->with('state')->with('costumer')->first();
    }

    public function getByCostumer($id_costumer){
        return EventReservation::where('id_costumer',$id_costumer)->with('event')
                                ->with('state')->with('costumer')->orderBy('date_reservation','asc')->get();
    }

    public function getByChef($id_chef){
        return EventReservation::whereHas('event', function($query) use ($id_chef){
                                    $query->where('event.id_chef', $id_chef);
                                })->with('event')
                                ->with('state')->with('costumer')->orderBy('date_reservation','asc')->get();
    }

    public function create($reservation){
        $reservation->id_state = 1;
        return $reservation->create($reservation->toArray());
    }

    public function buildReservation(Request $request){
        $id = $request->input("id");
        $reservation = new EventReservation;
        if(!ValidatorUtil::isBlank($id)){
            $reservation = $this->getById($id);
        }

        $reservation->id_event = $request->input('id_event');
        $reservation->id_costumer = $request->input('id_costumer');
        $reservation->date_reservation = $request->input('date');

        return $reservation;
    }

    public function validate($reservation){

        if(ValidatorUtil::isBlank($reservation->id_event)){
            throw new \Exception('Evento no seleccionado');
        }

        if(ValidatorUtil::isBlank($reservation->id_costumer)){
            throw new \Exception('Cliente no seleccionado');
        }

        if(ValidatorUtil::isBlank($reservation->date_reservation)){
            throw new \Exception('Fecha de reserva no especificada');
        }

    }
}