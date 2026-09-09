<?php

namespace App\Http\Controllers\Api\Perfil;

use App\Http\Controllers\Controller;
use App\Models\Direccion;
use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\User;
use App\Response\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PerfilController extends Controller
{
    //
    public function index(Request $request){
        try {
            $perfiles = Perfil::with([
                'user',
                'direcciones'
            ]);
            

            if($request->has('nombres')){
                $perfiles->where('nombres','ILIKE','%'.$request->nombres.'%');
            }

            $perfiles->when($request->filled('apellidos'),function($query) use($request){
                return $query->where('apellidos','ilike','%'.$request->apellidos.'%');
            });

            //termina ejecucion de eloquent
            $perfilPaginate =$perfiles->paginate(10);
            
            
            //metodo para formatear cosulta que se hizo con eloquent
            $perfilesFormat = $perfilPaginate->map(function($perfil){
                return [
                    'id'=>$perfil->id,
                    'nombres'=>$perfil->nombres,
                    'apellidos'=>$perfil->apellidos,
                    'sexo'=>$perfil->sexo,
                    'fecha_nac'=>$perfil->fecha_nac,
                    'email' => $perfil->user->email,
                    'verificacion' => $perfil->user->email_verified_at
                ];
            });
            $pagination = [
                'current_page'=>$perfilPaginate->currentPage(),
                'last_page'=>$perfilPaginate->lastPage(),
                'per_page'=>$perfilPaginate->perPage(),
                'total'=>$perfilPaginate->total()
            ];
            return ApiResponse::success('Perfiles',200,$perfilesFormat,$pagination);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al obtener los perfiles'.$e->getMessage());
        }
    }

    public function crearPerfil(Request $request){
        try {
            $messages = [
                'nombres.required'=>'Los nombres son requeridos',
                'nombres.string'=>'Los nombres solo deben tener texto',
                'nombres.max'=>'Los nombres deben tener un maximo de 150 caracteres',
                'nombres.min'=>'Los nombres deben tener un minimo de 3 caracteres',
                'apellidos.required'=>'Los apellidos son requeridos',
                'apellidos.string'=>'Los apellidos solo deben tener texto',
                'apellidos.max'=>'Los apellidos deben tener un maximo de 150 caracteres',
                'apellidos.min'=>'Los apellidos deben tener un minimo de 3 caracteres',
                'sexo.max'=>'El sexo debe tener un maximo de 10 caracteres',
                'sexo.min'=>'El sexo debe tener un minimo de 1 caracter',
                'fechaNac.required'=>'La fecha de nacimiento es requerida',
                'fechaNac.date'=>'La fecha de nacimiento debe ser una fecha valida',
                'email.required'=>'El email es requerido',
                'email.email'=>'El email debe ser un email valido',
                'email.unique'=>'El email ya esta en uso',
                'direccion.required'=>'La direccion es requerida',
                'direccion.min'=>'La direccion debe tener un minimo de 10 caracteres',
                'direccion.max'=>'La direccion debe tener un maximo de 1500 caracteres',
                'id_distrito.required'=>'El distrito es requerido',
                'id_distrito.exists'=>'El distrito no existe',
                'roles.required'=>'El rol es requerido',
                'roles.exists'=>'El rol no existe',
                'permissions.array'=>'Las permisos deben ser un array',
                'permissions.*.exists'=>'El permiso no existe',
            ];
            $validator = Validator::make($request->all(),[
                'nombres' => 'required|string|max:150,min:3',
                'apellidos' => 'required|string|max:150,min:3',
                'sexo' => 'nullable|max:10,min:1',
                'fechaNac' => 'required|date',
                'email' => 'required|email|unique:users,email',
                'direccion'=>'required|min:10|max:1500',
                'id_distrito'=>'required|exists:ctl_distrito,id',
                'roles'=>'required|exists:roles,name',
                'permissions'=>'nullable|array',
                'permissions.*'=>'nullable|exists:permissions,name',
            ],$messages);
            
            if($validator->fails()){
                return ApiResponse::error($validator->errors()->first(),422);
            }
            DB::begginTansaction();

            //creacion usuario
              $user = User::create([
                'name'=>$request->nombres,
                'email'=>$request->email,
                'password'=>123456,
              ]);
//actualizacion o creacion de perfil
              $nuevoPerfil = [
                'nombres'=>$request->nombres,
                'apellidos'=>$request->apellidos,
                'sexo'=>$request->sexo,
                'fecha_nac'=>$request->fechaNac,
                'id_usuario'=>$user->id
              ];
               $perfil = Perfil::updateOrCreate([
                'id'=>$id
              ],$nuevoPerfil);

              Direccion::create([
                'direccion'=>$request->direccion,
                'id_distrito'=>$request->id_distrito,
                'id_perfil'=>$perfil->id
              ]);

            DB::commit();   

             return ApiResponse::success('Perfil creado correctamente',201);
        } catch (\Exception $e) {
            //throw $th;
            return ApiResponse::error('Error al crear el perfil '.$e->getMessage());
        }
    }
    
}
