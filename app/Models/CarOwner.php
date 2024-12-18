<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOwner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'user_id'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
