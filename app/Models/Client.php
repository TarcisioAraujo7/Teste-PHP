<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'name',
        'surname',
        'cpf',
        'email'
    ];

}
