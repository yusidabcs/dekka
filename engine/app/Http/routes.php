<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'admin'],function(){
	Route::resource('login','Admin\LoginController');
	Route::get('logout','Admin\LoginController@logout');
	Route::resource('dashboard','Admin\DashboardController');
	Route::resource('account','Admin\AccountController');
	Route::resource('news','Admin\NewsController');
	Route::resource('categories','Admin\CategoryController');
});

Route::group(['prefix' => 'apiv1'],function(){
	Route::resource('devices','ApiV1\DeviceController');
	Route::resource('news','ApiV1\NewsController');
	Route::get('news/similar/{id}','ApiV1\NewsController@similar');
	Route::resource('categories','ApiV1\CategoryController');
	Route::resource('authors','ApiV1\AuthorController');
	Route::resource('users','ApiV1\UserController',['only' => ['store']]);

	Route::group(['middleware' => 'auth:api'],function(){
		Route::resource('users','ApiV1\UserController',['only' => ['index']]);
		Route::resource('news/{id}/bookmarks','ApiV1\BookmarkController');
	});
});
use PicoFeed\Reader\Reader;
use Symfony\Component\DomCrawler\Crawler;
use PicoFeed\Config\Config;

use App\Transformer\NewsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


Route::get('/feeds/{id}', function($id)
{

	try {
		$account = AccountMongo::find($id);
		$etag = '268834055b41155d67c5d4438cb046f4';
		$last_modified = '';
        $reader = new Reader;
        $resource = $reader->download($account->feed_url);
	    // Return true if the remote content has changed
	    if ($resource->isModified()) {

	        $parser = $reader->getParser(
	            $resource->getUrl(),
	            $resource->getContent(),
	            $resource->getEncoding()
	        );

	        $feeds = $parser->execute();

	        foreach ($feeds->getItems() as $key => $value) {
	        	$html = $value->content;
				$crawler = new Crawler($html);
				$crawler = $crawler->filter('img');
				$img = ((count($crawler) > 0) ? $crawler->first()->attr('src') : '');
				
	        	$news = NewsMongo::where('title',$value->title)->first();
	        	
	        	if(!$news){

	        		$category = array();

	        		foreach ($value->getTag('category') as $key => $cat) {
	        			$category[] = ['name' => strtolower($cat)];
	        		}
	        		
	        		$news = NewsMongo::firstOrNew([
	        			'title' => $value->title,
	        			'content' => cleanHtml($value->content),
	        			'url'	=> $value->url,
	        			'created_at' => $value->date == '1970-01-01 08:33:36' ? date("Y-m-d H:i:s") : $value->date,
	        			'image'		=> $img,
	        			'view'		=> 0,
	        			'categories' => $category
	        		]);
	        		$news = $account->news()->save($news);
	        		send_fcm($news->_id);
	        		
	        	}else{
	        		echo $news->title . ' : uda ada!';
	        	}
	        }

	        echo 'success!';
	        
	    }
	    else {

	        echo 'Not modified, nothing to do!';
	    }
    }
    catch (PicoFeedException $e) {
        echo 'Exception thrown ===> "'.$e->getMessage().'"'.PHP_EOL;
        return false;
    }
	//return View::make('hello');
});

Route::get('lists',function(){
	try {

	    $reader = new Reader;
	    $resource = $reader->download('http://baliberkarya.com');

	    $feeds = $reader->find(
	        $resource->getUrl(),
	        $resource->getContent()
	    );

	    print_r($feeds);
	}
	catch (PicoFeedException $e) {
	    // Do something...
	}
});
Route::get('/authors', function()
{

	//return AccountMongo::all();
	$news = AccountMongo::firstOrCreate([
		'name' => 'metrobali.com',
		'feed_url' => 'http://metrobali.com/feed/',
		'feed_type'	=> '1',
	]);
});
Route::get('/', function()
{
	try {

		$accounts = App\AccountMongo::all();
		return $accounts;
		$account = $accounts[1];
		$etag = '268834055b41155d67c5d4438cb046f4';
		$last_modified = '';
        $reader = new Reader;

        $resource = $reader->download($account->feed_url);
	    // Return true if the remote content has changed
	    if ($resource->isModified()) {

	        $parser = $reader->getParser(
	            $resource->getUrl(),
	            $resource->getContent(),
	            $resource->getEncoding()
	        );

	        $feeds = $parser->execute();

	        foreach ($feeds->getItems() as $key => $value) {
	        	$html = $value->content;
				$crawler = new Crawler($html);
				$crawler = $crawler->filter('img');
				$img = ((count($crawler) > 0) ? $crawler->first()->attr('src') : '');
				
	        	$news = App\NewsMongo::firstOrNew([
	        			'title' => $value->title,
	        			'content' => $value->content,
	        			'url'	=> $value->url,
	        			'created_at' => $value->date,
	        			'image'		=> $img,
	        		]);
	        	if(!$news->_id){
	        		$news = $account->news()->save($news);
	        		foreach ($value->getTag('category') as $key => $cat) {
	        			$category = new App\CategoryMongo(['name' => $cat]);

	        			$news->categories()->save($category);
	        		}
	        		
	        	}
	        }
	        
	    }
	    else {

	        echo 'Not modified, nothing to do!';
	    }
    }
    catch (PicoFeedException $e) {
        echo 'Exception thrown ===> "'.$e->getMessage().'"'.PHP_EOL;
        return false;
    }
	//return View::make('hello');
});

