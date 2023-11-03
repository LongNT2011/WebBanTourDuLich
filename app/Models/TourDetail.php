<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDetail extends Model
{
    use HasFactory;
    protected $table = 'tourdetails';
    protected $guarded = ['id'];
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
    public function tourimage(){
        return $this->hasMany(TourImage::class);
    }

}
