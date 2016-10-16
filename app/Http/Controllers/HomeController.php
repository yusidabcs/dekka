<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index(Request $request)
	{
		$agent = new Agent();	
		if($agent->isMobile() && $request->get('source') == 'fb'){
			return view()->make('interstitial');
		}
		return view()->make('hello');
	}

	public function tos()
	{
		return view()->make('tos');
	}

}
