<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Lang;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class SubscribeController extends Controller
{
    public function saveEmail(Request $request, $locale)
    {
        /* check unique and email-true-type */
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:subscribers',
        ]);

        if ($validator->fails()) {
            Session::flash('subscribeResponse',['error' => __('verify.please enter valid email')]);
            return redirect()->back()->withInput();

            // return redirect()->route('index_page', app()->getLocale())
            // ->with('subscribeResponse', ['success' => __('verify.please enter valid email') ]);
        }

        /* 1) save new subscriber */
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->token = Str::random(60);
        $subscriber->save();


        /* 2) prepare and send email to activate-verify */
        $params = [];
        $params['from_name'] = config('mail.from.name');
        $params['from_email'] = config('mail.from.address');
        $params['name'] = $subscriber->email;
        $params['email'] = $subscriber->email;
        $params['subject'] = 'Confirm Your email for subscription';
        $params['template_type'] = 'subscribe';
        $params['template'] = 'admin.emails.send';
        $body = '<h4>Dear Subscriber!</h4>';
        $body.='<p>To activate your subscription, please follow the link for the verification of your email.</p>';
        $body.='<a class="subs-activate" href="'.config('app.url').'/'.$locale.'/subscribe/activate/'.$subscriber->token.'" target="_blank">'.'Activate'.'</a>';
        $params['body'] = $body; // return $params;

        Mail::to($subscriber->email)->send(new MailNotify($params)); // return new MailNotify($params); // shows template //
        // if (Mail::failures()) {
        //     return 'Mail was not sent';
        // }else{
        //     return 'Mail was sent';
        // }


        /* 3) prepare view-verify.blade with button with resend-form */
        // $subscriber = Subscriber::where('email', $request->email)->first();
        // return redirect()->route('subscribe.verify',['locale' => app()->getLocale(), 'token'=>$subscriber['token']]);

        // logging action
        Log::channel('info_daily')->info('User: New Subscription request from '.$subscriber->email);

        return redirect()->route('subscribe.verify',['locale' => app()->getLocale(), 'token'=>$subscriber->token]);


    }

    // just a form for mail-enter
    public function verify($locale, $token)
    {
        $subscriber = Subscriber::where('token', $token)->first();
        if ($subscriber) {
            return view('subscriber.verify', [
                'subscriber' => $subscriber,
                'token' => $token,
            ]);
        }else {
            return redirect()->route('index_page', app()->getLocale());
        }
    }

    public function resend($locale, $token)
    {
        $subscriber = Subscriber::where('token', $token)->first();
        // return $subscriber;
        if ($subscriber && $subscriber->is_verified) {

            // return __('verify.is already verified');
            return redirect()->back()->with('subscribeNote', __('verify.is already verified') );
        }else{
            $params = [];
            $params['from_name'] = config('mail.from.name');
            $params['from_email'] = config('mail.from.address');
            $params['name'] = $subscriber->email;
            $params['email'] = $subscriber->email;
            $params['subject'] = 'Confirm Your email for subscription [resent]';
            $params['template_type'] = 'subscribe';
            $params['template'] = 'admin.emails.send';
            $body = '<h4>Dear Subscriber!</h4>';
            $body.='<p>To activate your subscription, please follow the link for the verification of your email.</p>';
            $body.='<a class="subs-activate" href="'.config('app.url').'/'.$locale.'/subscribe/activate/'.$subscriber->token.'" target="_blank">'.'Activate'.'</a>';
            $params['body'] = $body; // return $params;

            Mail::to($subscriber->email)->send(new MailNotify($params)); // return new MailNotify($params); // shows template //
            if (!Mail::failures()) {

                // logging action
                Log::channel('info_daily')->info('User: Resend verification link {front-end} to '.$subscriber->email);

                // return __('verify.A fresh verification link has been sent to your email address'); // session - subscribeNote
                return redirect()->back()->with('subscribeNote', __('verify.A fresh verification link has been sent to your email address') );
            }

        }
    }

    public function activate($locale, $token)
    {

        $subscriber = Subscriber::where('token', $token)->first();
        if ($subscriber) {
            $subscriber->is_verified = 1;
            $subscriber->token = Str::random(60);
            $subscriber->save();
            // return ' was updatet';  // session - subscribeResponse


            // logging action
            Log::channel('info_daily')->info('User: Subscriber '.$subscriber->email.' was successfully activated his email.');


            return redirect()->route('index_page', app()->getLocale())
            ->with('subscribeResponse', ['success' => __('verify.Your Email Address For Subscription Successfully Was Activated') ]);
        }else{
            // return 'no one with this token'; // token was expired

            // logging action
            Log::channel('info_daily')->info('User: Subscriber '.$subscriber->email.' has expired token, system can not identify this subscriber.');

            return redirect()->route('index_page', app()->getLocale())
            ->with('subscribeResponse', ['warning' => __('verify.Your Token For Subscription Was Expired') ]);
        }

    }


    public function deactivate($locale, $token)
    {

        $subscriber = Subscriber::where('token', $token)->first();
        if ($subscriber) {
            $subscriber->is_verified = 0;
            $subscriber->token = Str::random(60);
            $subscriber->save();
            // return ' was updatet';  // session - subscribeResponse

            // logging action
            Log::channel('info_daily')->info('User: Subscriber '.$subscriber->email.' has unsubscribed.');


            return redirect()->route('index_page', app()->getLocale())
            ->with('subscribeResponse', ['success' => __('verify.You have successfully unsubscribed') ]);
        }else{
            // return 'no one with this token'; // token was expired
            return redirect()->route('index_page', app()->getLocale())
            ->with('subscribeResponse', ['warning' => __('verify.Your Token For Subscription Was Expired') ]);
        }

    }


}
