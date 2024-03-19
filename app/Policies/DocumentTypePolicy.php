<?php

namespace App\Policies;

use App\Models\DocumentType;
use App\Models\User;

class DocumentTypePolicy
{
    /**
     * Determine if the given post can be updated by the user.
     */
    public function index(User $user): bool
    {
        return $user->can('leer tipos documentos');
    }
}
