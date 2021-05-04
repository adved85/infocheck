<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use App\Post;
use App\Lang;
use App\Tag;
use DateTime;

class ArchievesController extends Controller
{
    function validateDate($date, $format = 'Y-m-d')    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function openArchieve($locale,$date)
    { $lng=Lang::where('status',1)->get();
            $lang_id=Lang::getLangId($locale);
            $calendar= Event::event($locale);
            $posts_archieve= Post::get_archieve($date,$lang_id);
            $category=Category::get_category($lang_id);
            if (!count($category)||!ArchievesController::validateDate($date)){
                return view('errors.' . 'error');

            }
            else{
                if(count($posts_archieve)>0){
                    $not_found = 'found';
                }
                else{
                    $not_found = trans('text.error_page_text');

                }


                $load_all_tags=Tag::load_all_tags($lang_id);
                $most_viewed=Post::where('lang_id',$lang_id)->orderBy('view','desc')->where('status','published')->limit(5)->get();


          //return $posts_archieve;
                $data = array(
                    'menu' => $category,
                    'load_all_tags'=> $load_all_tags,
                    'event'=> $calendar,
                    'posts_archieve'=>$posts_archieve,
                    'most_viewed'=>$most_viewed,
                    'date'=>$date,
                    'lng'=>$lng,
                    'call'=>'archieve',
                    'not_found'=>$not_found

                    );
                    return view('archieve',compact('data'));

            }

        }

}
