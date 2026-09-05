<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Distrito extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'ctl_distrito';
    protected $fillable = [
        'nombre',
        'id_municipio',
    ];
    public function municipio(){
        return $this->belongsTo(Municipio::class, 'id_municipio', 'id');
    }
    public function direcciones(){
        return $this->hasMany(Direccion::class, 'id_distrito', 'id');
    }
}
