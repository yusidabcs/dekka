<?php
namespace App\Http\Controllers\Admin;

use App\CategoryMongo;
use Illuminate\Http\Request;
/**
* 
*/
class CategoryController extends BaseController
{
	public function index(){
		$categories = CategoryMongo::all();

		$content = view('admin.category.index')
			->with('categories',$categories);

		return view($this->layout, ['content' => $content]);
	}

	public function create(){

		return view($this->layout, ['content' => view('admin.category.create')]);

	}

	public function edit($id){
		$category = CategoryMongo::find($id);
		return view($this->layout, ['content' => view('admin.category.edit')
			->with('category',$category)]);
	}

	public function store(Request $request){
		$news = CategoryMongo::firstOrCreate([
			'name' => strtolower($request->get('name')),
			'logo' => ($request->get('logo')),
		]);
		return redirect()->to('admin/categories');
	}

	public function update(Request $request, $id){
		$category = CategoryMongo::find($id);
		$category->name = strtolower($request->get('name'));
		$category->logo = $request->get('logo');
		$category->status = $request->get('status',0);
		$category->save();

		return redirect()->to('admin/categories');
	}
	public function destroy($id){
		$account = \CategoryMongo::find($id);
		$account->delete();

		return \Redirect::to('admin/categories');
	}
}