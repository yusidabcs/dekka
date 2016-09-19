<?php
namespace App\Http\Controllers\Apiv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function store(Request $request){
		$credential = [
                'email' => $request->getUser(),
                'password' => $request->getPassword(),
            ];
        if(\Auth::once($credential)){
            $headers = ['WWW-Authenticate' => 'Basic '.base64_encode(implode(':', $credential))];
            return response()->json($headers);
        }
        $headers = ['WWW-Authenticate' => 'Basic'];
        return response()->make('Invalid credentials.', 401, $headers);
	}
}