<?php
namespace App\Http\Controllers\Admin;

use App\AccountMongo;
use App\NewsMongo;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
* 
*/
class NewsController extends BaseController
{
	public function index(){
		$news = NewsMongo::orderBy('created_at')->get();

		$content = view('admin.news.index')
			->with('news',$news);
		return view($this->layout, ['content' => $content]);
	}

}