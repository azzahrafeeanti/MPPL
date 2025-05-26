<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'event_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }
    public function events(): HasOne
    {
        return $this->hasOne(Event::class);
    }
}
