<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'birthdate',
        'zip_code',
        'address',
        'address_number',
        'district',
        'complement',
        'city',
        'uf',
        'user_id',
        'password',
    ];

    protected $dates = [
        'birthdate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function records()
    {
        return $this->hasMany(Records::class);
    }

    public function Role()
    {
        return $this->belongsTo(Roles::class);
    }

}
