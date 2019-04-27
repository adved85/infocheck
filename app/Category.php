<?php

namespace App;
use DB;use App\Lang;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;
    protected $fillable = ['name', 'position','lang_id'];



    static  function get_category($lang_id){
       return  $get_category = Category::where('lang_id',$lang_id)->orderBy('position')->get();
    }
    public function get_category_posts() {
        return $this->hasMany('App\Post', 'category_id', 'id');
    }


}
