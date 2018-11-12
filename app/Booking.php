<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Booking;

class Booking extends Model
{
    protected $fillable = [
        'booking_id', 'customer_id', 'type_service', 'date_booking', 'duration', 'type_property', 'clean_area', 'package', 'total_visitor', 'type_event', 'message', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

     public static function getNextBookNumber()
    {
        // Get the last created order
        $lastnumber = Booking::orderBy('created_at', 'desc')->first();

        if ( ! $lastnumber)
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.

            $number = 0;
        else 
            $number = substr($lastnumber->booking_id, 3);

        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
 
        return 'MM' . sprintf('%06d', intval($number) + 1);
    }
}
