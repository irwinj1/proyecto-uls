<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Municipio extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'ctl_municipio';
    protected $fillable = [
        'nombre',
        'id_departamento',
    ];
    public function departamento(){
        return $this->belongsTo(Departamento::class, 'id_departamento', 'id');
    }
    public function distritos(){
        return $this->hasMany(Distrito::class,'id_municipio', 'id');
    }
}
