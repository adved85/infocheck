<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Subscriber;
use App\Lang;
use App\Post;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class SubscribeController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::all();
        $langs = Lang::all();
        $posts = Post::orderBy('id', 'desc')->take(10)->get();


        $toQty = DB::connection('mysql_admin')->table('subscribable')->where('sent',0)->count();
        $per = 30;
        $times = $toQty/$per;
        // return $times;

        return view('admin.subscriber.index', [
            'page_name' => 'subscribers',
            'posts' => $posts,
            'subscribers' => $subscribers,
            'times' => $times,
            'langs' => $langs,
        ]);

    }

    public function resend($locale, $subs_id)
    {

        $subscriber = Subscriber::where('id', $subs_id)->first();
        if ($subscriber && $subscriber->is_verified) {

            // return __('verify.is already verified');
            return redirect()->back()->with('oneerror', 'Subscriber №-'.$subs_id.' is already verified' );
        }else{
            $params = [];
            $params['from_name'] = config('mail.from.name');
            $params['from_email'] = config('mail.from.address');
            $params['name'] = $subscriber->email;
            $params['email'] = $subscriber->email;
            $params['subject'] = 'Confirm Your email for subscription [resent-admin]';
            $params['template_type'] = 'subscribe';
            $params['template'] = 'admin.emails.send';
            $body = '<h3>Dear Subscriber!</h3>';
            $body.='<p>To activate your subscription, please follow the link for the verification of your email.</p>';
            $body.='<a class="subs-activate" href="'.config('app.url').'/'.$locale.'/subscribe/activate/'.$subscriber->token.'" target="_blank">'.'Activate'.'</a>';
            $params['body'] = $body; // return $params;

            Mail::to($subscriber->email)->send(new MailNotify($params)); // return new MailNotify($params); // shows template //
            if (!Mail::failures()) {

                // logging action
                Log::channel('info_daily')->info('Admin: Resend activation token to Subscriber N-'.$subs_id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

                // return __('verify.A fresh verification link has been sent to your email address'); // session - subscribeNote
                return redirect()->back()->with('success', 'A fresh verification link has been sent to Subscriber №-'.$subs_id );
            }

        }
    }

    public function changeStatus(Request $request, $locale, $subs_id)
    {
        $data = $request->all();
        // return $data['id'];
        if (Subscriber::where('id', $data['id'])->first()) {
            Subscriber::where('id', $data['id'])->update([
                'is_verified' => $data['is_verified'],
            ]);

            // logging action
            Log::channel('info_daily')->info('Admin: Change Subscriber N-'.$subs_id.' status to ->'.$data['is_verified'], ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->back()->with('success', 'Status of Subscriber №-'.$data['id'] .' was successfully changed!');
        }else{
            return redirect()->back()->with('oneerror', 'No Subscriber with ID='.$data['id']);
        }
    }


    public function prepareToSend(Request $request)
    {
        $subscribers = Subscriber::where('is_verified', 1)->get();
        $data = $request->all();
        $post_id = $data['post_id'];

        DB::connection('mysql_admin')->table('subscribable')->delete();

        foreach ($subscribers as $key => $value) {
            DB::connection('mysql_admin')->table('subscribable')->insert(['post_id' => $post_id, 'subscriber_id'=> $value->id]);
        }

        return redirect()->back()->with('success', 'Post №-'.$post_id.' was successfully prepared!');
    }

    public function mailing()
    {

        $toArray = DB::connection('mysql_admin')->table('subscribable')
        ->join('subscribers', 'subscribable.subscriber_id', '=', 'subscribers.id')->where('sent',0)->take(30)->get();

        $post_id_array = DB::connection('mysql_admin')->table('subscribable')->select('post_id')->take(1)->get();
        $post_id = $post_id_array[0]->post_id;
        $post = Post::where('id',$post_id)->with('lang')->first();

        // dd($toArray[0]->email);
        // $params = [];
        // $params['from_name'] = config('mail.from.name');
        // $params['from_email'] = config('mail.from.address');
        // // $params['name'] = $toArray[0]->email;
        // // $params['email'] = $toArray[0]->email;
        // $params['subject'] = $post->title;
        // $params['template_type'] = 'subscribe';
        // $params['template'] = 'admin.emails.send';
        // $body = '<a class="post-title" href="'.config('app.url').'/'.$post->lang->lng.'/posts/'.$post->unique_id.'/'.$post->title.'" target="_blank"><h3>'.$post->title.'</h3></a>';
        // $body.='<div>'.$post->short_text.'</div>';
        // $body.='<div class="unsubscribe-wrap"><p>'.__('verify.To unsubscribe click on the button below').'</p>';
        // $body.='<a class="subs-deactivate" href="'.config('app.url').'/'.$post->lang->lng.'/subscribe/deactivate/'.$toArray[0]->token.'" target="_blank">'.__('verify.unsubscribe_btn').'</a></div>';
        // $params['body'] = $body; // return $params;

        // return new MailNotify($params);

        foreach ($toArray as $key => $to) {
            // dump($to->email);
            $params = [];
            $params['from_name'] = config('mail.from.name');
            $params['from_email'] = config('mail.from.address');
            $params['name'] = $to->email;
            $params['email'] = $to->email;

            $params['subject'] = $post->title;
            $params['template_type'] = 'subscribe';
            $params['template'] = 'admin.emails.send';
            $body = '<a class="post-title" href="'.config('app.url').'/'.$post->lang->lng.'/posts/'.$post->unique_id.'/'.$post->title.'" target="_blank"><h3>'.$post->title.'</h3></a>';
            $body.='<div>'.$post->short_text.'</div>';
            $body.='<div class="unsubscribe-wrap"><p>'.__('verify.To unsubscribe click on the button below').'</p>';
            $body.='<a class="subs-deactivate" href="'.config('app.url').'/'.$post->lang->lng.'/subscribe/deactivate/'.$to->token.'" target="_blank">'.__('verify.unsubscribe_btn').'</a></div>';
            $params['body'] = $body;

            Mail::to($to->email)->send(new MailNotify($params));
            DB::connection('mysql_admin')->table('subscribable')->where('subscriber_id', $to->id)->update(['sent'=> 1]);

        }

        return redirect()->back()->with('success', 'Mail to '. count($toArray).' subscribers successfully sent');

    }


    public function destroy($locale, $subs_id)
    {
        $subscriber = Subscriber::find($subs_id);
        if (!$subscriber) {
            return redirect()->back()->with('oneerror', 'Can not find Subscriber with ID='.$subs_id);
        }


        $destroy_id = $subscriber->id;
        $destroy_email = $subscriber->email;
        $subscriber->delete();

        // action logging
        Log::channel('info_daily')->info('Admin: Destroy Subscriber N-'.$destroy_id.' with '.$destroy_email.' email address.', ['id'=>Auth::user()->id, 'email' => Auth::user()->email]);

        return redirect()->back()->with('success', 'Subscriber N-'.$destroy_id.' with '.$destroy_email.' email address was successfully deleted.');

    }



}
