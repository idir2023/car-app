<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marke extends Model
{
    protected $table = 'markes';
    protected $fillable = [
        'name',
    ];

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
