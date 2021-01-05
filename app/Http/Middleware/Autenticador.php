<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Autenticador
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Verifica se a requisição possui o cabeçalho 'Authorization'
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }

            // Pega o conteúdo do cabeçalho 'Authorization'
            $authorizationHeader = $request->header('Authorization');

            // Retira o 'Bearer ' do início do token proveniente de authorizationHeder
            $token = str_replace('Bearer ', '', $authorizationHeader);

            // Decodifica o token
            $dadosAutenticacao = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            // Busca o usuário
            $user = User::where(
                            'email',
                            $dadosAutenticacao->email
                        )
                        ->first();

            // Verfica se há um usuário válido
            if (is_null($user)) {
                throw new \Exception();
            }

            // Permite a requisição prosseguir
            return $next($request);

        } catch(\Exception $e) {

            return response()->json('Não autorizado.', 401);

        }

    }
}
