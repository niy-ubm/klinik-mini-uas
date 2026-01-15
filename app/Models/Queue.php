<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'doctor_id', 
        'appointment_date', 
        'queue_number', 
        'complaint', 
        'status'
    ];

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
