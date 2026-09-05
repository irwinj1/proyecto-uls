<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'ctl_pais';
    protected $fillable = [
        'nombre',
    ];
  
    public function departamentos(){
        return $this->hasMany(Departamento::class, 'id_pais', 'id');
    }
}
