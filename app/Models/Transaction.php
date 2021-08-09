<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Traits\Uuids;

class Transaction extends Model
{
    use HasFactory;//, Uuids;

    protected $fillable = [
        'user_id',
        'total_amount',
        'paid_amount',
        'change_amount',
        'payment_method',
        'device_timestamp',
        'uuid'
    ];

    public function transaction_items(){
        return $this->hasMany('App\Models\TransactionItem');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

   
}
