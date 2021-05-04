<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;

class Lang extends Model
{

    protected $fillable = [
        'id','lng', 'lng_root', 'lng_name', 'status'
    ];

    static function getLangId($locale) {
       // $lang = App::getLocale();
        return  $lng = DB::table('langs')
        ->where('lng','=',$locale)
        ->value('id');
    }


    public function about()
    {
        return $this->hasOne('App\AboutCompany');
    }


}
