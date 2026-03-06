<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ["stops", "departure", "duration", "truck_id", "date"];

    public function truck(): BelongsTo
    {
        return $this->belongsTo(Truck::class);
    }
}
