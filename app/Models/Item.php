<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'item';
    protected $primaryKey = 'item_id';
    // public $incrementing = true;
    protected $fillable = [
        'item_id',
        'name',
        'weight',
        'price',
        'category_id'
    ];

    // CATEGORY
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function package(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_item_details', 'item_id', 'package_id');
    }
}
