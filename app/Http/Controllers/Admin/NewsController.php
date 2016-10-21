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
		$d = new \DateTime(date('Y-m-d 00:00:00',strtotime('-1 day',time())));
		$news = NewsMongo::with('author')->orderBy('created_at','desc')->where('created_at','>',$d)->get();
		$content = view('admin.news.index')
			->with('news',$news);
		return view($this->layout, ['content' => $content]);
	}

	public function edit($id){

		$news = NewsMongo::find($id);
		$content = view('admin.news.edit')
			->with('news',$news);
		return view($this->layout, ['content' => $content]);
	}

	public function update(Request $request,$id){

		$news = NewsMongo::find($id);
		$news->content = $request->get('content');
		$news->save();
		return redirect()->back();
	}

	public function destroy(Request $request,$id){

		$news = NewsMongo::find($id);
		$news->delete();
		return redirect()->to('admin/news');
	}

}
