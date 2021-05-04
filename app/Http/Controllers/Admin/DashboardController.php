<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Lang;
use App\Poster;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' ]);
    }

    public function index(Request $request) {

        // return 'this is dashboar';
        $posters = Poster::all();
        return view('admin.index',[
            'posters' => $posters,
            'page_name'=>'dashboard',
            'langs' => Lang::all(),
        ]);
    }

    public function updatePosterType(Request $request) {
        $validator = Validator::make($request->all(), [
            'layout' => 'required|string',
          ]);

          if ($validator->fails()) {
            return redirect()->back()
              ->withInput()
              ->withErrors($validator);
          }


          $layout = $request->layout;
          $posters = Poster::on('mysql_admin')->get(); // all() not work with on()
          foreach($posters as $poster) {
              if ($poster->layout === $layout) {
                  $poster->status = 1;
                  $poster->save();
              }else{
                $poster->status = 0;
                $poster->save();
              }
          }

        //   dd($posters);


        // logging action
        Log::channel('info_daily')->info('Admin: Update Poster Type', ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->back()->with('success', 'Poster type was successfuly updated');
    }
}
