<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // for logout is status == 0

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {

        if ($request->user() &&  !$request->user()->hasRole($roles)) {
            // var_dump('chexav axper');die;
            Auth::logout();
            return redirect()->route('register', app()->getLocale());
            // լռությամբ բոլորը ստանում են role=i_user , սակայն երբ ուզուոմ ենք բացել ադմինական լինկ, գալիսա այստեղ
            // եթե լռությամբ չտայինք role=i_user , ապա սովորական յուզեռն էլ ստեղ կգար
        }

        /* User-STATUS --- does he active or not */
        if ($request->user() && $request->user()->status !== 1) {
            Auth::logout();
            return redirect()->route('login', app()->getLocale())->with('blocked_msg', trans('auth.blocked')); // 'You are blocked flash-alert
        }else{
            // եթե մի էջի վրա լոգաութա եղել, մյուսի վրա , եթե էլի login ուղարկեինք, ERROR կտար, քանի որ այս կայքում մենյուն դատայա ստանում մեթոդից,
            // որը այս պարագայում շատ֊շատ return view('auth.login', ['data' =>$data]) սենց մի բանով լուծվեր։
            return redirect()->route('index_page', app()->getLocale());
        }


        return $next($request);
    }
}
