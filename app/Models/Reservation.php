<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
