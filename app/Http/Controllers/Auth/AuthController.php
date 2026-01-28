<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        

       Log::info('HOLAAAAAAAAAAA');

        $request->validate([
            'cod_usuario' => 'required|string',
            'password'    => 'required|string',
        ]);

        

        $usuario = Usuario::where('cod_usuario', $request->cod_usuario)
            ->where('estado', 'A')
            ->first();

        Log::info('CHAUUUUUUUUUUUUUUUUU');

        if (! $usuario || ! Hash::check($request->password, $usuario->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        //$usuario->tokens()->delete();

        return response()->json([
            'usuario' => $usuario,
            'roles'   => $usuario->roles,
            'token'   => $usuario->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->usuario()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}

/*class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Lógica de inicio de sesión
        if( !Auth::attempt($request->only('cod_usuario', 'password')) ){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Usuario::where('cod_usuario', $request->cod_usuario)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hola '.$user->name.', bienvenido!!!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'userio' => $user,
        ]);
    }

    public function register(Request $request)
    {
        // Lógica de registro de usuario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        // Lógica de cierre de sesión
        // $request->user()->currentAccessToken()->delete();
        // auth()->user()->tokens()->delete();
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}*/
