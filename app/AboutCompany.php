<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutCompany extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'html_code','lang_id'
    ];
}