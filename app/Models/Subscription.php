<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'program_numbers'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
