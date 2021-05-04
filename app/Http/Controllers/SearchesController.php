<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App;
use App\Event;
use App\Tags;
use App\Lang;
use App\Category;
use App\Tag;



use DB;

class SearchesController extends Controller
{
	public function getIndex( Request $request,$locale) {
        $s = $request->query('s');

        Session::put('search', $s);
        Session::put('locale',$locale);
        $lng=Lang::where('status',1)->get();
            $lang_id=Lang::getLangId($locale);
            $calendar= Event::event($locale);
            $category=Category::get_category($lang_id);
            $load_all_tags=Tag::load_all_tags($lang_id);
            $most_viewed=Post::where('lang_id',$lang_id)->orderBy('view','desc')->limit(5)->get();
	// Query and paginate result
    $posts = DB::table('posts as p')
    ->select('p.*','l.lng')
     ->where('p.status','<>','not_published')
     ->where('p.title', 'like', "%$s%")
    ->orWhere('p.html_code', 'like', "%$s%")
    ->join('langs as l','p.lang_id','=','l.id')
    ->paginate(10);

   // return $posts;
            $data = array(
                'menu' => $category,
                'load_all_tags'=> $load_all_tags,
                'event'=> $calendar,
                'post'=>$posts,
                'most_viewed'=>$most_viewed,
                'call'=>'search',
                's' => $s,
                'lng'=>$lng


                );


                return view('search',compact('data'));

            }
 }
