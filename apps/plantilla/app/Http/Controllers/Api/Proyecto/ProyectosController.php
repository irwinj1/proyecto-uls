<?php

namespace App\Http\Controllers\Api\Proyecto;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Response\ApiResponse;
use Illuminate\Support\Facades\Validator;

class ProyectosController extends Controller
{
    //

    public function index(Request $request){
        try {
          $proyectos = Proyecto::with(['usuario']);
          if($request->has('titulo')){
            $proyectos->where('titulo','ilike','%'.$request->titulo.'%');
          }
          $proyectosPaginated = $proyectos->paginate(10);
          $paginationData = [
            'current_page' => $proyectosPaginated->currentPage(),
            'last_page' => $proyectosPaginated->lastPage(),
            'per_page' => $proyectosPaginated->perPage(),
            'total' => $proyectosPaginated->total(),
            ];
            
            $proyectosFormated = $proyectosPaginated->map(function ($proyecto) {
                return [
                    'id' => $proyecto->id,
                    'titulo' => $proyecto->titulo,
                    'descripcion' => $proyecto->descripcion,
                    'estado' => $proyecto->estado,
                    'usuario' => [
                        'name' => $proyecto->usuario->name,
                        'email' => $proyecto->usuario->email,
                    ],
                ];
            });
          return ApiResponse::success('listado de proyectos',200, $proyectosFormated,$paginationData);

        } catch (\Exception $e) {
            return ApiResponse::error('Error al obtener los proyectos',500);
        }
    }
    public function mostrarproyecto(Request $request, $id){
        try{
            $proyecto = Proyecto::with(['usuario'])->where('id', $id)->first();

            return ApiResponse::success('Proyecto encontrado',200,$proyecto);
        }catch (\Exception $e) {
            return ApiResponse::error('Error al mostrar el proyecto',500);
        }
    }
    public function crearProyecto(Request $request,$id=null){
        try {
            $validator = Validator::make($request->all(),[
                'titulo'=>'nullable|max:150',
                'descripcion'=>'nullable|max:1000',
            ],[
                'titulo.nullable'=>'El titulo es opcional',
                'titulo.max'=>'El titulo no debe exceder los 150 caracteres',
                'descripcion.nullable'=>'La descripcion es opcional',
                'descripcion.max'=>'La descripcion no debe exceder los 1000 caracteres',
            ]);

            if($validator->fails()){
                return ApiResponse::error($validator->errors()->first(),422);
            }
            \DB::beginTransaction();
                $data = [];
                if($request->has('titulo')){
                    $data['titulo'] = $request->input('titulo');
                }
                if($request->has('descripcion')){
                    $data['descripcion'] = $request->input('descripcion');
                }
               $proyecto = Proyecto::updateOrCreate(
                [
                  'id'=> $id
                ],$data
               );
            \DB::commit();
            $message = $id ? 'Proyecto actualizado correctamente' : 'Proyecto creado correctamente';
            return ApiResponse::success($message,200,$proyecto);
        } catch (\Exception $e) {
            \DB::rollBack();
            return ApiResponse::error('Error al crear el proyecto',500);
        }
    }
    public function actualizarEstado(Request $request, $id){
        try{
            \DB::beginTransaction();
            $proyecto = Proyecto::find($id);
            $proyecto->estado = !$proyecto->estado;
            \DB::commit();
            $proyecto->save();
            return ApiResponse::success('Estado del proyecto actualizado correctamente',200,$proyecto);
        }catch (\Exception $e) {
            return ApiResponse::error('Error al actualizar el estado del proyecto',500);
        }
    }
}
