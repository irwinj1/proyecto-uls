<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Perfil extends Model
{
    //
    use HasFactory, HasRoles;

    protected $table = 'mnt_perfil';
    protected $fillable = [
        'nombres',
        'apellidos',
        'sexo',
        'fecha_nac',
        'id_usuario',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_usuario','id');
    }
    public function direcciones(){
        return $this->hasMany(Direccion::class, 'id_perfil', 'id');
    }
}
