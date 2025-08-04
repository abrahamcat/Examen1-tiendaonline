<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    // Listar todas las marcas
    public function index()
    {
        $marcas = Marca::with('productos')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Marcas obtenidas exitosamente',
            'data' => $marcas
        ], 200);
    }

    // Crear nueva marca
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255|unique:marcas|min:2',], [
        'nombre.required' => 'El nombre de la marca es obligatorio',
        'nombre.min' => 'El nombre debe tener al menos 2 caracteres',
        'nombre.unique' => 'Ya existe una marca con este nombre'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $marca = Marca::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Marca creada exitosamente',
            'data' => $marca
        ], 201);
    }

    // Mostrar marca específica
    public function show($id)
    {
        $marca = Marca::with('productos')->find($id);

        if (!$marca) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Marca obtenida exitosamente',
            'data' => $marca
        ], 200);
    }

    // Actualizar marca
    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $marca->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Marca actualizada exitosamente',
            'data' => $marca
        ], 200);
    }

    // Eliminar marca
    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada'
            ], 404);
        }

        $marca->delete();

        return response()->json([
            'success' => true,
            'message' => 'Marca eliminada exitosamente'
        ], 200);
    }
}