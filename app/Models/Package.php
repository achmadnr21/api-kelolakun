<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'package';
    protected $primaryKey = 'package_id';
    // public $incrementing = true;
    protected $fillable = [
        'package_id',
        'total_weight',
        'total_price'
    ];

    public function item(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'package_item_details', 'package_id', 'item_id');
    }

    public function warehouse(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_package_details', 'package_id', 'warehouse_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'order_details', 'package_id', 'order_id');
    }
}
