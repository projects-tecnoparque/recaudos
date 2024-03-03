<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sectional extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'operational_sector_id' ,'code', 'name', 'slug'
    ];
}
