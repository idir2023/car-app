<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    protected $table = 'model_cars';

    protected $fillable = [
        'name',
        'marke_id',
    ];

    public function marke()
    {
        return $this->belongsTo(Marke::class);
    }

    public function car()
    {
        return $this->hasMany(Car::class);
    }
    
}
