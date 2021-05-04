<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Lang;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index($locale)
    {
        $users = User::with('roles', 'identities')->paginate(10);

        // dd($users);

        return view('admin.user.index', [
            'page_name'=> 'users',
            'users' => $users,
            'langs' => Lang::all(),
        ]);
    }

    public function changeStatus(Request $request,$locale, $id)
    {
        if (!User::find($id)) {
            return redirect()->back()->with('oneerror', 'Can not find User with ID='.$id);
        }
        User::where('id', $id)->update(['status'=>$request->status]);

        // logging action
        Log::channel('info_daily')->info('Admin: Change User N-'.$id.' status='.$request->status, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->back()->with('success', 'Status of User №-'.$id.' was successfully changed');
    }
}
