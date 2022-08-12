<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'order_details', 'id_product', 'id_order');
    }

    /**
     * Get the user associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clients(): HasOne
    {
        return $this->hasOne(Clients::class, 'id', 'id_client');
    }

}
