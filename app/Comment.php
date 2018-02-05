<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
//
//    public function article()
//    {
//        $this->belongsTo(Article::class);
//    }

    public function author()
    {
        return $this->belongsTo(People::class);
    }
}
