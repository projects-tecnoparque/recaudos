<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id','code', 'address', 'neighborhood', 'area',
    ];

    public $resourceType = 'customers';

    /**
     * Get the user that owns the customer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDocument(Builder $query, $value)
    {
        $query->whereHas('user', function($q) use($value){
            $q->where('document', $value);
        });
    }

    public function scopeNames(Builder $query, $value)
    {
        $query->whereHas('user', function($q) use($value){
            $q->where('names','LIKE', "%{$value}%");
        });
    }

    public function scopeSurnames(Builder $query, $value)
    {
        $query->whereHas('user', function($q) use($value){
            $q->where('surnames','LIKE', "%{$value}%");
        });
    }

    public function scopeEmail(Builder $query, $value)
    {
        $query->whereHas('user', function($q) use($value){
            $q->where('email', $value);
        });
    }

    public function scopeStatus(Builder $query, $value)
    {
        $query->whereHas('user', function($q) use($value){
            $q->where('status', $value);
        });
    }

    public function scopeCode(Builder $query, $value)
    {
        $query->whereCode($value);
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
