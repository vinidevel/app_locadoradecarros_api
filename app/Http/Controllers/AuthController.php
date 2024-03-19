<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login(Request $request) {
    $credenciais = $request->all(['email', 'password']);


        //autenticacao email e senha

      $token =   auth('api')->attempt( $credenciais);

      if ($token) { //usuário auteticado com sucess
       return response()->json(['token' =>$token]);
      } else {
        return response()->json(['erro' => 'Usuario ou senha invalidos'], 403);
      }

      //401 = Unauthorized -> não autorizado
      //403 = forbidden ->proibido (login inválido)
      
      dd($token);

        return 'login';
    }

    public function logout() {
        // return 'logout';
        auth('api')->logout();
       return response()->json(['msg' => 'Logout foi realizado com sucesso']);
       
    }

    public function refresh() {
      $token = auth('api')->refresh(); //client encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }

    public function me() {
      // dd(auth()->user());
        return response()->json(auth()->user());
    }
}
