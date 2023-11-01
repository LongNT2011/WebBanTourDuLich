<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function tour(){
        return $this->belongsTo(Site::class);
    }
    public function tourDetail(){
        return $this->hasMany(TourDetail::class);
    }
    public function tourImage(){
        return $this->hasMany(TourImage::class);
    }
}
