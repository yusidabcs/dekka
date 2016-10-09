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
		//select a random news with image in range this time;
		$time = new \DateTime(date('Y-m-d H:m:s'));
		$time_before = $time->sub(new \DateInterval('PT3H'));
		$news = NewsMongo::with('author')->orderBy('created_at','desc')->where('created_at','>',$time_before)->get();
		$random = random_int(0, count($news)-1);
		send_fcm($news[$random]->_id);
	}

	public function show($id)
	{
		$news = NewsMongo::find($id);
		return redirect()->to($news->url.'?source=dekkanews');
		return view()->make('news')
			->with('news',$news);
	}

}
