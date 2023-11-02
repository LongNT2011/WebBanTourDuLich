<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourSite extends Model
{
    use HasFactory;
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
