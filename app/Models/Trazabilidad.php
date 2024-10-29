<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trazabilidad extends Model
{
    use HasFactory;
    protected $table = 'trazabilidades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descripcion',
        'id_archivo',
        'id_licitacion',
        'id_usuario',
        'id_usuario_trazabilidad',
        'id_tipo_trazabilidad'
    ];

    /**
     * Get the user that made the trazabilidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userTrazabilidad(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario_trazabilidad', 'id');
    }

    /**
     * Get the user modified in the trazabilidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    /**
     * Get the archivo modified in the trazabilidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function archivo(): BelongsTo
    {
        return $this->belongsTo(Archivo::class, 'id_archivo', 'id');
    }

    /**
     * Get the licitacion modified in the trazabilidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licitacion(): BelongsTo
    {
        return $this->belongsTo(Licitacion::class, 'id_licitacion', 'id');
    }

    /**
     * Get the type of trazabilidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TipoTrazabilidad::class, 'id_tipo_trazabilidad', 'id');
    }
}
