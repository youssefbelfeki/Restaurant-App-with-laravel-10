<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkouts';

    protected $fillable = [
        'name',
        'email',
        'country',
        'town',
        'address',
        'phone',
        'zipcode',
        'price',
        'status',
        'user_id'
    ];

    public $timestamps = true;
}
