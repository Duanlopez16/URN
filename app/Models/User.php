<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property $id
 * @property $uuid
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $rol_id
 * @property $tipo_documento_id
 * @property $documento
 * @property $direccion
 * @property $telefono
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @property Rol $rol
 * @property TipoDocumento $tipoDocumento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static $rules = [
        'uuid' => 'required',
        'name' => 'required',
        'email' => 'required',
        'rol_id' => 'required',
    ];

    /**
     * perPage
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rol()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rol_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function TipoDocumento()
    {
        return $this->hasOne('App\Models\TipoDocumento', 'id', 'rol_id');
    }
}
