<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use Laravel\Sanctum\HasApiTokens;

class Coach extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable=['number','username','name','password','remain_programs'];

    public function programs(){
        return $this->hasMany(Program::class);
    }
}
