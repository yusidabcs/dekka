<?php
namespace App\Http\Controllers\Apiv1;
use App\Transformer\CategoryTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;
use App\Http\Controllers\Controller;
use App\CategoryMongo;

class CategoryController extends Controller
{
	public function index(){
		
		$limit = 10;

		$results = CategoryMongo::all();
	
		$resource = new Collection($results, new CategoryTransformer);

		$manager = new Manager;
		$data = $manager->createData($resource);
        
        return response()->make($data->toArray());
	}
}