<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Lang;
use App\Post;
use App\Answer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang_id = Lang::getLangId(app()->getLocale());
        // $questions = Question::where('lang_id', $lang_id)->with('questionable','user','lang')->get();
        $questions = Question::where('lang_id', $lang_id)->with('user', 'getDocuments')
        ->orderBy('id', 'DESC')->paginate(10);
        // dd($questions);

        return view('admin.question.index', [
            'page_name' => 'questions',
            'langs' => Lang::all(),
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function resetReply(Request $request,$locale, $q_id) {

        $question = Question::on('mysql_admin')->find($q_id);

        $type = \str_replace("App\\","",$question->questionable_type);
        $type_id = $question->questionable_id;

        $question->link = null;
        $question->questionable_id = null;
        $question->questionable_type = null;
        $question->visible = 0;
        $question->save();

        if ($type ==='Answer') {
            $answer = Answer::on('mysql_admin')->find($type_id);
            $answer->delete();
        }

        // logging action
        Log::channel('info_daily')->info('Admin: Reset replied Question N-'.$q_id, ['type' => $type, 'type_id' => $type_id, 'id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->route('admin.question.index', $locale)
        ->with('success', 'Replied '.$type.' № -'.$type_id.' was successfuly reset!');
    }

    public function post($locale, $q_id) {
        // return $q_id;
        $lang_id = Lang::getLangId($locale);
        $posts = Post::where('lang_id', $lang_id)->orderBy('id', 'desc')->paginate(5);
        $question = Question::where('id',$q_id)->with('lang')->first();

        // dd($question->lang()->first()->lng);
        $langs = Lang::all();

        if(!$question) {
            return redirect()->back()->with('oneerror', 'Can\'t find Question with ID №-'.$q_id);
        }

        return view('admin.question.postlist', [
            'page_name' => 'questions',
            'posts' => $posts,
            'langs' => $langs,
            'q_id' => $q_id,
            'q_lng' => $question->lang()->first()->lng,

        ]);

    }

    public function postReply(Request $request, $locale) {
        $post_id = $request->input('post_id');
        $quest_id = $request->input('quest_id');

        $post = Post::find($post_id);
        $lang = Lang::find($post->lang_id);
        $lng = $lang->lng;

        $question = Question::on('mysql_admin')->find($quest_id);
        $question->link = 'posts/'.$post->unique_id.'/'. urlencode($post->title); // localhost::8000/'.$lng.'/posts/'
        $question->questionable_id = $post->id;
        $question->questionable_type = Post::class;
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
        $body.='<a href="'.config('app.url').'/'.$locale.'/posts/'.$post->unique_id.'/'.urlencode($post->title).'" target="_blank">'.$post->title.'</a>';

        $params['body'] = $body;
        // return $params;


        // return new MailNotify($params); // shows template //
        Mail::to($user->email)->send(new MailNotify($params));

        // action logging
        Log::channel('info_daily')->info('Admin: Reply Question N-'.$quest_id.' by Post N-'.$post_id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->route('admin.question.index', $lng)
        ->with('success', 'Question №-'.$quest_id.' was successfully replied by Post №-'.$post_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @link to download from blade $flink
     * @here $flink = asset('/storage/questions/2/example.docx');
     *
     * @add /storage/ before link
     * @here $furl = Storage::url('questions/2/example.docx');
     */
    public function edit($locale, $id)
    {
        // reject from question here
        $question = Question::with('user', 'getDocuments')->find($id);
        $language = $question->lang()->get()->toArray();
        return view('admin.question.edit', [
            'page_name' => 'questions',
            'question' => $question,
            'langs' => Lang::all(),
            'lng_name' => $language[0]['lng_name'],
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$locale, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            // 'body' => 'required|string',
            // 'lang_id' => 'required|integer',
            'visible' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput()->withErrors($validator);
        }
        $question = Question::on('mysql_admin')->find($id);
        // $question->lang_id = $request->lang_id;
        // $question->body = $request->body;
        $question->visible = $request->visible;
        $question->save();


        // action logging
        Log::channel('info_daily')->info('Admin: Update Question N-'.$id.' set visible='.$request->visible, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->back()->with('success', 'Question № -'.$id.' was successfuly updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
