<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\NewsMongo;

class NewsController extends Controller {

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

	public function index()
	{
		//return view()->make('hello');
	}

	public function show($id)
	{
		$news = NewsMongo::find($id);
		return view()->make('news')
			->with('news',$news);
	}

}
