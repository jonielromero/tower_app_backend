<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'cod_usuario';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cod_usuario',
        'cod_persona',
        'password',
        'estado',
    ];

    protected $hidden = [
        'password',
    ];

    // Relación muchos a muchos con roles
    public function roles()
    {
        return $this->belongsToMany(
            Rol::class,
            'usu_roles',
            'cod_usuario',
            'cod_rol'
        )->withPivot('activo')->withTimestamps();
    }
}
