<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\Lang;
use Calendar;
use App;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;


class Event extends Model
{
    protected $fillable = ['title','start_date','end_date', 'lang_id'];

    static function event($locale) {
        $lng=Lang::getLangId($locale);



        $events = [];
        // $data = Event::all();
        //  return  $data;
        $data = DB::table("events")->where('lang_id','=',$lng)->get();


        if($data->count()) {

            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                       'url' => url(app()->getLocale().'/archieves/'.$value->start_date),
                    ]
                );
            }
        }
        return   $calendar = Calendar::addEvents($events);

    }

    static function checkAndSaveIfNotExists($date, $lang_id) {
        // $event = Event::where('start_date','=', $date)->get();
        $event = Event::where('lang_id','=', $lang_id)->where('start_date','=', $date)->get();
        if(count($event) == 0) {
            Event::on('mysql_admin')->create(['start_date' => $date, 'end_date' => $date, 'lang_id' => $lang_id]);
        }
    }

    static function dateHasOtherEvents($date, $lang_id) {
        // '2018-11-10'

        $ps = DB::table('posts')->select('id')->whereDate('date', $date)->where('lang_id', '=', $lang_id)->where('status', '<>', 'unpublished')->get();
        if(count($ps) > 0) {
            // 'dont touch Event-date <br>';
            return true;
        }else{
            // 'let delete Event-date <br>';
            return false;
        }
    }

    static function checkAndDeleteEventDate($date, $lang_id) {
        $events = Event::where('lang_id','=', $lang_id)->where('start_date','=', $date)->get(); // all collected into array
        $event = Event::where('lang_id','=', $lang_id)->where('start_date','=', $date)->first(); // first elem of collection
        if(count($events) > 0) {
            // return $event;
            if(!self::dateHasOtherEvents($date, $lang_id)) {
                Event::on('mysql_admin')->find($event->id)->delete();
            }
        }
    }



}
