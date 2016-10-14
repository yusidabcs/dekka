<?php
namespace App\Http\Controllers\Admin;

use App\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
	public function index(){
		if(Auth::check())
			return \Redirect::intended('admin/dashboard');
		return \View::make('admin.login');
	}

	public function store(Request $request){

		$user = array('email' => $request->get('email'), 
			'password' => $request->get('password'));

		if (Auth::attempt($user)) {
            // Authentication passed...
            return redirect()->intended('admin/dashboard');
        }
		return redirect()->to('admin/login');
	}

	public function logout(){
		Auth::logout();
		return redirect()->to('admin/logout');
	}
}