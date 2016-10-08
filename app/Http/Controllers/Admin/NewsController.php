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
		$d = new \DateTime(date('Y-m-d 00:00:00'));
		$news = NewsMongo::with('author')->orderBy('created_at','desc')->where('created_at','>',$d)->get();
		$content = view('admin.news.index')
			->with('news',$news);
		return view($this->layout, ['content' => $content]);
	}

}