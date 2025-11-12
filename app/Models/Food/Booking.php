<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

     protected $table = 'bookings';

    protected $fillable = [
        'name',
        'email',
        'nbr_people',
        'date',
        'spe_request',
        'user_id'
    ];

    public $timestamps = true;
}
