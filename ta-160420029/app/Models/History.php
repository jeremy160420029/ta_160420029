<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function articles()
    {
        return $this->belongsTo(Article::class, 'articles_id');
    }

    public function users(){
        return $this->belongsTo(User::class, "users_id");
    }
}
