<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'transaction_date',
        'amount'
    ];

    /**
     * generate route path for if need to 
     * change in future with slag of any means
     */

    public function path()
    {
        return "/transaction/{$this->id}";
    }

}
