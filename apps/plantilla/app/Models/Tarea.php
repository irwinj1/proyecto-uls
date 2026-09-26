<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Tarea extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'mnt_tareas';
    protected $fillable = [
        'id_usuario',
        'id_asignado',
        'id_proyecto',
        'titulo',
        'descripcion',
        'prioridad',
        'fecha_finalizacion',
    ];
    public function usuarioCreador(){
        return $this->belongsTo(User::class, 'id_usuario','id');
    }
    public function asignado(){
        return $this->belongsTo(User::class, 'id_asignado','id');
    }
    public function proyectos(){
        return $this->belongsTo(Proyecto::class,'id_proyecto','id');
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class, 'id_tareas','id');
    }
}
