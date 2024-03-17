<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role AS RoleSpatie;

class Role extends RoleSpatie
{
    protected $hidden = ['pivot', 'id'];


    public function scopeName(Builder $query, $value)
    {
        $query->whereName($value);
    }
}
