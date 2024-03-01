<?php

namespace App\Models;

use Spatie\Permission\Models\Role AS RoleSpatie;

class Role extends RoleSpatie
{
    protected $hidden = ['pivot', 'id'];
}
