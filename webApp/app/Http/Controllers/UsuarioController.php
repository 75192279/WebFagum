<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Musuario;
use App\Mpersona;
use Auth;
use Redirect;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Musuario::join('persona','users.idPersona','=','persona.id')
            ->join('rol','users.idrol','=','rol.id')
            ->select('users.id','persona.nombre', 'persona.apellido_paterno', 'persona.apellido_materno', 'persona.fecha_nacimiento', 'persona.genero','persona.tipo_documento','persona.numero_documento','persona.direccion','persona.telefono','users.usuario','users.correo','users.estado','users.idRol','rol.nombre as rol')
            ->orderBy('persona.id', 'desc')->paginate(3);
        }
        else{
            $personas = Musuario::join('persona','users.idPersona','=','persona.id')
            ->join('rol','users.idRol','=','rol.id')
            ->select('users.id','persona.nombre', 'persona.apellido_paterno', 'persona.apellido_materno', 'persona.fecha_nacimiento', 'persona.genero','persona.tipo_documento','persona.numero_documento','persona.direccion','persona.telefono','users.usuario','users.correo','users.estado','users.idRol','rol.nombre as rol')
            ->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();

            $persona = new Mpersona();
            $persona->nombre = $request->nombre;
            $persona->apellido_paterno = $request->apellido_paterno;
            $persona->apellido_materno = $request->apellido_materno;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->numero_documento = $request->num_documento;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->save();

            $user = new Musuario();
            $user->id = $persona->id;
            $user->idrol = $request->idrol;
            $user->usuario = $request->usuario;
            $user->correo = $request->correo;
            $user->idPersona = $persona->id;
            $user->password = bcrypt( $request->password);
            $user->estado = '1';            
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = Musuario::findOrFail($request->id);
            $persona = Mpersona::findOrFail($user->idPersona);
            $persona->nombre = $request->nombre;
            $persona->apellido_paterno = $request->apellido_paterno;
            $persona->apellido_materno = $request->apellido_materno;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->numero_documento = $request->num_documento;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->save();

            $user->idRol = $request->idrol;
            $user->usuario = $request->usuario;
            $user->correo = $request->correo;
            $user->password = bcrypt( $request->password);
            $user->estado = '1'; 
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = Musuario::findOrFail($request->id);
        $user->estado = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = Musuario::findOrFail($request->id);
        $user->estado = '1';
        $user->save();
    }
    public function selectCliente(Request $request){
        $buscar=$request->filtro;
        if ($buscar==''){
            $personas = Musuario::join('persona','users.idPersona','=','persona.id')
            ->join('rol','users.idrol','=','rol.id')
            ->select('users.id','persona.nombre', 'persona.apellido_paterno', 'persona.apellido_materno', 'persona.fecha_nacimiento', 'persona.genero','persona.tipo_documento','persona.numero_documento','persona.direccion','persona.telefono','users.usuario','users.correo','users.estado','users.idRol','rol.nombre as rol')
            ->orderBy('persona.id', 'desc')->get();
        }
        else{
            $personas = Musuario::join('persona','users.idPersona','=','persona.id')
            ->join('rol','users.idRol','=','rol.id')
            ->select('users.id','persona.nombre', 'persona.apellido_paterno', 'persona.apellido_materno', 'persona.fecha_nacimiento', 'persona.genero','persona.tipo_documento','persona.numero_documento','persona.direccion','persona.telefono','users.usuario','users.correo','users.estado','users.idRol','rol.nombre as rol')
            ->where('persona.nombre', 'like', '%'. $buscar . '%')
            ->where('users.usuario', 'like', '%'. $buscar . '%')
            ->orderBy('id', 'desc')->get();
            
        }
        return json_encode($personas);
    }
}
