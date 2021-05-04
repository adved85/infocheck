<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;
use App\Poster;
use App\Lang;
use App\Event;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function index($locale){
        $no_post=true;
        $main_post=null;
        $lng=Lang::where('status',1)->get();
        $lang_id=Lang::getLangId($locale);
        $calendar= Event::event($locale);
        $cat=[];
        $cat_name=[];
        $posts_by_menu=array();
        $category=Category::get_category($lang_id);
        if (!count($category)){
            return view('errors.' . 'error');

        }
        else{

           // return $category;
        foreach($category as $item){
            array_push($cat,$item->id);
        }
        foreach($category as $item){
            array_push($cat_name,$item->name);
        }

        foreach($category as $item){
            $id=$item->id;
            $post=Post::with('getCategory')->where('category_id',$item->id)->where('lang_id',$lang_id)->where('status','published')->orderBy('date', 'desc')->limit(4)->get();
            array_push($posts_by_menu,array($id=>$post,"name"=>$item->name, "layout"=>$item->layout));
        }

        $main_poster_layout=Poster::get_poster_layout();
        $main_post_big = Post::with('getCategory')->where('status','main')->where('lang_id',$lang_id)->get();
        $main_post_small = Post::with('getCategory')->where('status','published')->where('lang_id',$lang_id)->orderBy('date', 'desc')->limit(4)->get();
        if (Post::with('getCategory')->where('status','main')->where('lang_id',$lang_id)->first() !== null){
            $main_post= $main_post_big[0];
        }

        if ($main_post === null && count($post)===0 ){
            $no_post = false;
        }

        $data = array(
            'menu' => $category,
            'posts_by_menu'=>$posts_by_menu,
            'layout'=>$main_poster_layout[0]->layout,
            'id'=>$cat,
            'big_post'=>$main_post,
            'small_post'=>$main_post_small,
            'lng'=>$lng,
            "event"=> $calendar,
            'item_id'=>null,
            'no_post'=>$no_post

            );
           // return $data['small_post'][0]->title;
            return view('index',compact('data'));
        }



    }
    public function error($locale){



            $data = array('call' => '404', );

                return response()->view('errors.' . 'error', compact('data'), 404);




    }


}
