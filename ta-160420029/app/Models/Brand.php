<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image_brand'];
    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany(Article::class, "brands_id", "id");
    }
}
