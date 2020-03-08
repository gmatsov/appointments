<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $fillable = [
        'date', 'first_name', 'last_name', 'egn', 'description'
    ];

    public static function addAppointment($data)
    {
        $date = date("Y-m-d H:i", strtotime($data['date'] . ' ' . $data['time']));
        Book::insert([
            'date' => $date,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'egn' => $data['egn'],
            'description' => $data['description'],
        ]);
    }

    public static function updateAppointment($data)
    {
        $date = date("Y-m-d H:i", strtotime($data->date . ' ' . $data->time));

        DB::update('UPDATE books
                    SET
                    date = "' . $date . '",
                    first_name = "' . $data->first_name . '",
                    last_name = "' . $data->last_name . '",
                    egn = "' . $data->egn . '",
                    description="' . $data->description . '"
                    WHERE  id ="'.$data->id.'"');
    }

    public static function otherClientAppointments($first_name, $last_name, $id)
    {
        return DB::select("SELECT id, date, first_name, last_name, egn, description
                                                        FROM books
                                                        WHERE first_name ='" . $first_name . "'
                                                        AND last_name = '" . $last_name . "'
                                                        AND date > now()
                                                        AND id != '" . $id . "'");

    }
}
