<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coach;
use App\Models\Subscription;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=['subscription_id','coach_id'];

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
