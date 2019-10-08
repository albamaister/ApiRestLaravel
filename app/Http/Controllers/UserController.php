<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller {

    public function login(Request $request) {
        $jwtAuth = new \JwtAuth();
        
        $email = 'bryanalba@gmail.com';
        $password = '1234';
        
        $pwd = hash('sha256', $password);
        
       
        return response() -> json($jwtAuth -> signup($email,$pwd, true), 200);
    }

    public function pruebas(Request $request) {
        return "Accion de pruebas de userController";
    }

    public function register(Request $request) {

        // Esta url que al final estara lista va a ser consumida y llamada desde el frontend
        // Recoger los datos del usuario por post

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);


        if (!empty($params) && !empty($params_array)) {



            // Limpiar datos

            $params_array = array_map('trim', $params_array);

            //Validar datos 

            $validate = \Validator::make($params_array, [
                        'name' => 'required|alpha',
                        'surname' => 'required|alpha',
                        'email' => 'required|email|unique:users', // Comprobar si el usuario existe(duplicado)
                        'password' => 'required'
            ]);

            if ($validate->fails()) {
                // Validacion a fallado
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se a creado',
                    'errors' => $validate->errors()
                );
            } else {
                // Validacion pasada correctamente 
                // Cifrar la contrasenia
                 $pwd = hash('sha256', $params -> password);
                
                // Crear el usuario 
                
                $user = new User();
                
                $user -> name = $params_array['name'];
                $user -> surname = $params_array['surname'];
                $user -> email = $params_array['email'];
                $user -> password = $pwd;
                $user -> role = 'ROLE_USER';
                
                
                
                // Guardar el usuario
                $user -> save();
                
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se a creado correctamente',
                    'user' => $user
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            );
        }







        return response()->json($data, $data['code']);


//        $name = $request -> input('name');
//        $surname = $request -> input('surname');
//        
//        return "Accion de registro de usuario $name $surname";
    }

}
