<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $fillable = 
    [
        'nameTorneo', 
        'numberTorneo',
        'dateTorneo',
        'statusTorneo', 
        'winnerTorneo'         
    ];
}
