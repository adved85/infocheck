<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lang;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\AboutCompany;

class LangController extends Controller
{

    public $page_name = 'languages';
    public $timestamps = false;


    public function index() {
        $langs = Lang::all();

        return view('admin.lang.index',[
            'langs' => $langs,
            'page_name' => $this->page_name,
        ]);
    }


    public function edit(Request $request,$locale,$lang_id)
    {
        $current = Lang::find($lang_id);
        if (!$current) {
            return redirect()->back()->with('oneerror', 'Ca not find Language with ID='.$lang_id);
        }

        return view('admin.lang.edit', [
            'current' => $current,
            'langs' =>  Lang::all(),
            'page_name' => $this->page_name,
        ]);
    }


    public function update(Request $request, $locale, $id)
    {
        $validator = Validator::make($request->all(),[
            'lng' => 'required|string',
            'lng_root' => 'required|string',
            'lng_name' => 'required|string',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // dd($request->lng);
        $current = Lang::on('mysql_admin')->findOrFail($id);
        // $current->lng = $request->lng;
        // $current->lng_root = $request->lng_root;
        // $current->lng_name = $request->lng_name;
        // $current->save();

        $current->update($request->all());

        // logging action ( can store in 3 lang on the same time)
        Log::channel('info_daily')->info('Admin: Update Language N-'.$id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);
        return redirect()->back()->with('success', 'Language №-'.$id.' in '.$current->lng_name.' was successfuly updated!');
    }


    public function create($locale)
    {
        $max_id = Lang::max('id');
        $next_id = $max_id + 1;
        return view('admin.lang.create', [
            'langs' =>  Lang::all(),
            'page_name' => $this->page_name,
            'last_id' => $next_id,
        ]);
    }

    public function store(Request $request, $locale)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'lng' => 'required|string',
            'lng_root' => 'required|string',
            'lng_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $lang_exists = Lang::find($request->id);
        if ($lang_exists) {
            return redirect()->back()->with('oneerror', 'Language with Unique ID = '.$request->id. ' already exists.');
        }

        $new_lang = Lang::on('mysql_admin')->create($request->all());
        $lang_about = AboutCompany::where('lang_id',$request->id)->first();

        if (!$lang_about) {
            $new_about = AboutCompany::on('mysql_admin')->create([
                'html_code' => $new_lang->lng,
                'lang_id' => $new_lang->id,
            ]);
        }


        // logging action - Post replied Question
        Log::channel('info_daily')->info('Admin: Store Language N-'.$new_lang->id.', as '.$new_lang->lng_name.'.', ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->route('admin.lang.index', $locale)
        ->with('success', 'Language №-'.$new_lang->id.'  as '.$new_lang->lng_name.' was successfuly created!');
    }





    public function changeStatus(Request $request, $locale, $id)
    {
        $data = $request->all();
        // return $data['id'];
        if (Lang::where('id', $data['id'])->first()) {
            Lang::on('mysql_admin')->where('id', $data['id'])->update([
                'status' => $data['status'],
            ]);

            // logging action
            Log::channel('info_daily')->info('Admin: Change Lang N-'.$id.' status to ->'.$data['status'], ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->back()->with('success', 'Status of Language №-'.$data['id'] .' was successfully changed!');
        }else{
            return redirect()->back()->with('oneerror', 'No Language with ID='.$data['id']);
        }
    }





    public function destroy($locale, $id)
    {
        $lang = Lang::on('mysql_admin')->find($id);
        if (!$lang) {
            return redirect()->back()->with('oneerror', 'Language №-' . $id. ' was not found');
        }

        if (AboutCompany::where('lang_id',$id)->first()) {
            AboutCompany::where('lang_id',$id)->delete();
        }

        $lng_name = $lang->lng_name;
        $lang->delete();



        // logging action - Post replied Question
        Log::channel('info_daily')->info('Admin: Delete Language N-'.$id.', as '.$lng_name.'.', ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);
        return redirect()->back()
        ->with('success', 'Language №-'.$id.'  as "'.$lng_name.'" was successfuly deleted!');
    }


}
