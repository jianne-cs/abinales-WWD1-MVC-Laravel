<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name', 
        'username',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'purchased_items'
    ];

    /**
     * Get the orders for the customer.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the total spent attribute.
     */
    public function getTotalSpentAttribute()
    {
        return $this->orders()->where('status', 'completed')->sum('total_amount');
    }

    /**
     * Get the orders count attribute.
     */
    public function getOrdersCountAttribute()
    {
        return $this->orders()->count();
    }
}