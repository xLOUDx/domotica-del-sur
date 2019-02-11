<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'lastname' => '0',
            'rut' => '0',
            'address' => '0',
            'company' => '0',
            'company_rut' => '0',
            'discount' => '0',
            'privileges' => '0',
            'password' => Hash::make($data['password']),
        ]);
    }

    /*protected function createUser(Request $request){
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'lastname' => $request['lastname'],
            'rut' => $request['rut'],
            'address' => $request['address'],
            'company' => $request['company'],
            'company_rut' => $request['company_rut'],
            'discount' => $request['discount'],
            'privileges' => $request['privileges'],
            'password' => Hash::make($request['password']),
        ]);
    }*/
}
