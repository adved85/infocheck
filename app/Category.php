<?php

namespace App;
use DB;use App\Lang;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;
    protected $fillable = ['item_id','name', 'position', 'layout', 'status','lang_id'];



    static  function get_category($lang_id){
       return  $get_category = Category::where('lang_id',$lang_id)->orderBy('position')->where('status',1)->get();
    }
    public function get_category_posts() {
        return $this->hasMany('App\Post', 'category_id', 'id');
    }

    public function lang() {
        return $this->belongsTo('App\Lang', 'lang_id', 'id');
    }

    public function category_name() {
        return $this->belongsTo('App\Post');
    }

}
