<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;
use DB;

class Post extends Model
{
    use Taggable;

    protected $fillable = [
        'unique_id', 'title', 'short_text', 'html_code', 'img', 'date', 'view','category_id','status', 'meta_k', 'meta_d', 'category_id',  'lang_id'
    ];

    public function getCategory() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function getDocuments() {
        return $this->morphMany('App\Document', 'documentable');
    }

    public function getComments() {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function questions() {
        return $this->morphOne('App\Question', 'questionable');
    }

    public function lang() {
        return $this->belongsTo('App\Lang', 'lang_id', 'id');
    }

    static function get_cur_posts($category_name,$lang_id){
        return $posts = DB::table('categories')
        ->where('categories.name',$category_name)
        ->where('categories.lang_id',$lang_id)
        ->where('posts.status','<>','unpublished')
        ->orderByRaw('date DESC')
        ->select('*')
        ->join('posts', 'categories.id', '=','posts.category_id' )
        ->paginate(3);
    }

    static function get_archieve($date,$lang_id){
        return $posts = DB::table('posts')
        ->where('lang_id',$lang_id)
        ->where('date',$date)
        ->where('status','<>','unpublished')
        ->orderByRaw('id DESC')
        ->paginate(6);
    }

    static function getTagsByLangId($lang_id) {
        $allTags = [];
        $allTagsColumn = DB::select("SELECT name from taggable_tags where lang_id = ?", [$lang_id]);
        for ($i=0; $i < count($allTagsColumn); $i++) {
            $allTags[$i] = $allTagsColumn[$i]->name;
        }
        return $allTags;
    }

    static function update_view_count($post_id) {

        $update = DB::update('update posts set view = view +1 where id = ?', [$post_id]);
               return $update;
    }


    public function pictures(Type $var = null)
    {
        return $this->hasMany('App\Lightbox', 'post_unique_id', 'unique_id');
    }



    public function getDateAttribute($dateSatring)
    {
        $date = date_create($dateSatring);
        $newDate = date_format($date, 'd-m-Y');
        return $newDate;
    }

    public function defaultFormat($dateSatring)
    {
        $date = date_create($dateSatring);
        $oldDate = date_format($date, 'Y-m-d');
        return $oldDate;
    }





}
