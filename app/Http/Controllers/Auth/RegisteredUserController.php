<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Events\RegisteredUser;
use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cabang = Cabang::all();
        return view('auth.register', compact('cabang'));
    }

    public function createGuru(): View
    {
        return view('auth.register-guru');
    }

    public function createOrangTua(): View
    {
        return view('auth.register-orang-tua');
    }

    public function assignRole($user, $prevUrl)
    {
        switch ($prevUrl) {
            case 'orang-tua':
                $user->assignRole(Role::ORANGTUA);
                break;

            case 'guru':
                $user->assignRole(Role::GURU);
                break;

            default:
                $user->assignRole(Role::SISWA);
                break;
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        // get last path of previues url
        $prevUrl = explode('/', URL::previous());
        $prevUrl = end($prevUrl);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // condition for orang tua
        if ($prevUrl === 'orang-tua') {
            $request->validate([
                'student_email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'exists:users,email'],
                'hubungan' => ['required', 'string', 'max:255'],
            ]);

            // check if student email is already registered as student and if role is student then throw error
            $student = User::where('email', $request->student_email)->first();
            if (!$student->hasRole(Role::SISWA)) {
                return back()->withErrors(['student_email' => 'Email siswa tidak valid']);
            }

            unset($student);
        }

        // condition for guru
        if ($prevUrl === 'guru') {
            $request->validate([
                'rekening_bank' => ['required', 'string', 'max:255'],
                'no_rekening' => ['required', 'integer'],
                'no_wa' => ['required', 'integer'],
            ]);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->assignRole($user, $prevUrl);

        event(new Registered($user));
        event(new RegisteredUser($user, $request->all()));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
