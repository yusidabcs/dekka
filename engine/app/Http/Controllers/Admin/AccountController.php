<?php
namespace App\Http\Controllers\Admin;

use App\AccountMongo;
use App\NewsMongo;
use App\Http\Requests;
use Illuminate\Http\Request;
/**
* 
*/
class AccountController extends BaseController
{
	public function index(){
		$accounts = AccountMongo::all();

		$content = view('admin.account.index')
			->with('accounts',$accounts);
		return view($this->layout, ['content' => $content]);
	}

	public function create(){
		$content = view('admin.account.create');
		return view($this->layout, ['content' => $content]);
	}

	public function edit($id){
		$account = AccountMongo::find($id);
		$content = view('admin.account.edit')
			->with('account',$account);
		return view($this->layout, ['content' => $content]);
	}

	public function store(Request $request){
		$news = AccountMongo::firstOrCreate([
			'name' => $request->get('name'),
			'feed_url' => $request->get('feed_url'),
			'feed_type'	=> '1',
			'logo'	=> $request->get('logo')
		]);

		return redirect()->to('admin/account');
	}

	public function update(Request $request, $id){
		$account = AccountMongo::find($id);
		$account->name = $request->get('name');
		$account->feed_url = $request->get('feed_url');
		$account->logo = $request->get('logo');
		$account->save();

		return redirect()->to('admin/account');
	}
	public function destroy($id){
		$account = AccountMongo::find($id);
		$account->delete();

		return redirect()->to('admin/account');
	}
}