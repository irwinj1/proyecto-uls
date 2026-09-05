<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Departamento extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'ctl_departamento';
    protected $fillable = [
        'nombre',
        'id_pais',
    ];
    public function pais(){
        return $this->belongsTo(Pais::class, 'id_pais', 'id');
    }
    public function municipios(){
        return $this->hasMany(Municipio::class, 'id_departamento', 'id');
    }
}
