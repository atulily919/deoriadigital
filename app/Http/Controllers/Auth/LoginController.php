<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller {
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

	// protected $redirectTo = '/home';
	public function redirectTO() {
		$user_status = Auth::User()->admin_status;
		$status = Auth::User()->Status;
		if ($status == 'Active') {
			if ($user_status == 1) {
				return '/home';
			} else {
				return '/centralclient';
			}
		} else {
			return '/';
		}

	}

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

	public function logout(Request $request) {
		//logout user

		auth()->logout();
		Session::flush();
		Cache::flush();
		// redirect to login page
		return redirect('/');
	}
}
