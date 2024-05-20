<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable=['name','category_id','video','description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
