<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lang;
use App\Answer;
use App\Question;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {

        $lang_id = Lang::getLangId($locale);
        $questions = Question::where('lang_id',$lang_id)->with('questionable', 'user','lang')
        ->where('questionable_type','App\Answer')->orderBy('id','DESC')->paginate(10);

        // dd($questions);
        return view('admin.answer.index',[
            'page_name' => 'answers',
            'questions' => $questions,
            'langs' => Lang::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale, $q_id=0)
    {
        // return $q_id;
        if ($q_id > 0) {
            $lang_id = Lang::getLangId($locale);
            $question = Question::where('id', $q_id)->where('lang_id',$lang_id)->with('lang')->first();

            $last_id_array = DB::select("SELECT  AUTO_INCREMENT
                                FROM    information_schema.TABLES
                                WHERE   (TABLE_NAME = 'answers')");

            $last_id = $last_id_array[0]->AUTO_INCREMENT; // only for show breadcrump

            if (!$question) {
                // return 'Can not find Question with ID='.$q_id.' and lang='.$locale.'<br>'.
                $oneerror = 'Can not find Question with ID='.$q_id.' and lang='.$locale.'<br>';
            }
            elseif($question->questionable_id !== null) {
                // return 'Question with ID='.$q_id.' and lang='.$locale.' alerady Replied <br>'.
                $oneerror = 'Question with ID='.$q_id.' and lang='.$locale.' alerady Replied <br>';
            }

            return view('admin.answer.create', [
                'page_name' => 'answers',
                'langs' => Lang::all(),
                'q_id' => $q_id,
                'locale' => $locale,
                'last_id' => $last_id,
            ]);
        }
        else{
            return redirect()->route('admin.question.index',app()->getLocale())
            ->with('oneerror', 'Select Question for which you want to create Answer!');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'body'=>'required|string',
            'q_id'=>'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lang_id = Lang::getLangId($locale);
        $question = Question::on('mysql_admin')->where('id', $request->q_id)->where('lang_id',$lang_id)->with('questionable')->first();

        if ($question->questionable_id !== null) {
            $reply = $question->questionable()->first();
            if ($reply->unique_id) {
                // Replied by Post //
                $oneerror = 'Question №-'.$question->id.' already replied by Post №-'.$reply->id;
            }
            else{
                // Replied by Answer
                $oneerror = 'Question №-'.$question->id.' already replied by Answer №-'.$reply->id;
            }
            return redirect()->back()->with('oneerror', $oneerror);
        }

        // $answer = new Answer();
        // $answer->body = $request->body;
        // $answer->save();
        // $question->questionable()->save($answer); // Չաշխատեց

        $answer = Answer::on('mysql_admin')->create([
            'body' => $request->body,
        ]);

        $question->update([
            'questionable_id' => $answer->id,
            'questionable_type' => Answer::class,
        ]);

        $user = User::find($question->user_id);
        $params = [];
        $params['from_name'] = config('mail.from.name');
        $params['from_email'] = config('mail.from.address');
        $params['name'] = $user->name;
        $params['email'] = $user->email;
        $params['subject'] = 'A reply to Your Question';
        $params['template_type'] = 'answer_reply';
        $params['template'] = 'admin.emails.send';

        $body = '<h4>Dear '.$user->name.'!</h4>';
        $body.='<p>We replied to your question.</p>';
        $body.='<p><cite>"'.$question->body.'"</cite></p><hr>';
        $body.='<p>Read the answer to Your question below.</p>';
        $body.='<div class="answer">'.$answer->body.'</div>';

        $params['body'] = $body;
        // return $params;


        // return new MailNotify($params); // shows template //
        Mail::to($user->email)->send(new MailNotify($params));

        // action logging
        Log::channel('info_daily')->info('Admin: Store Answer N-'.$answer->id.', replied Question N-'.$question->id,['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);


        return redirect()->route('admin.question.index', app()->getLocale())
        ->with('success','Question №-'.$question->id.' was successfully replied by Answer №-'.$answer->id);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $answer = Answer::find($id);
        if (!$answer) {
            return redirect()->back()->with('oneerror', 'Can not find Answer with id №-'.$id);
        }

        $question = $answer->questions()->first();
        // return $question;

        return view('admin.answer.edit', [
            'page_name'=>'answers',
            'answer' => $answer,
            'question' => $question,
            'langs' => Lang::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale,$id)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer',
            'body'=>'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $answer = Answer::on('mysql_admin')->find($request->id);
        if ($answer) {
            $answer->update(['body'=> $request->body]);

            // action logging
            Log::channel('info_daily')->info('Admin: Update Answer N-'.$answer->id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->back()->with('success','Answer №-'.$answer->id.' was successfully updated');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)
    {
        $answer = Answer::on('mysql_admin')->find($id);
        if (!$answer) {
            return redirect()->back()->with('oneerror', 'Can not find Answer with id №-'.$id);
        }
        $question = $answer->questions()->first();
        $question->questionable_id = null;
        $question->questionable_type = null;
        $question->visible = 0;
        $question->save();

        $answer->delete();

        // action logging
        Log::channel('info_daily')->info('Admin: Delete Answer N-'.$id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->back()->with('success', 'Asnwer №-'.$id.' was succesfully deleted. Now Question №-'.$question->id.' is free.');
    }
}
