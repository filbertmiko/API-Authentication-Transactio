<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Traits\Uuids;

class TransactionItem extends Model
{
    use HasFactory, Uuids;

    protected $fillable =[
        'title',
        'qty',
        'price',
        'transaction_id',
        'uuid'
    ];

    public function transaction(){
        return $this->belongsTo('App\Models\Transaction');
    }

    public function getKeyName(){
        return 'uuid';
    }
}
