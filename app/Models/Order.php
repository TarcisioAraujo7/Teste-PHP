<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'dt_order',
        'amount',
        'status',
        'id_product',
        'id_client'
    ];

}
