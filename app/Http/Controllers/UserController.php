<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Response;
use App\Models\User as Model;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    function register(Request $request) {
        $validation = \Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required',
            'telepon' => 'required|numeric',
            'password' => 'required',
        ]);
        if ($validation->fails()) return Response::error('Silahkan isi form dengan sesuai!', ['validation' => $validation->errors()]);

        $isAlreadyExists = Model::whereEmail($request->email)->first();
        if ($isAlreadyExists) return Response::error('Email already exists!');

        $request['role'] = 99;
        $request['password'] = bcrypt($request->password);
        $user = Model::create($request->all());
        return Response::success('You have been successfully registered!', $user);
    }

    function login(Request $request) {
        $validation = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validation->fails()) return Response::error('Please fill your username and password', ['validation' => $validation->errors()], 'AUTH-VALIDATION');
        
        // Check user email
        $user = Model::whereEmail($request->email)->first();
        if (!$user) return Response::error('Email invalid!');
        
        // Check user password
        $isPasswordMatch = \Hash::check($request->password, $user->password);
        if(!$isPasswordMatch) return Response::error('Password invalid!'); 
        
        // Create token
        $secret = config('app.jwt_secret');
        $token = JWT::encode([
            'id' => $user->id,
            'nama_lengkap' => $user->nama_lengkap,
            'email' => $user->email,
            'role' => $user->role,
        ], $secret);

        return Response::success('Login success!', [ 
            'user' => $user, 
            'token' => $token 
        ]);
    }
}
