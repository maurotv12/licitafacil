<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archivo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'ruta',
        'id_tipo_archivo',
        'id_licitacion'
    ];

    use HasFactory;
    //
    /**
     * Get the tipo that owns the archivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo(): BelongsTo
    {
        return $this->belongsTo(TipoArchivo::class, 'id_tipo_archivo', 'id');
    }

    /**
     * Get the licitacion that owns the archivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licitacion(): BelongsTo
    {
        return $this->belongsTo(Licitacion::class, 'id_licitacion', 'id');
    }
}
