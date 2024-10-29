<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'cedula',
        'telefono',
        'id_rol',
        'id_estado',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the licitaciones for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licitaciones(): HasMany
    {
        return $this->hasMany(Licitacion::class, 'id_usuario', 'id');
    }

    /**
     * Get all of the trazabilidades made to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trazabilidades(): HasMany
    {
        return $this->hasMany(Trazabilidad::class, 'id_usuario', 'id');
    }

    /**
     * Get all of the trazabilidades made by the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trazabilidadesUsuario(): HasMany
    {
        return $this->hasMany(Trazabilidad::class, 'id_usuario_trazabilidad', 'id');
    }

    /**
     * Get the rol that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id');
    }

    /**
     * Get the estado that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'id_estado', 'id');
    }
}
