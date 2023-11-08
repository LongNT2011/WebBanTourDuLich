<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function tour(){
        return $this->belongsToMany(Tour::class,'tour_site','site_id','tour_id');
    }

    public function hotel(){
        return $this->hasMany(Hotel::class);
    }
}
