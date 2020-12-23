<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        // Validação dos campos
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Recuperar o Usuário
        $usuario = User::where('email', $request->email)->first();

        // Verifica se há usuário e se a senha é válida
        if (is_null($usuario)
            || !Hash::check($request->password, $usuario->password)) {
            return response()->json('Usuário ou senha inválidos.', 401);
        }

        // Cria o token
        $token = JWT::encode(
                                ['email' => $request->email],
                                env('JWT_KEY')
                            );

        // Retorna um token
        return [
            'access_token' => $token
        ];
    }
}
