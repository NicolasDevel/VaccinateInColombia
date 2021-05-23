<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_vaccinations',
        'people_vaccinated',
        'people_fully_vaccinated',
        'daily_vaccinations_raw',
        'total_vaccinations_per_hundred',
        'people_vaccinated_per_hundred',
        'people_fully_vaccinated_per_hundred',
        'daily_vaccinations_per_million',
    ];
}
