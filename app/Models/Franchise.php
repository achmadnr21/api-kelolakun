<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\HasMany;

class Franchise extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'franchise';
    protected $primaryKey = 'franchise_id';
    // public $incrementing = true;
    protected $fillable = [
        'franchise_id',
        'owner_name',
        'owner_ktp',
        'address',
        'geo_lat',
        'geo_lon',
        'email',
        'phone_number'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(Users::class);
    }
}
