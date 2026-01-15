<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['poli_id', 'name', 'schedule_day', 'start_time', 'end_time'];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }
}
