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
        'social_media_account',
        'agree_handbook',
        'proof',
        'booking_trx_id',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'event_id',
        'user_id'
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'TA';
        do {
            $randomString = $prefix . mt_rand(10000, 99999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
