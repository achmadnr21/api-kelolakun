<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
    // public $incrementing = true;
    protected $fillable = [
        'warehouse_id',
        'geo_lat',
        'geo_lon',
        'email',
        'phone_number',
        'address'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }

    public function package(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'warehouse_package_details', 'warehouse_id', 'package_id');
    }
}
