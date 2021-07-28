<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    protected $fillable = 
    [
        'idMatch', 
        'idTorneo',
        'idUser',
        'goalMore', 
        'goalLess',
        'points',
        'statusResult' 
    ];
    
}
