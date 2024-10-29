<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    use HasFactory;
    /**
     * Get all of the licitaciones for the estado
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licitaciones(): HasMany
    {
        return $this->hasMany(Licitacion::class, 'id_estado', 'id');
    }

    use HasFactory;
    /**
     * Get all of the usuarios for the estado
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'id_estado', 'id');
    }
}
