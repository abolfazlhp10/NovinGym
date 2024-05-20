<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Payment;
use App\Models\Suggestion;

class Coach extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['number', 'username', 'name', 'password', 'remain_programs'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function seggetions()
    {
        return $this->hasMany(Suggestion::class);
    }
}
