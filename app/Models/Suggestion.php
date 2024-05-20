<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coach;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = ['coach_id', 'content'];

    public function coach(){
        return $this->belongsTo(Coach::class);
    }
}
