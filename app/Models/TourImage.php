<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function tourdetail(){
        return $this->belongsTo(TourDetail::class);
    }
}
