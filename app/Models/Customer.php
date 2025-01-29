<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Order;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'since',
        'revenue',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
