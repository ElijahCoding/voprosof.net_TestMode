<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $name = $user->name;
        $email = $user->email;

        $newUser = User::create([
          'name' => $user->name,
          'email' => $user->email,
          'password' => 'password'
        ]);

        if ($user->token) {
          return redirect()->route('password.reset', ['user' => $newUser]);
        } else {
          return redirect()->route('login');
        }

    }

    public function reset(User $user)
    {
      return view('auth.reset', compact('user'));
    }

    public function update(User $user)
    {

    }
}
