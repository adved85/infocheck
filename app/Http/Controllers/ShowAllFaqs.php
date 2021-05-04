<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Category;
use App\Post;
use App\Lang;
use App\Tag;
use App\Question;
use App\Answer;
use App\Event;
use DB;




class ShowAllFaqs extends Controller
{
    public function index($locale){
        $lng=Lang::where('status',1)->get();
        $lang_id=Lang::getLangId($locale);
        $calendar= Event::event($locale);
        $category=Category::get_category($lang_id);
        $load_all_tags=Tag::load_all_tags($lang_id);
        $most_viewed=Post::where('lang_id',$lang_id)->orderBy('view','desc')->limit(5)->get();
        $questions=Question::with('question')->with('user')->with('post')->with('lang')->where('visible',1)->paginate(6);




//return $questions;
        $data = array(
            'menu' => $category,
            'load_all_tags'=> $load_all_tags,
            'question'=>$questions,
            'most_viewed'=>$most_viewed,
            'lng'=>$lng,
            "event"=> $calendar,
            'item_id'=>null
            );
            return view('faqs',compact('data'));
    }


    public function leave_question(Request $request,$locale){

        $folder_name = $request->input('folder_name');
        $lang_id=Lang::getLangId($locale);
        $files = $_FILES['files'];
        //return $files;
        $text = $request->input('textarea');
        $u_id = $request->input('u_id');
       // return $u_id;
        $total = count($_FILES['files']['name']);
        $validFile = ['image/jpg','image/png','image/jpeg','image/pjpeg','image/bmp', 'image/gif', 'image/svg+xml',
        'application/vnd.ms-exce', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $notvalidFile = ["application/x-javascript", "application/sql", "application/x-php"];
        $flDebug = [];
        $errors = [];

        $last_id_array = DB::select("SELECT  AUTO_INCREMENT
                                FROM    information_schema.TABLES
                                WHERE   (TABLE_NAME = 'questions')");

        $last_id = $last_id_array[0]->AUTO_INCREMENT;

        for($i = 0; $i < $total; $i++) {
            if($_FILES['files']['tmp_name'][$i] != "") {
                if(!in_array($_FILES['files']['type'][$i], $notvalidFile) && in_array($_FILES['files']['type'][$i], $validFile) ) {

                    $flDebug['success'][$i]['url'] =  $_FILES['files']['tmp_name'][$i];
                    $flDebug['success'][$i]['name'] = $_FILES['files']['name'][$i];
                    $path = Storage::disk('public')->putFileAs($folder_name.'/'.$last_id, new File($_FILES['files']['tmp_name'][$i]), $_FILES['files']['name'][$i]);
                    $path2 = Storage::disk('upload')->putFileAs($folder_name.'/'.$last_id, new File($_FILES['files']['tmp_name'][$i]), $_FILES['files']['name'][$i]);
                    $flDebug['success'][$i]['path'] = Storage::url($path);
                    $flDebug['success'][$i]['size'] = $_FILES['files']['size'][$i];;
                }
                else{
                    $flDebug['errors'][$i]['message'] =  $_FILES['files']['name'][$i] . ' has not proper type! -> '.$_FILES['files']['type'][$i];
                }
            }
        }
        $question = new Question();
        $question->body =  $text;
        $question->visible = 0;
        $question->lang_id = $lang_id;
        $question->user_id = $u_id;
        $question->save();

       // return $flDebug;
if ($flDebug){
    $total1 = count($flDebug['success']);
    for($i = 0; $i < $total1; $i++) {
        $doc = new Document();
        $doc->name = $flDebug['success'][$i]['name'];
        $doc->link = '/storage/questions/'.$last_id.'/'.$flDebug['success'][$i]['name'];
        $doc->type = $type=Document::getTypeFromLink($flDebug['success'][$i]['path']);
        $doc->documentable_id = $last_id;
        $doc->documentable_type = Question::class;
        $doc->save();

    }

}

        //$type=Document::getTypeFromLink();


        $flDebug['success']='success';



//return $flDebug;
        return redirect()->back()->with('flDebug' , $flDebug);






    }
}
