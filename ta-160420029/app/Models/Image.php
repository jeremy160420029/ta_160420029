<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'articles_id'];
    public $timestamps = false;

    public function articles(){
        return $this->belongsTo(Article::class, "articles_id");
    }
}
