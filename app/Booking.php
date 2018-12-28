<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Booking;
use DB;
use Carbon\Carbon;

class Booking extends Model
{
    public $primaryKey = 'booking_id';
    protected $fillable = [
        'booking_id', 'customer_id', 'adminbook_id', 'customer_name', 'customer_hp', 'type_service', 'date_booking', 'duration', 'type_property', 'clean_area', 'package', 'total_visitor', 'type_event', 'message', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

     public static function getNextBookNumber()
    {
        // Get the last created order
        //$lastnumber = Booking::orderBy('created_at', 'desc')->first();
        
        $lastnumber = DB::table('bookings')->select('booking_id')->orderBy('created_at', 'desc')->value('booking_id');
        
        if ( ! $lastnumber)
            $number = 0;
        else 
            $number = substr($lastnumber, 3);

        // If we have MM000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
 
        return 'MM' . sprintf('%06d', intval($number) + 1);
    }

    public static function getColor($date_booking)
    {

        $carbon = Carbon::today();
        $colour = '';
        if($date_booking == $carbon->format('Y-m-d'))
        {
            $colour = '#d9b3ff';
        }

        else if($date_booking > $carbon->format('Y-m-d'))
        {
            $colour = '#8cd9b3';
        }

        else if($date_booking < $carbon->format('Y-m-d'))
        {
            $colour = '#ffbf80';
        }
       
       return $colour;
    }
}
