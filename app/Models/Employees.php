<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// RELATION
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employees extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    // public $incrementing = true;
    protected $fillable = [
        'employee_id',
        'warehouse_id',
        'name',
        'username',
        'password',
        'role'
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
