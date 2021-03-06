<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'avatar'
    ];

    /**
     * generate route path for if need to 
     * change in future with slag of any means
     */
    public function path()
    {
        return "/client/{$this->id}";
    } 

    /**
     * @return joined name
     */

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /**
     * Get the Transactions for the client.
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivity($query, $take)
    {
        return $query->withCount('transactions')
                    ->withSum('transactions', 'amount')
                    // ->latest()
                    ->limit($take);
    }

    public function currentBalance()
    {
        return $this->loadSum('transactions','amount')->transactions_sum_amount;
    }

    public function photopath()
    {
        // dd('/' . $this->avatar);
        return '/' . $this->avatar;
    }

}
