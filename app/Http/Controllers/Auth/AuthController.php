<?php

namespace App\Http\Controllers\Auth;

use App\User;
use SearchIndex;
use Validator;
use App\Http\Controllers\Controller;
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
     * Login path is the default homepage
     * @var string
     */
    protected $loginPath = '/';

    /**
     * Logout path is the default homepage
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Name of the form element that correspond to email
     * @var string
     */
    protected $username = 'email';

    /**
     * Redirect to home
     * @var string
     */
    protected $redirectPath = '/home';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'getRegister', 'postRegister']]);
        $this->middleware('admin', ['only' => ['getRegister', 'postRegister']]);
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
            'role' => 'required',
            'password' => 'required'
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
            'email' => $data['email'],
            'role' => $data['role'],
            'remember_token' => str_random(100),
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param User $user
     */
    protected function createElasticAccount(User $user)
    {
        SearchIndex::upsertToIndex($user);
    }
}
