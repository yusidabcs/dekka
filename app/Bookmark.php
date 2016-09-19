<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Bookmark extends Eloquent
{
    //
    protected $fillable = array('news_id','user_id');
}
