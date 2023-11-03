<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tourimages';
    protected $fillable = ['imageUrl', 'tour_detail_id'];

    public function tourdetail(){
        return $this->belongsTo(TourDetail::class,'tour_detail_id');
    }
}
