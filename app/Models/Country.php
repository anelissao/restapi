<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capital',
        'population',
        'region',
        'subregion',
        'flag_url',
        'currency',
        'language',
        'motto',
    ];

    protected $casts = [
        'population' => 'integer',
    ];
}
