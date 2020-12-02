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



}
