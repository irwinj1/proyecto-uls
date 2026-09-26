<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Proyecto extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'mnt_proyectos';

    protected $fillable = [
        'id_usuario',
        'titulo',
        'descripcion',
        'estado'
    ];
    public function usuario(){
        return$this->belongsTo(User::class,'id_usuario','id');
    }
    public function tareas(){
        return $this->hasMany(Tarea::class,'id_proyecto','id');
    }

}
