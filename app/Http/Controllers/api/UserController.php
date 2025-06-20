<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $dataValidada = $validator->validated();

        $hash = Hash::make($dataValidada['password']);
        $usuario = User::create([
            'nombre' => $dataValidada['nombre'],
            'email' => $dataValidada['email'],
            'password' => $hash,
        ]);

        //Carga el rol por default.
        $usuario = $usuario->fresh();

        $token = JWTAuth::customClaims([
            'id' => $usuario->id,
            'rol' => $usuario->rol,
            'created_at' => $usuario->created_at,
        ])->fromUser($usuario);

        return response()->json([
            'token' => $token
        ], 201);



    }
    public function login(Request $request)
    {

        $credenciales = $request->only('email', 'password');


        try {
            $token = JWTAuth::attempt($credenciales);
            if (!$token) {
                return response()->json(['error' => 'No autorizado'], 401);
            } 
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo generar un token'], 500);
        }catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Salida segura']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falló la salida segura'], 500);
        }
    }


}
