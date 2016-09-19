<?php
namespace App\Http\Controllers\Apiv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserMongo;
use Auth;
class UserController extends Controller
{
	public function index(){
		$user = Auth::guard('api')->user();
		return $user;
	}
	public function store(Request $request){
		$data = [
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'photo' => $request->get('photo'),
			'facebookID' => $request->get('facebookID'),
			'gender' => $request->get('gender'),
			'facebook' => $request->get('facebook'),
			'google' => $request->get('google'),
			'password' => bcrypt(''),
			'api_token' => bcrypt(rand())
		];

		$user = UserMongo::where('email','=',$request->email)->first();
		if(!$user){
			$user = UserMongo::create($data);
			return response()->json([
				'token' => $user->api_token
				]);
		}else{
			return response()->json([
				'token' => $user->api_token
				]);
		}
	}
}