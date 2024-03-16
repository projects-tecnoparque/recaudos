<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class DocumentType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'abbreviation', 'name'
    ];

    public $resourceType = 'document-types';

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'document_type_id', 'id');
    }

    public function scopeYear(Builder $query, $year)
    {
        $query->whereYear('created_at', $year);
    }

    public function scopeMonth(Builder $query, $month)
    {
        $query->whereMonth('created_at', $month);
    }
}
