<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = 
    [
        'id_Torneo',
        'id_Match',
        'id_User',
        'points',
       // 'statusPoints'
    ];
}
