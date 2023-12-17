<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'other_columns'];
    public $timestamps = false;

    public function images()
    {
        return $this->hasMany(Image::class, "articles_id", "id");
    }

    public function histories()
    {
        return $this->hasMany(History::class, "articles_id", "id");
    }

    public function brands(){
        return $this->belongsTo(Brand::class, "brands_id");
    }
}
