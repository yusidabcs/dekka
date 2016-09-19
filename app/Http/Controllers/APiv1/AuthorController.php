<?php
namespace App\Http\Controllers\Apiv1;
use App\Transformer\AuthorTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Pagination\Cursor;
use App\AccountMongo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
	public function index(Request $request){

		$currentCursor = $request->get('cursor', null);
		$previousCursor = $request->get('previous', null);
		$limit = $request->get('limit', 10);
		if ($currentCursor) {
			$accounts = AccountMongo::whereHas('latestNews')->orderBy('created_at','desc')->where('created_at','<',new \DateTime(base64_decode($currentCursor)))->take($limit)->get();
		    //$books = Book::where('id', '>', $currentCursor)->take($limit)->get();
		} else {
		    $accounts = AccountMongo::whereHas('latestNews',function($q){
		    	$q->orderBy('created_at','desc');
		    })->take($limit)->get();
		}

		$newCursor = base64_encode($accounts->last()->created_at);
		$cursor = new Cursor($currentCursor, $previousCursor, $newCursor, $accounts->count());

		$resource = new Collection($accounts, new AuthorTransformer);
		$resource->setCursor($cursor);

		$manager = new Manager;
		$data = $manager->createData($resource);
        
        return response()->make($data->toArray());
	}
}