Route::get('category',function (){
	//NewsMongo::truncate();
	//CategoryMongo::truncate();
	$rs = App\CategoryMongo::groupBy('name')->count();
	return $rs;
	echo $rs;
	echo '<br>';
	$rs = App\CategoryMongo::all();

	echo $rs;	
});



Route::get('cache',function(){
	//$news = NewsMongo::where('_id','=','57891c8a10575cc1759f8863');
	$news = App\NewsMongo::where('categories.name','all',['Tabanan'])->orderBy('created_at','desc');
	
	$rs = $news->paginate();

	$news = $rs->getCollection();
	$resource = new Collection($news, new NewsTransformer);
	$resource->setPaginator(new IlluminatePaginatorAdapter($rs));
	$manager = new Manager;
	$data = $manager->createData($resource);
    return $data->toArray();//\Response::make($data->toArray());

	$html = strip_tags($html);
	//remove new line
    $html = trim(preg_replace('/\s+/', ' ', $html));
    //remove image link
    $html = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $html);

    $html = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html);

    //remove width and height
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    //remove
	return substr($html,0,200);
	$crawler = new Crawler($html);
	$crawler = $crawler->filter('img');

	foreach ($crawler as $key => $value) {
		dd($value->attr('img'));
	}
	return $crawler->count();
	$img = ((count($crawler) > 0) ? $crawler->first()->attr('src') : '');

	return 1;

	NewsMongo::truncate();
	return;
	//return NewsMongo::with('categories')->first();
	$name = "Internasional";
	$news = App\AccountMongo::get();
	return $news;
});


function cleanHtml($html){
    //remove new line
    $html = trim(preg_replace('/\s+/', ' ', $html));
    //remove image link
    $html = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $html);

    $html = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html);

    //remove width and height
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

    $html = htmlspecialchars_decode($html);
    //remove
    return $html;
}

Route::get('fcm',function(){

	$url = "https://fcm.googleapis.com/fcm/send";
	$client = new GuzzleHttp\Client(['base_uri' => $url]);
	$news = App\NewsMongo::orderBy('created_at','desc')->first();

	$resource = new League\Fractal\Resource\Item($news, new NewsTransformer);

	$manager = new League\Fractal\Manager;
	$data = $manager->createData($resource);
    
    $n = [];
    $n['app_name'] = 'Lontar';
    foreach ($data->toArray()['data'] as $key => $value) {
    	if($key != 'content')
    		$n[$key] = $value;
    }
	$res = $client->request('POST', '', [
		'headers'        => [
			'Content-Type' => 'application/json',
			'Authorization' => 'key=AIzaSyBmO-BmQz9fpIPrA9SJx-ebYKgiyNyn7rs',
		],
	    'json' => [
	    	'to' => 'fXfGL2QoU9A:APA91bHK806EaO6Zpa5DY_Wcs4rGDgbAB7fxT06vTJfL08pyXzwuCRC5NIHeHHPV1ZzucGwRp3fhAV7KPTwzncOOKOq89mhdSmsS67o2H30sXaFN5Zg_eD4ZaLjLbl2LnRfkwU0-IjOP',
	    	'time_to_live' => 60,
			 "data" => $n
	    ]
	]);

	return ($res->getBody());
});