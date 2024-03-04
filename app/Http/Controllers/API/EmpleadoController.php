<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleados;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private string $error_registro_existente = "Ya existe un empleado con cedula similar";
    private string $registro_no_encontrado = "El empleado no existe!";
    private string $registro_insertado = "Empleado insertado con exito!";
    private string $registro_no_insertado = "Empleado no insertado con exito!";
    private string $registro_editado = "Empleado editado con exito!";
    private string $registro_no_editado = "Empleado no editado con exito!";
    private string $registro_eliminado = "Empleado eliminado con exito!";
    private string $registro_no_eliminado = "Empleado no eliminado con exito!";
    private string $tipo_dato_incorrecto = "Tipo de dato incorrecto!";

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleados::all();
        return response()->json($empleados);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpleadoRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreEmpleadoRequest $request)
    {
        $empleado = Empleados::where('cedula', $request->cedula)->get();

        if (!$empleado->isEmpty()) {
            return response()->json(['successful' => false, 'message' => $this->error_registro_existente, 'data' => $empleado]);
        } else {
            $empleado = $request->createEmpleado();
            return response()->json(['successful' => true, 'message' => $this->registro_insertado, 'data' => $empleado]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleados  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $empleado = Empleados::find($request->id);
        return response()->json($empleado);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpleadoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $empleado = Empleados::find($id);
        if (empty($empleado)) {
            return response()->json(['successful' => false, 'message' => $this->registro_no_encontrado, 'data' => $empleado]);
        } else {
            $validatedData = $request->validate([
                'nombre' => 'required|max:255',
                'apellido' => 'required|max:255',
                'razon_social' => 'required|max:255',
                'cedula' => 'required|numeric',
                'telefono' => 'required|numeric',
                'pais' => 'required|max:255',
                'ciudad' => 'required|max:255',
            ]);

            $empleado = Empleados::where('id', $id)->update([
                'nombre' => trim(strtolower($validatedData['nombre'])),
                'apellido' => trim(strtolower($validatedData['apellido'])),
                'razon_social' => trim(strtolower($validatedData['razon_social'])),
                'cedula' => trim(strtolower($validatedData['cedula'])),
                'telefono' => trim(strtolower($validatedData['telefono'])),
                'pais' => trim(strtolower($validatedData['pais'])),
                'ciudad' => trim(strtolower($validatedData['ciudad']))
            ]);

            return response()->json(['successful' => true, 'message' => $this->registro_editado, 'data' => $empleado]);
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intVal($request->id);

        $empleado = Empleados::find($id);
        if (empty($empleado)) {
            return response()->json(['successful' => false, 'message' => $this->registro_no_encontrado, 'data' => $empleado]);
        } else {
            $empleado = $empleado->delete();
            return response()->json(['successful' => true, 'message' => $this->registro_eliminado, 'data' => $empleado]);
        }
    }
}
