<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutCompany extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'html_code','lang_id','status',
    ];

    public function lang() {
        return $this->belongsTo('App\Lang', 'lang_id', 'id');
    }
}
