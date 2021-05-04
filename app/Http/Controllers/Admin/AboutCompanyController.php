<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\AboutCompany;
use App\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AboutCompanyController extends Controller
{
    public $folder_name = 'aboutus';

    public function index()
    {
       $abouts = AboutCompany::with('lang')->get();
       $langs = Lang::all();


       return view('admin.about.index', [
           'page_name' => 'about_us',
           'abouts' => $abouts,
           'langs' => $langs,

       ]);
    }


    public function edit($locale, $id)
    {
        $about = AboutCompany::where('id', $id)->with('lang')->first();
        $langs = Lang::all();

        // second cycle, when after uploading files redirect back //
        $images = Storage::files('public/'.$this->folder_name.'/1'); // this are images //
        $imageurls = [];
        for ($i=0; $i < count($images) ; $i++) {
            $imageurls[$i]['url'] = Storage::url($images[$i]);
            $imageurls[$i]['size'] = $size = Storage::size($images[$i]);
        }

        return view('admin.about.edit', [
            'page_name' => 'about_us',
            'about' => $about,
            'langs' => $langs,
            'folder_name' => $this->folder_name,
            'imageurls' =>$imageurls,

        ]);
    }

    public function update(Request $request, $locale, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => 'required|integer',
            'html_code' => 'required|string',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $about = AboutCompany::on('mysql_admin')->find($data['id']);
        $about->html_code = $data['html_code'];
        $about->status = $data['status'];
        $about->save();

        // logging action
        Log::channel('info_daily')->info('Admin: Update About Us in locale-> '.$locale, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->back()->with('success', 'About Us in locale-'.$locale.' was successfully updated.');

    }


    public function changeStatus(Request $request, $locale, $id)
    {
        $data = $request->all();
        // return $data['id'];
        if (AboutCompany::where('id', $data['id'])->first()) {
            AboutCompany::on('mysql_admin')->where('id', $data['id'])->update([
                'status' => $data['status'],
            ]);

            // logging action
            Log::channel('info_daily')->info('Admin: Change AboutCompany N-'.$id.' status to ->'.$data['status'], ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->back()->with('success', 'Status of AboutCompany №-'.$data['id'] .' was successfully changed!');
        }else{
            return redirect()->back()->with('oneerror', 'Can not find AboutCompany with ID='.$data['id']);
        }
    }
}

