<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Orders::class, 'order_details', 'id_order', 'id_product');
    }

    /**
     * Get the user associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clients(): HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'id_category');
    }
}
