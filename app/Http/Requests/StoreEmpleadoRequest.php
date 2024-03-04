<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Empleados;

class StoreEmpleadoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'cedula' => 'required|numeric|unique:empleados,cedula',
            'telefono' => 'required|numeric',
            'pais' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'razon_social.required' => 'El campo razón social es obligatorio.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.numeric' => 'El campo cédula debe ser un número.',
            'cedula.unique' => 'La cédula ingresada ya está en uso.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.numeric' => 'El campo teléfono debe ser un número.',
            'pais.required' => 'El campo país es obligatorio.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
        ];
    }

    public function createEmpleado()
    {
        $datos = $this->validated();
        $empleado = Empleados::create([
            'nombre' => trim(strtolower($datos['nombre'])),
            'apellido' => trim(strtolower($datos['apellido'])),
            'razon_social' => trim(strtolower($datos['razon_social'])),
            'cedula' => trim(strtolower($datos['cedula'])),
            'telefono' => trim(strtolower($datos['telefono'])),
            'pais' => trim(strtolower($datos['pais'])),
            'ciudad' => trim(strtolower($datos['ciudad']))
        ]);

        return $empleado;
    }
}
