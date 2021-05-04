<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lang;
use App\Post;
use App\Event;
use App\Category;
use App\Document;
use App\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\User;

use App\Subscriber;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{

    protected $folder_name = 'posts';
    protected $validImageExp = ['jpg','png','jpeg','pjpeg','bmp', 'gif', 'svg'];
    /*  Admin-connection: mysql_admin */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post = Post::find(4);
        // dd($post->questions()->exists());

        $lang_id = Lang::getLangId(app()->getLocale());
        $posts = Post::where('lang_id', $lang_id)->with('getCategory', 'lang')->orderBy('id', 'desc')->paginate(10);
        // dd($posts);
        return view('admin.post.index', [
            'page_name' => 'posts',
            'langs' => Lang::all(),
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale, $q_id=0)
    {
        //return $q_id; // if q_id > 0 ; user wants to create post as an aswer for 'q_id'-question

        $max_unique_id = Post::max('unique_id');
        $next_unique_id = $max_unique_id + 1;


        $last_id_array = DB::select("SELECT  AUTO_INCREMENT
                                FROM    information_schema.TABLES
                                WHERE   (TABLE_NAME = 'posts')");

        $last_id = $last_id_array[0]->AUTO_INCREMENT;

        // second cycle, when after uploading files redirect back //
        $images = Storage::files('public/'.$this->folder_name.'/'.$next_unique_id); // this are images //
        $imageurls = [];
        for ($i=0; $i < count($images) ; $i++) {
            $imageurls[$i]['url'] = Storage::url($images[$i]);
            $imageurls[$i]['size'] = $size = Storage::size($images[$i]);
        }


        $lang_id = Lang::getLangId(app()->getLocale());
        $categories = Category::where('lang_id', $lang_id)->get();
        $allTags = Post::getTagsByLangId($lang_id);
        // return $allTags;

        if ($q_id > 0) {
            $question = Question::where('id', $q_id)->where('lang_id',$lang_id)->with('lang')->first();
            // return $question;
            if (!$question) {
                // return 'Can not find Question with ID='.$q_id.' and lang='.$locale.'<br>'.
                return view('admin.post.qnotfound',[
                    'page_name' => 'posts',
                    'langs'=>Lang::all(),
                    'q_id' =>  $q_id,
                    'locale' => $locale,
                ]);
            }
            elseif($question->questionable_id !== null){
                // return 'Question with ID='.$q_id.' and lang='.$locale.' alerady Replied <br>'.
                return view('admin.post.qreplied',[
                    'page_name' => 'posts',
                    'langs'=>Lang::all(),
                    'q_id' =>  $q_id,
                    'locale' => $locale,
                ]);
            }

        }


        return view('admin.post.create', [

            'page_name' => 'posts',
            'langs' => Lang::all(),
            'lang_id' => $lang_id,
            'next_unique_id' => $next_unique_id,
            'last_id' => $last_id, // only for show Heading //
            'folder_name' => $this->folder_name,
            'imageurls' => $imageurls,

            'post' => [],
            'categories' => $categories,
            'tags' => $allTags,
            'q_id' => $q_id,
        ]);


    }

    public function translate($locale ,$id) {
        $post = Post::with('getCategory')->find($id);
        // dd($post->getCategory()->first()->item_id);
        $lang_id = Lang::getLangId(app()->getLocale());

        $categories = Category::where('lang_id',$lang_id)->get();
        $allTags = Post::getTagsByLangId($lang_id);

        $images = Storage::files('public/'.$this->folder_name.'/'.$post->unique_id); // this are images //
        $imageurls = [];
        for ($i=0; $i < count($images) ; $i++) {
            $imageurls[$i]['url'] = Storage::url($images[$i]);
            $imageurls[$i]['size'] = $size = Storage::size($images[$i]);
        }



        // return 'Here we will creating new Post as translation for Post N-'.$id;
        return view('admin.post.translate',[
            'page_name' => 'posts',
            'langs' => Lang::all(),
            'lang_id' => $lang_id,

            'next_unique_id' => $post->unique_id,
            'post_id' => $post->id,
            'folder_name' => $this->folder_name,
            'imageurls' => $imageurls,

            'currentPost' => $post,
            'post' => [],
            'categories' => $categories,
            'tags' => $allTags,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * ////// This method responding to "create" and "translate" requests
     */
    public function store(Request $request, $locale)
    {

        $validator = Validator::make($request->all(),[
            'category_id' => 'required|integer',
            'title' => 'required|string',
            'short_text' => 'required|string',
            'html_code' => 'required|string',
            'img' => 'required|string',
            'meta_k' => 'required|string',
            'meta_d' => 'required|string',
            'view' => 'required|integer',
            'lang_id' => 'required|integer',
            'unique_id' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|string',
            'tags' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $post_exists = Post::where('unique_id',$request->unique_id)->where('lang_id',$request->lang_id)->first();
        if ($post_exists) {
            $language = $post_exists->lang()->get()->toArray();
            $lng_name = $language[0]['lng_name'];
            return redirect()->back()->with('oneerror', 'Post with Unique ID = '.$request->unique_id. ' in '.$lng_name . ' already exists.');
        }

        $post = Post::on('mysql_admin')->create($request->all()); // work fine +
        $post_id = $post->id;
        $unique_id = $post->unique_id;
        $language = $post->lang()->get()->toArray();
        $lng_name = $language[0]['lng_name'];


        //// return redirect()->back()->with('success', 'New Post pi-'.$post_id.' ui-'.$unique_id.' was created successfuly');

        //// store tags into taggable_tags

        if ($request->input('tags')) {
            if(!empty($request->input('tags'))) {

            $tagsString = $request->tags;
            $tagsArray = explode(",",$tagsString);

            $post->tag($tagsArray);

                for ($i=0; $i < count($tagsArray); $i++) {
                    DB::connection('mysql_admin')->table('taggable_tags')
                    ->where('name', $tagsArray[$i])
                    ->update(['lang_id' => $request->input('lang_id') ]);
                }
            }
        }


        //// update lang_id into taggable_taggables
        DB::connection('mysql_admin')->table('taggable_taggables')
        ->where('taggable_type', 'App\\Post')
        ->where('taggable_id', $post_id)
        ->update(['lang_id' => $request->input('lang_id') ]);


        //// save as event to show into Calendar
        Event::checkAndSaveIfNotExists($request->input('date'), $request->input('lang_id'));

        //// check and replace other posts with status = "main"

        if($post->status == 'main') {
            $mainPosts = Post::where('status','=', 'main')->where('lang_id','=',$post->lang_id)->get();
            // return $mainPosts;
            if(count($mainPosts) > 1) {
                foreach ($mainPosts as $key => $mainPost) {
                   if($mainPost->id != $post->id) {
                       Post::on('mysql_admin')->find($mainPost->id)->update(['status' => 'published']);
                   }
                }
            }
        }

        ///// fill questionable-table with all subscribers-data
        // $subscribers = Subscriber::all();
        // foreach ($subscribers as $key => $value) {
        //     DB::connection('mysql_admin')->table('subscribable')->insert(['post_id' => $post_id, 'subscriber_id'=> $value->id]);
        // }



        //// Has Question
        if ($request->input('q_id')) {
            $question = Question::on('mysql_admin')->find($request->input('q_id'));
            $question->questionable_id = $post_id;
            $question->questionable_type = Post::class;
            $question->link = 'posts/'.$unique_id.'/'.urlencode($post->title); // 'localhost::8000/'.$language[0]['lng'].'/posts/'
            $question->save();


            $user = User::find($question->user_id);
            $params = [];
            $params['from_name'] = config('mail.from.name');
            $params['from_email'] = config('mail.from.address');
            $params['name'] = $user->name;
            $params['email'] = $user->email;
            $params['subject'] = 'A reply to Your Question';
            $params['template_type'] = 'post_reply';
            $params['template'] = 'admin.emails.send';

            $body = '<h4>Dear '.$user->name.'!</h4>';
            $body.='<p>We replied to your question.</p>';
            $body.='<p><cite>"'.$question->body.'"</cite></p><hr>';
            $body.='<p>Follow this link to see Your answer.</p>';
            $body.='<a href="'.config('app.url').'/'.$locale.'/posts/'.$request->unique_id.'/'.urlencode($request->title).'" target="_blank">'.$request->title.'</a>';

            $params['body'] = $body;
            // return $params;


            // return new MailNotify($params); // shows template //
            Mail::to($user->email)->send(new MailNotify($params));


/*
            Mail::send('admin.emails.send',
            array(
               'name' => 'admin',
               'email' => 'icheck.am@gmail.com',
               'body' => $body
            ), function($body)
           {
            $body->from('icheck.am@gmail.com');
            $body->to(User::find(11)->email, User::find(11)->name)
            ->subject('A reply to Your Question');
            });
            if (Mail::failures()) {
                return redirect()->back()->with('oneerror', 'Mail was not sent');
            }else{
                return redirect()->back()->with('success', 'Mail was successfully sent');
            }
*/

            // logging action - Post replied Question
            Log::channel('info_daily')->info('Admin: Store Post N-'.$post_id.', Question №-'.$question->id.'replied too.', ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->route('admin.post.index', $language[0]['lng'])
            ->with('success', 'Post №-'.$post_id.' in '.$lng_name.' was successfuly created!<br> Question №-'.$question->id.'replied too.');
        }

        // logging action - new Post
        Log::channel('info_daily')->info('Admin: Store Post N-'.$post_id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        // return redirect()->back()->with('success', 'Post №-'.$post_id.' in '.$lng_name.' was successfuly created!');
        return redirect()->route('admin.post.index', $language[0]['lng'])
            ->with('success', 'Post №-'.$post_id.' in '.$lng_name.' was successfuly created!');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        return redirect()->route('admin.post.edit', ['locale'=>$locale, 'id'=>$id])
        ->with('success_for_coder', 'redirected from show route. can be done from url and question->show-post');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('admin.post.index', app()->getLocale());
        }
        $lang_id = Lang::getLangId(app()->getLocale());
        $categories = Category::where('lang_id', $lang_id)->get();
        $allTags = Post::getTagsByLangId($lang_id);
        $postTagsList = $post->tagList;

        $langs = Lang::all();
        $unique_id = $post->unique_id;  // պետք է view-ում  նկարների upload-ի համար

        $images = Storage::files('public/'.$this->folder_name.'/'.$post->unique_id); // this are images //
        $imageurls = [];
        for ($i=0; $i < count($images) ; $i++) {
            $imageurls[$i]['url'] = Storage::url($images[$i]);
            $imageurls[$i]['size'] = $size = Storage::size($images[$i]);
        }


        // logging action - new Post
        Log::channel('info_daily')->info('Admin: Edit Post N-'.$id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);


        return view('admin.post.edit', [
            'page_name' => 'posts',
            'post' => $post,
            'categories' => $categories,
            'tags' => $allTags,
            'postTagsList' => $postTagsList,
            'langs' =>$langs,
            'folder_name' => $this->folder_name,
            'imageurls' =>$imageurls,

        ]);
    }

    public function relationship($locale, $id) {

        // $post = Post::on('mysql_admin')->where('id',$id)->with('getComments', 'getDocuments', 'questions')->first();
        $post = Post::on('mysql_admin')->where('id',$id)->first();
        if (!$post) {
            return redirect()->route('admin.post.index',app()->getLocale());
        }
        $unique_id = $post->unique_id;

        // $files = Storage::files('public/'.$this->folder_name.'/'.$unique_id);
        $files = Storage::files('public/'.$this->folder_name.'/'.$unique_id.'/'.$id);
        $fileurls = [];
        for ($i=0; $i < count($files) ; $i++) {
            $fileurls[$i]['url'] = Storage::url($files[$i]);
            $fileurls[$i]['size'] = $size = Storage::size($files[$i]);

            if(!in_array(Document::getTypeFromLink($files[$i]), $this->validImageExp)) {

                if(!DB::table('documents')->where('link',  Storage::url($files[$i]) )->where('documentable_type','App\Post')->exists()) {
                    // echo  'into if';
                    // Post::on('mysql_admin')->where('id',$id)->getDocuments()->create(Document::prepareDocParams(Storage::url($files[$i])));
                    $post->getDocuments()->create(Document::prepareDocParams(Storage::url($files[$i])));

                }
            }

        }

        // dd($post->pictures()->get());


        $images = Storage::files('public/'.$this->folder_name.'/'.$post->unique_id); // this are images //
        $imageurls = [];
        for ($i=0; $i < count($images) ; $i++) {
            $imageurls[$i]['url'] = Storage::url($images[$i]);
            $imageurls[$i]['size'] = $size = Storage::size($images[$i]);
            if(in_array(Document::getTypeFromLink($images[$i]), $this->validImageExp)) {

                if(!DB::table('lightboxes')->where('pic_link',  Storage::url($images[$i]) )->exists()) {
                    $post->pictures()->create(['post_unique_id' => $unique_id, 'pic_link'=> Storage::url($images[$i])]);
                }

            }
        }


        $comments = $post->getComments()->with('user')->get();
        $docsObject = $post->getDocuments()->get(); // պետք է լինի բազա խփելուց [ցիկլից] հետո
        $question = $post->questions()->with('user')->get();
        $picObject = $post->pictures()->get();
        // dd($question);
        return view('admin.post.relationship',[
            'page_name' => 'posts',
            'folder_name' => $this->folder_name,
            'fileurls' => $fileurls,
            'post' => $post,
            'comments' => $comments,
            'docsObject' => $docsObject,
            'question' => $question,
            'picObject' => $picObject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id)
    {
        $validator = Validator::make($request->all(),[
            'category_id' => 'required|integer',
            'title' => 'required|string',
            'short_text' => 'required|string',
            'html_code' => 'required|string',
            'img' => 'required|string',
            'meta_k' => 'required|string',
            'meta_d' => 'required|string',
            // 'view' => 'required|integer', // disabled
            // 'lang_id' => 'required|integer', // disabled
            // 'unique_id' => 'required|integer', // removed
            'date' => 'required|date',
            'status' => 'required|string',
            'tags' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $post = Post::on('mysql_admin')->findOrFail($id);
        // $post->setConnection('mysql2');
        $old_date = $post->date;

        $post->update($request->all());
        // $post_id = $post->id;
        // $unique_id = $post->unique_id;
        $language = $post->lang()->get()->toArray();
        $lng_name = $language[0]['lng_name'];




        if ($request->input('tags')) {
            if(!empty($request->input('tags'))) {

                $tagsString = $request->tags;
                $tagsArray = explode(",",$tagsString);
                $post->retag($tagsArray); // retag() = detag() + tag()

                    for ($i=0; $i < count($tagsArray); $i++) {
                        DB::connection('mysql_admin')->table('taggable_tags')
                        ->where('name', $tagsArray[$i])
                        ->update(['lang_id' => $post->lang_id ]);
                    }
            }
        }

        // update lang_id into taggable_taggables
        DB::connection('mysql_admin')->table('taggable_taggables')
        ->where('taggable_type', 'App\\Post')
        ->where('taggable_id', $post->id)
        ->update(['lang_id' => $post->lang_id ]);


        Event::checkAndSaveIfNotExists($request->input('date'), $post->lang_id );
        Event::checkAndDeleteEventDate($old_date, $post->lang_id );

        // check and replace other posts with status = "main"
        if($post->status == 'main') {
            $mainPosts = Post::where('status','=', 'main')->where('lang_id','=',$post->lang_id)->get();
            // return $mainPosts;
            if(count($mainPosts) > 1) {
                foreach ($mainPosts as $key => $mainPost) {
                   if($mainPost->id != $post->id) {
                       Post::on('mysql_admin')->find($mainPost->id)->update(['status' => 'published']);
                   }
                }
            }
        }


        // logging action ( can store in 3 lang on the same time)
        Log::channel('info_daily')->info('Admin: Update Post N-'.$post->id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);


        return redirect()->back()->with('success', 'Post №-'.$post->id.' in '.$lng_name.' was successfuly updated!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {

        $post = Post::on('mysql_admin')->find($id);
        if (!$post) {
            return redirect()->back()->with('error', 'Post №-' . $id. ' was not found');
        }
        else{
            $date = $post->date;
            $lang_id = $post->lang_id;



            $post->getDocuments()->delete();
            $post->getComments()->delete();


            $question = $post->questions()->first(); // first() -> 0-րդ էլեմենտ; get() -> wrapper [0][ and data ...]
            if ($question) {
                $question->link = null;
                $question->questionable_id = null;
                $question->questionable_type = null;
                $question->visible = 0;
                $question->save();
            }

            $post->detag();
            $post->delete();
            Event::checkAndDeleteEventDate($date, $lang_id); // check

            // logging action ( can store in 3 lang on the same time)
            Log::channel('info_daily')->info('Admin: Delete Post N-'.$id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->back()->with('success', 'Post №-' . $id. ' was succesfuly deleted');
        }
    }
}
