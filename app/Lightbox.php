<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lightbox extends Model
{
    protected $fillable = [
        'post_unique_id', 'pic_link', 'isused'
    ];

    public function post() {
        return $this->belongsTo('App\Post');
    }


}
