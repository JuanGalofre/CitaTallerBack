<?php

namespace App\Http\Controllers\api;

use App\Events\CitaGenerada;
use App\Exceptions\TokenErroneoException;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Cita;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CitasController extends Controller
{
    protected function encontrarUsuarioPorJWT()
    {
        $usuarioJWT = JWTAuth::user();
        if (!$usuarioJWT) {
            throw new TokenErroneoException();
        }

        return $usuarioJWT;
    }

    private $reglasDeValidacion = [
        'fecha' => 'required|string',
        'hora' => 'required|string',
        'descripcion' => 'required|string|min:6',
        'estado'=>'sometimes|string',
    ];

    public function index()
    {
        try {
            $usuario = $this->encontrarUsuarioPorJWT();

            if (Gate::allows('obtener-todas-citas')) {
                return response()->json(Cita::all());
            }else{
                return response()->json(Cita::where('user_id',$usuario->id)->get());
            }
        } catch (TokenErroneoException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $usuario = $this->encontrarUsuarioPorJWT();

            $dataValidada = $request->validate($this->reglasDeValidacion);

            $cita = new Cita($dataValidada);
            $cita->user_id = $usuario->id;
            $cita->save();

            event(new CitaGenerada($cita));

            return response()->json(['message' => "Cita registrada"]);

        } catch (ValidationException $e) {

            return response()->json([
                'error' => 'Error de validación',
                'details' => $e->errors()
            ], 422);

        } catch (TokenErroneoException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cita = Cita::findOrFail($id);

            return response()->json($cita);

        } catch (Exception $e) {
            return response()->json(['error' => 'No se encontró la cita'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $cita = Cita::findOrFail($id);

            $dataValidada = $request->validate($this->reglasDeValidacion);

            if (Gate::allows('editar-citas', $cita)) {
                $cita->update($dataValidada);
                return response()->json(['message' => 'Se ha editado la cita con exito'], 200);
            }

            return response()->json(['error' => 'No autorizado'], 403);
        } catch (ValidationException $e) {

            return response()->json([
                'error' => 'Error de validación',
                'details' => $e->errors()
            ], 422);
        } catch (TokenErroneoException $e) {
            return response()->json(['error' => $e->getMessage()], 401);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cita = Cita::findOrFail($id);
            if (Gate::allows('eliminar-citas')) {
                $cita->delete();
                return response()->json(['message' => 'Se ha eliminado la cita con exito'], 200);
            }
            return response()->json(['error' => 'No autorizado'], 403);

        } catch (TokenErroneoException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
