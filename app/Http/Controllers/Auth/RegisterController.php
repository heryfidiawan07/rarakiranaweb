<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use App\Mail\RarakiranaRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function register(Request $request)
    {           
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
            ?: redirect('/login')->with('warning', 'Buka email anda untuk verifikasi akun !');
    }

    protected function create(array $data)
    {   
        $slug = str_slug($data['name']);
        $cekslug = User::where('slug', $slug)->first();
        if ($cekslug > 0) {
            $slug = $slug.'-'.date("YmdHis");
        }
        $user = User::create([
            'name' => $data['name'],
            'slug' => $slug,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(50),
        ]);
        // mengirim email
        Mail::to($user->email)->send(new RarakiranaRegister($user));
    }

    // verifikasi regiter token user dengan email
    public function verify_register($token, $id){
        $user = User::find($id);
        if (!$user) {
            return redirect('/login')->with('warning', 'How are you ?');
        }
        if ($user->token != $token) {
            return redirect('/login')->with('warning', 'What are you doing ?');
        }
        $user->status = 1;
        $user->save();

        $this->guard()->login($user);
        return redirect('/');
    }
}
