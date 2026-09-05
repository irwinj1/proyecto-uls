<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Direccion extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'mnt_direccion';
    protected $fillable = [
        'direccion',
        'id_distrito',
        'id_perfil',
    ];
    public function distrito(){
        return $this->belongsTo(Distrito::class, 'id_distrito', 'id');
    }
    public function perfil(){
        return $this->belongsTo(Perfil::class, 'id_perfil', 'id');
    }
}
