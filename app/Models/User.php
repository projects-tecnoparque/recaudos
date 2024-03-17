<?php

namespace App\Models;

use App\Enums\BooleanStatus as StatusUserEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, HasRoles;


    protected $guard_name = 'api';

    protected $fillable = [
        'document_type_id', 'document', 'names', 'surnames',
        'email', 'email_verified_at', 'password', 'phone',
        'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => StatusUserEnum::class
    ];

    public $resourceType = 'users';

    /**
     * Get the customer associated with the user.
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }

    public function scopeDocument(Builder $query, $value)
    {
        $query->whereDocument($value);
    }

    public function scopeNames(Builder $query, $value)
    {
        $query->where('names','LIKE', "%{$value}%");
    }

    public function scopeSurnames(Builder $query, $value)
    {
        $query->where('surnames','LIKE', "%{$value}%");
    }

    public function scopeEmail(Builder $query, $value)
    {
        $query->whereEmail($value);
    }

    public function scopeStatus(Builder $query, $value)
    {
        $query->whereStatus($value);
    }

    public function scopeDocumentTypes(Builder $query, $documentTypes)
    {
        $query->whereHas('documentType', function($q) use($documentTypes){
            $q->whereIn('name', explode(',', $documentTypes));
        });
    }

    public function scopeRoles(Builder $query, $roles)
    {
        $query->whereHas('roles', function($q) use($roles){
            $q->whereIn('name', explode(',', $roles));
        });
    }

    public function scopeYear(Builder $query, $year)
    {
        $query->whereYear('created_at', $year);
    }

    public function scopeMonth(Builder $query, $month)
    {
        $query->whereMonth('created_at', $month);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
