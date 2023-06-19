<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Users extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    // public $incrementing = true;
    protected $fillable = [
        'user_id',
        'name',
        'username',
        'password',
        'franchise_id'
    ];

    public function franchise(): BelongsTo
    {
        return $this->belongsTo(Franchise::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }
}
