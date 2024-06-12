<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:user,owner'],
            'phone' => ['nullable', 'string', 'max:15'],
            'gender' => ['nullable', 'in:male,female'],// Tambahkan validasi untuk peran
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'phone' => $data['phone'],
            'gender' => $data['gender']
        ]);

        // if ($data['role'] === 'owner') {
        //     Owner::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => Hash::make($data['password']),
        //         // Tambahkan kolom lain yang sesuai dengan struktur tabel 'owners'
        //     ]);
        // }

        return $user;
    }


    // Tambahkan method showRegistrationForm untuk menampilkan form registrasi dengan opsi peran
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Override method register untuk menambahkan opsi peran ke dalam request saat pendaftaran
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
