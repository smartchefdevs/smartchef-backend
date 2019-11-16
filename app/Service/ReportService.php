<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class ReportService{

    public static function userPerProfileCount(){
        $query = "SELECT profile.name AS profile, COUNT(id) AS count
                    FROM users, profile
                    WHERE users.id_profile = profile.id
                    GROUP BY profile.name";
        return DB::select($query);
    }

}