<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoTrazabilidad extends Model
{
    use HasFactory;
    protected $table = 'tipo_trazabilidades';

    /**
     * Get all of the trazabilidades for the TipoTrazabilidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Trazabilidad::class, 'id_tipo_trazabilidad', 'id');
    }
}
