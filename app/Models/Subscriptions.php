<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Libraries\Zotlo\Response\Profile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Subscriptions extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'subscriberId',
        'subscriptionId',
        'subscriptionType',
        'country',
        'language',
        'status',
        'realStatus',
        'startDate',
        'expireDate',
        'renewalDate',
        'cancelDate',
        'cancelCode'
    ];

    protected $casts = [
        'startDate' => 'datetime',
        'expireDate' => 'datetime',
        'cancelDate' => 'datetime',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function transaction()
    {
        return $this->hasOne(Transactions::class, 'subscriptionId', 'id');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'subscriberId');
    }

    public function package()
    {
        return $this->hasOne(Packages::class, 'subscriptionId', 'id');
    }

    public static function getUserActiveByPackageId($package)
    {
        return self::with(['transaction', 'customer', 'package'])
            ->whereHas('package', fn($query) => $query->where('package', $package))
            ->where('subscriberId', Auth::id())
            ->where('realStatus', StatusEnum::ACTIVE->value)
            ->where('startDate', '<', Carbon::now()->toDateTimeString())
            ->where('expireDate', '>', Carbon::now()->toDateTimeString())
            ->first();
    }

    public static function getUserActiveById($id)
    {
        return self::with(['transaction', 'customer', 'package'])
            ->where('id', $id)
            ->where('subscriberId', Auth::id())
            ->where('realStatus', StatusEnum::ACTIVE->value)
            ->where('startDate', '<', Carbon::now()->toDateTimeString())
            ->where('expireDate', '>', Carbon::now()->toDateTimeString())
            ->first();
    }

    public static function getUserById($id)
    {
        return self::with(['transaction', 'customer', 'package'])
            ->where('id', $id)
            ->where('subscriberId', Auth::id())
            ->first();
    }

    public static function getUserBySubscriptionId($subscriptionId)
    {
        return self::where('subscriptionId', $subscriptionId)
            ->where('subscriberId', Auth::id())
            ->where('startDate', '<', Carbon::now()->toDateTimeString())
            ->where('expireDate', '>', Carbon::now()->toDateTimeString())
            ->first();
    }

    public static function addByProfileData(Profile $profile)
    {
        return self::create([
            'subscriberId' => Auth::id(),
            'subscriptionId' => $profile->getSubscriptionId(),
            'subscriptionType' => $profile->getSubscriptionType(),
            'country' => $profile->getCountry(),
            'language' => $profile->getLanguage(),
            'status' => $profile->getStatus(),
            'realStatus' => $profile->getRealStatus(),
            'startDate' => $profile->getStartDate(),
            'expireDate' => $profile->getExpireDate(),
            'renewalDate' => $profile->getRenewalDate(),
            'cancelDate' => $profile->getCancellation()->getDate(),
            'cancelCode' => $profile->getCancellation()->getCode(),
        ]);
    }

    public static function updateByProfileData(Profile $profile)
    {
        return self::where('subscriptionId', $profile->getSubscriptionId())->create([
            'subscriberId' => Auth::id(),
            'subscriptionId' => $profile->getSubscriptionId(),
            'subscriptionType' => $profile->getSubscriptionType(),
            'country' => $profile->getCountry(),
            'language' => $profile->getLanguage(),
            'status' => $profile->getStatus(),
            'realStatus' => $profile->getRealStatus(),
            'startDate' => $profile->getStartDate(),
            'expireDate' => $profile->getExpireDate(),
            'renewalDate' => $profile->getRenewalDate(),
            'cancelDate' => $profile->getCancellation()->getDate(),
            'cancelCode' => $profile->getCancellation()->getCode(),
        ]);
    }
}
