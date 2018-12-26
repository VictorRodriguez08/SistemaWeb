<?php

namespace sistemaWeb\Http\Controllers\Auth;

use sistemaWeb\User;
use Validator;
use sistemaWeb\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'administracion/usuario';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:100',
            'apellidos'=>'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'direccion'=>'required|max:200',
            'titulo'=>'required|max:100',
            'fecha_nac'=>'required',
            'dui'=>'required|max:10',
            'telefonos'=>'required|max:100',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'direccion' => $data['direccion'],
            'titulo' => $data['titulo'],
            'otros_estudios' => $data['otros_estudios'],
            'fecha_nac' => $data['fecha_nac'],
            'dui' => $data['dui'],
            'telefonos' => $data['telefonos'],
            'otros_email' => $data['otros_email'],
        ]);
    }

    public function showRegistrationForm()
    {
        return redirect('login');

    }
}
