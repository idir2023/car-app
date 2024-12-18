<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'marke_id',
        'model_id',
        'year',
        'engine_type',
        'color',
        'seats',
        'doors',
        'price',
        'status',
    ];

    public function marke() {
        return $this->belongsTo(Marke::class);
    }

    public function modelCar() {
        return $this->belongsTo(ModelCar::class, 'model_id');
    }

    public function images() {
        return $this->hasMany(CarImage::class);
    }
}
