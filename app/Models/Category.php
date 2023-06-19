<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    // public $incrementing = true;
    protected $fillable = [
        'category_id',
        'name'
    ];

    // ITEM
    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }
    
}
