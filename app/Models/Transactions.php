<?php

namespace App\Models;

use App\Libraries\Zotlo\Response\Payment;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transactions extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'subscriptionId',
        'originalTransactionId',
        'lastTransactionId',
        'providerTransactionId',
        'paymentHash',
        'paymentProvider',
        'providerStatus',
        'paymentStatus',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    public static function addByTransactionData($subscriptionId, Payment $payment){
        return self::create([
            'subscriptionId' => $subscriptionId,
            'originalTransactionId' => $payment->getTransactionId(),
            'lastTransactionId' => $payment->getTransactionId(),
            'providerTransactionId' => $payment->getProviderTransactionId(),
            'paymentProvider' => $payment->getPaymentProvider(),
            'providerStatus' => $payment->getProviderStatus(),
            'paymentStatus' => $payment->getPaymentStatus(),
        ]);
    }
}
