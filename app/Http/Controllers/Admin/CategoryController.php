<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Lang;
use App\PostLayout;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $langs = Lang::pluck('lng_name','lng')->toArray();
        // dd($langs);

        $lang_id = Lang::getLangId(app()->getLocale());
        $categories = Category::where('lang_id', $lang_id)->get();
        $sorted = $categories->sortBy('position');
        return view('admin.category.index')->with([
            'page_name'=>'categories',
            'categories'=>$categories,
            'sorted' =>$sorted,
            'langs' => Lang::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // this is Form Creation - get

        $max_item_id = Category::max('item_id');
        $max_position = Category::max('position');
        // return $max_position;

        return view('admin.category.create',[
            'page_name'=>'categories',
            'langs' => Lang::all(),
            'new_item_id' => $max_item_id + 1,
            'new_position' => $max_position + 1,
            'postlayouts' => PostLayout::all(),


        ]);
    }

    public function translate($locale ,$id)
    {
        /* here $locale is language to translate in */
        /* here app()->getLocale() already ==== $locale  */
        $cat = Category::find($id); // translate from
        $lang_id = Lang::getLangId(app()->getLocale()); // translate to
        $lang = Lang::where('id',$lang_id)->first();

        // dump($lang->id);

        return view('admin.category.translate',[
            'page_name'=>'categories',
            'langs' => Lang::all(),
            'lang_id' => $lang_id,
            'currentCat' => $cat,
            'category'=> [],
            'lang' => $lang,
        ]);


    }


    public function storetrans(Request $request, $locale)
    {
        // dump($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'position' => 'required|integer',
            'item_id' => 'required|integer',
            'status' => 'required|integer',
            'lang_id' => 'required|integer',
            'layout' => 'required|string|max:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $category = Category::on('mysql_admin')->create($request->all());

        // logging action ( can store in 3 lang on the same time)
        Log::channel('info_daily')->info('Admin: Store (trnaslate) new Category N-'.$category->id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);


        return redirect()->route('admin.category.index', app()->getLocale())
        ->with('success', 'Category №-'.$category->id.' was successfuly translated to' .$locale);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale) {
        // Store the new - POST Request
        $data = $request->all();
        $names = $data['names'];

        $position = $data['position'];
        $layout = $data['layout'];
        $item_id = $data['item_id'];
        // $status = $data['status'];

        for ($i=0; $i < count($names); $i++) {
            if (Category::where('name', $names[$i]['name'])->first()) {
                return response()->json(['data_type'=> gettype($data), 'warning'=>$data]);
            }
            if ($names[$i]['name']) {

                /* On Simple Connection */
                // $category = new Category();
                // $category->item_id = $item_id;
                // $category->name = $names[$i]['name'];
                // $category->position = $position;
                // $category->layout = $layout;
                // $category->status = $names[$i]['status'];
                // $category->lang_id = $names[$i]['lang_id'];
                // $category->save();

                $category = Category::on('mysql_admin')->create([
                    'item_id' => $item_id,
                    'name' => $names[$i]['name'],
                    'position' => $position,
                    'layout' =>$layout,
                    'status' => $names[$i]['status'],
                    'lang_id' => $names[$i]['lang_id'],
                ]);

                // logging action ( can store in 3 lang on the same time)
                Log::channel('info_daily')->info('Admin: Store new Category N-'.$category->id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);


            }

        }

        return response()->json(['data_type'=> gettype($data), 'data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // sa Petq chi ....
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$locale, $id) {
        // return response()->json(['success'=>'Product saved successfully.', 'id'=>$id]);

        $category = Category::find($id);
        $language = $category->lang()->get()->toArray();
        // dd($language[0]['lng_name']);


        return view('admin.category.edit',[
            'page_name'=>'categories',
            'category' => $category,
            'langs' => Lang::all(),
            'lng_name' => $language[0]['lng_name'],
            'postlayouts' => PostLayout::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id) {
        //$request-> name, status are individual
        $category = Category::on('mysql_admin')->find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        // $request->layout is for item-group
        Category::where('item_id', $category->item_id)->update(['layout'=>$request->layout]);

        // logging action
        Log::channel('info_daily')->info('Admin: Update Category N-'.$id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return redirect()->back()->with('success', 'Category N ' . $id. ' was succesfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id) {
        $category = Category::on('mysql_admin')->find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'Category N ' . $id. ' was not found');
        }
        else{
            $category->delete();

            // logging action ( can store in 3 lang on the same time)
            Log::channel('info_daily')->info('Admin: Delete Category N-'.$id, ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

            return redirect()->back()->with('success', 'Category N ' . $id. ' was succesfuly deleted');
        }
    }

    public function positionUpdate(Request $request, $locale) {
        // $categories = Category::latest()->paginate(5);
        $data = $request->all();
        $item_positions = $data['item_positions'];
        for ($i=0; $i < count($item_positions); $i++) {
            Category::on('mysql_admin')->where('item_id', $item_positions[$i]['item_id'])->update(['position'=>$item_positions[$i]['position']]);
        }


        // logging action ( can store in 3 lang on the same time)
        Log::channel('info_daily')->info('Admin: Update Positions of Categories', ['id'=> Auth::user()->id, 'email'=> Auth::user()->email]);

        return response($data);
        // return response()->json(['data_type'=> gettype($data), 'pp'=>$data->pp]);
    }
}
