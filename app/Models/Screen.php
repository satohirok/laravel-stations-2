<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Screen extends Model
{
    use HasFactory;
    
    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany(Schedule::class,'reservations');
    }

    public function sheets(): BelongsToMany
    {
        return $this->belongsToMany(Sheet::class,'reservations');
    }
}
