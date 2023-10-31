<?php

namespace App\Services;

use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $result = [];
    protected $response;

    public function __construct()
    {
        $this->response = new ResponseService;
    }

    public function login(array $data)
    {

        $user = User::whereEmail($data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {

            // if (!Auth::attempt($credentials)) {

            $this->result['status'] = FALSE;
            $this->result['message'] = 'Invalid password or email, try again';

            return $this->response->AuthResponse($this->result);
        }

        $this->result['status'] =  TRUE;
        $this->result['message'] =  'User login successfully.';
        $this->result['token'] =   $user->createToken('auth_token')->plainTextToken;
        $this->result['user'] =  $user;


        return $this->response->AuthResponse($this->result);
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
        ]);

        if (!$user) {

            $this->result['status'] = FALSE;
            $this->result['message'] = 'User could not be created';

            return $this->response->AuthResponse($this->result);
        }

        $this->result['status'] =  TRUE;
        $this->result['message'] =  'User Created successfully, Please login.';
        $this->result['user'] =  $user;

        return $this->response->AuthResponse($this->result);
    }

    public function logout()
    {
    }

    // {
    //  "Authorization": "Bearer fhqpCrjZ0b4JWA0tcuOiXCjBTWX5ADtcHN17OVTw7685c83d"
    // }
}
