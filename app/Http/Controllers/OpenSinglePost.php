<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Lang;
use App\Tag;
use App\Document;
use App\Comment;
use App\User;
use App\Event;
use App\Lightbox;
use DB;


class OpenSinglePost extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth' ]); //'verified'
    // }

    public function index($locale,$unique_id,$title){

        $lng=Lang::where('status',1)->get();
        $lang_id=Lang::getLangId($locale);
        $calendar= Event::event($locale);
        $category=Category::get_category($lang_id);
        $most_viewed=Post::where('lang_id',$lang_id)->orderBy('view','desc')->where('status','published')->limit(5)->get();
        $post=Post::where('lang_id',$lang_id)->where('unique_id',$unique_id)->where('status','<>','unpublished')->get();
        $pic=Lightbox::select('pic_link')->where('post_unique_id',$unique_id)->where('isused',1)->get();
        if (count($post)>0){
            $load_all_tags=Tag::load_all_tags($lang_id);
            $document=Document::with('documentable')->where('documentable_id',$post[0]->id)->where('isused',1)->get(); // $unique_id
            $id=$post[0]->id;
            $cat_id=$post[0]->category_id;
            $link=Category::with('category_name')->where('id',$cat_id)->get();
            $view= Post::update_view_count($id);

            $post_tags = Post::find($id)->tagArray;
            $the_same_posts = Tag::the_same_posts($id,'Post','posts',$lang_id);

           // return  $the_same_posts['posts'];
            $comments=Comment::getComments($id);



    // return $pic;
            $data = array(
                'menu' => $category,
                'post'=>$post,
                'most_viewed'=>$most_viewed,
                'load_all_tags'=> $load_all_tags,
                'docs'=>$document,
                'post_tags'=>$post_tags,
                'comments'=>$comments,
                'id'=>$id,
                'lng'=> $lng,
                "event"=> $calendar,
                "the_same_posts"=>$the_same_posts['posts'],
                'call'=>'single',
                'unique_id'=>$unique_id,
                'title'=>$title,
                'breadcrumb'=>$link[0],
                'pic'=>$pic


                );
                return view( 'single_post' ,compact('data'));


        }
        else{
           return redirect(app()->getLocale());
        }

    }

    public function add_comment(Request $request, $locale, $id) {

        $lang_id=Lang::getLangId($locale);
        if($request->textarea !== null){
            $comment = new Comment();
            $comment->body = $request->textarea;
            $comment->approved = 0;
            $comment->post_id = $id;
            $comment->lang_id = $lang_id;
            $comment->user_id = $request->u_id;
            $comment->save();
            return redirect()->back()->with('warning_comment',trans('text.send_comment_ok'));;

        }
        else{
            return redirect()->back()->with('warning_comment',trans('text.send_comment_error'));
        }


    }
}
