<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        $this->belongsTo(User::class,'id_usuario','id');
    }
    public function tareas(){
        $this->hasMany(Tarea::class,'id_proyecto','id');
    }

}
