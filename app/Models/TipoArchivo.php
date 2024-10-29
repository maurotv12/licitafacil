<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoArchivo extends Model
{
    use HasFactory;
    /**
     * Get all of the archivos for the TipoArchivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos(): HasMany
    {
        return $this->hasMany(Archivo::class, 'id_tipo_archivo', 'id');
    }
}
