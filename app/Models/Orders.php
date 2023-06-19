<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Orders extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    // public $incrementing = true;
    protected $fillable = [
        'order_id',
        'created_at',
        'modified_at',
        'status',
        'cost',
        'user_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }

    public function package(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'order_details', 'order_id', 'package_id');
    }


}
