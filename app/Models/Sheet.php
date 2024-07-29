<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sheet extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'column',
        'row'
    ];

    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany(Schedule::class,'reservations');
    }
}
