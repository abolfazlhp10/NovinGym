<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coach;

class Program extends Model
{
    use HasFactory;

    protected $fillable=['name','coach_id','username'];

    public function coach(){
        return $this->belongsTo(Coach::class);
    }

}
