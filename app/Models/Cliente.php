<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'no_identificacion',
        'telefono',
        'email',
    ];


    /**
     * Get all of the licitaciones for the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licitaciones(): HasMany
    {
        return $this->hasMany(Licitacion::class, 'id_cliente', 'id');
    }
}
