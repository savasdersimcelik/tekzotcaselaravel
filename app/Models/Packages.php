<?php

namespace App\Models;

use App\Libraries\Zotlo\Response\Package;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Packages extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'subscriptionId',
        'package',
        'price',
        'currency',
        'type',
        'name'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public static function addByPackageData($subscriptionId, Package $package)
    {
        return self::create([
            'subscriptionId' => $subscriptionId,
            'package' => $package->getPackageId(),
            'price' => $package->getPrice(),
            'currency' => $package->getCurrency(),
            'type' => $package->getPackageType(),
            'name' => $package->getName(),
        ]);
    }
}
