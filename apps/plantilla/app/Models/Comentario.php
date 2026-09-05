<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Comentario extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'mnt_comentarios';
    protected $fillable = [
        'id_usuario',
        'id_tareas',
        'comentario'
    ];

    public function usuario(){
        $this->belongsTo(User::class, 'id_usuario','id');
    }
    public function tarea(){
        $this->belongsTo(Tarea::class,'id_tareas','id');
    }
}
