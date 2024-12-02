<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Licitacion extends Model
{
    use HasFactory;
    protected $table = 'licitaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_usuario',
        'id_cliente',
        'id_estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * Get the user that owns the licitacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    /**
     * Get the estado that owns the licitacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'id_estado', 'id');
    }

    /**
     * Get the estado that owns the licitacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    /**
     * Get all of the archivos for the Licitacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos(): HasMany
    {
        return $this->hasMany(Archivo::class, 'id_licitacion', 'id');
    }
}
