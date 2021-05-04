<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Lightbox;

class DocumentController extends Controller
{
    public function uploadimage(Request $request, $locale) {
        $folder_name = $request->input('folder_name');
        // return $folder_name;
        $images = $_FILES['images'];
        $post_id = $request->input('unique_id');
        $total = count($_FILES['images']['name']);
        $validImage = ['image/jpg','image/png','image/jpeg','image/pjpeg','image/bmp', 'image/gif', 'image/svg+xml'];
        $imgDebug = [];
        $errors = [];
        for($i = 0; $i < $total; $i++) {
            if($_FILES['images']['tmp_name'][$i] != "") {
                if(in_array($_FILES['images']['type'][$i], $validImage)  ) {
                    $imgDebug['success'][$i]['url'] =  $_FILES['images']['tmp_name'][$i];
                    $imgDebug['success'][$i]['name'] = $_FILES['images']['name'][$i];
                    $path = Storage::disk('public')->putFileAs($folder_name.'/'.$post_id, new File($_FILES['images']['tmp_name'][$i]), $_FILES['images']['name'][$i]);
                    $path2 = Storage::disk('upload')->putFileAs($folder_name.'/'.$post_id, new File($_FILES['images']['tmp_name'][$i]), $_FILES['images']['name'][$i]);
                    $imgDebug['success'][$i]['path'] = Storage::url($path);
                    $imgDebug['success'][$i]['size'] = $_FILES['images']['size'][$i];
                }
                else{
                    $imgDebug['errors'][$i]['message'] =  $_FILES['images']['name'][$i] . ' has not proper type! -> '.$_FILES['images']['type'][$i];
                }
            }
        }

        // return $imgDebug;
        return redirect()->back()->with('imgDebug' , $imgDebug);
    }

    public function uploadfile(Request $request, $locale) {
        $folder_name = $request->input('folder_name');
        $files = $_FILES['files'];

        $post_id = $request->input('post_id');
        $unique_id = $request->input('unique_id');
        $total = count($_FILES['files']['name']);
        $NotValidFile = ["application/x-javascript", "application/sql", "application/x-php"];
        $flDebug = [];
        $errors = [];

        for($i = 0; $i < $total; $i++) {
            if($_FILES['files']['tmp_name'][$i] != "") {
                if(!in_array($_FILES['files']['type'][$i], $NotValidFile)  ) {

                    $flDebug['success'][$i]['url'] =  $_FILES['files']['tmp_name'][$i];
                    $flDebug['success'][$i]['name'] = $_FILES['files']['name'][$i];
                    $path = Storage::disk('public')->putFileAs($folder_name.'/'.$unique_id.'/'.$post_id, new File($_FILES['files']['tmp_name'][$i]), $_FILES['files']['name'][$i]);
                    $path2 = Storage::disk('upload')->putFileAs($folder_name.'/'.$unique_id.'/'.$post_id, new File($_FILES['files']['tmp_name'][$i]), $_FILES['files']['name'][$i]);
                    $flDebug['success'][$i]['path'] = Storage::url($path);
                    $flDebug['success'][$i]['size'] = $_FILES['files']['size'][$i];
                }
                else{
                    $flDebug['errors'][$i]['message'] =  $_FILES['files']['name'][$i] . ' has not proper type! -> '.$_FILES['files']['type'][$i];
                }
            }
        }

        // return $flDebug;
        return redirect()->back()->with('flDebug' , $flDebug);
    }


    public function savedocstatus(Request $request, $locale) {
        $docs = $request->all()['docs'];
        $updateDocs = [];
        foreach ($docs as $key => $value) {
            $updateDocs[] =['id' => $key, 'isused' => $value];
            Document::on('mysql_admin')->find($key)->update(['isused' => $value]);
        }
        // return $updateDocs;
        return redirect()->back()->with(['docStatusMessage' => 'All changes successfully saved.']);
    }

    public function savepicstatus(Request $request, $locale) {
        $pics = $request->all()['pics'];
        $updatePics = [];
        foreach ($pics as $key => $value) {
            $updatePics[] =['id' => $key, 'isused' => $value];
            Lightbox::on('mysql_admin')->find($key)->update(['isused' => $value]);
        }
        // return $updateDocs;
        return redirect()->back()->with(['docStatusMessage' => 'All changes for LightBox successfully saved.']);
    }
}
