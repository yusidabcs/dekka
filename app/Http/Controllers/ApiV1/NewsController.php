<?php
namespace App\Http\Controllers\Apiv1;

use App\Transformer\NewsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Pagination\Cursor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsMongo;

class NewsController extends Controller
{
	public function index(Request $request){
		$currentCursor = $request->get('cursor', null);
		$previousCursor = $request->get('previous', null);
		$newCursor = null;
		$limit = $request->get('limit', 10);
		if ($currentCursor) {
			$news = NewsMongo::orderBy('created_at','desc')->where('created_at','<',new \DateTime(base64_decode($currentCursor)));
		} else {
		    $news = NewsMongo::orderBy('created_at','desc');
		}	
		if($request->has('category')){
			$news = $news->where('categories.name','regexp','/.*'.$request->get('category').'.*/i');
		}

		if($request->has('title')){
			$news = $news->where('title','regexp','/.*'.$request->get('title').'.*/i');
		}


		$lastid = request()->get('last_id',null);
		if($lastid){
			$n = NewsMongo::find($lastid);
			$news = $news->where('created_at','>',$n->created_at);
			$news = $news->get();
			$resource = new Collection($news, new NewsTransformer);
			$manager = new Manager;
			$data = $manager->createData($resource);
	        
	        return \Response::make($data->toArray());
		}
		$news = $news->take($limit)->get();
		if(count($news) > 0)
			$newCursor = base64_encode($news->last()->created_at);
		
		$cursor = new Cursor($currentCursor, $previousCursor, $newCursor, $news->count());

		$resource = new Collection($news, new NewsTransformer);
		$resource->setCursor($cursor);

		$manager = new Manager;
		$data = $manager->createData($resource);
        
        return response()->make($data->toArray());
	}

	public function similar($id){
		$news = NewsMongo::find($id);
		$news = NewsMongo::where('account_id',$news->account_id)
			->where('_id','!=',$id)
			->orderBy('created_at','desc')
			->take(5)
			->get();

		$resource = new Collection($news, new NewsTransformer);
		$manager = new Manager;
		$data = $manager->createData($resource);
        
        return response()->make($data->toArray());
	}

	public function update($id){
		$news = NewsMongo::find($id);
		$news->view = $news->view + 1;
		$news->save();
		$resource = new Item($news, new NewsTransformer);
		$manager = new Manager;
		$data = $manager->createData($resource);
        
        return response()->make($data->toArray());
	}

	public function show($id){
		$news = NewsMongo::find($id);
		$resource = new Item($news, new NewsTransformer);
		$manager = new Manager;
		$data = $manager->createData($resource);
        
        return response()->make($data->toArray());
	}
}