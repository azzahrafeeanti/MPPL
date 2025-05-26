<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'date',
        'gender',
        'NIK',
        'proof',
        'booking_trx_id',
        'is_paid',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'promo_id',
        'ticket_id'
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'TA';
        do {
            $randomString = $prefix . mt_rand(10000, 99999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    

}
