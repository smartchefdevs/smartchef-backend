<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class ReportService{

    public static function userPerProfileCount(){
        $query = "SELECT profile.name AS profile, COUNT(users.id) AS count
                    FROM users, profile
                    WHERE users.id_profile = profile.id
                    GROUP BY profile.name";
        return DB::select($query);
    }

    public static function userPerProfilePerStateCount($id_profile, $id_state){
        $query = "SELECT profile.name AS profile, user_state.name AS state, COUNT(users.id) AS count
                    FROM users, profile, user_state
                    WHERE users.id_profile = $id_profile
                    AND users.id_state = $id_state
                    AND users.id_profile = profile.id
                    AND users.id_state = user_state.id
                    GROUP BY profile.name, user_state.name";
        return DB::select($query);
    }

    public static function eventsCount(){
        $query = "SELECT COUNT(id) AS count
                    FROM event";
        return DB::select($query);
    }

    public static function eventsPerChefCount(){
        $query = "SELECT users.id AS chefId, users.full_name AS chefName, COUNT(event.id) AS count
                    FROM users, event
                    WHERE users.id_profile = 2
                    AND users.id = event.id_chef
                    GROUP BY users.id, users.full_name";
        return DB::select($query);
    }

}