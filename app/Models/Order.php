<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    const created_at = null;
    const updated_at = null;
    protected $fillable = ['orderDate', 'totalAmount', 'participantNumber', 'name', 'phone', 'email', 'paymentStatus', 'tour_id', 'user_id'];

    public function tour(){
        return $this->belongsTo(Tour::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
