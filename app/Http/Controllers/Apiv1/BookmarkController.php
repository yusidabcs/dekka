<?php
namespace App\Http\Controllers\Apiv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsMongo;

class BookmarkController extends Controller
{
	public function store(Request $request,$id){
		$user = \Auth::user();
        $news = NewsMongo::find($id);
        $news->bookmarks()->firstOrCreate([
            'user_id' => $user->id
            ]);
        return $news->bookmarks;
	}
}