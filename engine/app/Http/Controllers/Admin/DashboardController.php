<?php
namespace App\Http\Controllers\Admin;

use App\AccountMongo;
use App\NewsMongo;
/**
* 
*/
class DashboardController extends BaseController
{
	public function index(){
		$total_account = AccountMongo::count();
		$total_news = NewsMongo::count();
		$content = view('admin.dashboard')
			->with('total_account',$total_account)
			->with('total_news',$total_news);
		return view($this->layout,['content' => $content]);
	}
}