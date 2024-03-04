<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellido',
        'razon_social',
        'cedula',
        'telefono',
        'pais',
        'ciudad'
    ];
    
}
