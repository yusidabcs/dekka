<?php
namespace App\Http\Controllers\Admin;

use App\UserMongo;
use App\Http\Requests;
use Illuminate\Http\Request;
/**
* 
*/
class UserController extends BaseController
{
	public function index(){
		$users = UserMongo::paginate();
		$content = view('admin.users.index')
			->with('users',$users);
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