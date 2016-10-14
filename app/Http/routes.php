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
Route::get('/','HomeController@index');
Route::get('/tos','HomeController@tos');
Route::resource('news','NewsController');

Route::group(['prefix' => 'admin'],function(){
	Route::resource('login','Admin\LoginController');
	Route::get('logout','Admin\LoginController@logout');
	Route::resource('dashboard','Admin\DashboardController');
	Route::resource('account','Admin\AccountController');
	Route::resource('news','Admin\NewsController');
	Route::resource('categories','Admin\CategoryController');
	Route::resource('users','Admin\UserController');
});

Route::group(['prefix' => 'apiv1'],function(){

	Route::resource('devices','ApiV1\DeviceController');
	Route::get('news/featured','ApiV1\NewsController@featured');
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
use PicoFeed\Scraper\Scraper;

use App\Transformer\NewsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


Route::get('/feeds/{id}', function($id)
{

	try {
		$account = App\AccountMongo::find($id);
		$etag = '268834055b41155d67c5d4438cb046f4';
		$last_modified = '';

		$tag_attribute_whitelist = array(
		    'br' => array(),
		    'a' => array(),
		    'img' => array(),
		);

		$config = new Config();
		$config->setFilterWhitelistedTags($tag_attribute_whitelist);
		$reader = new Reader($config);
        $resource = $reader->download($account->feed_url);
	    // Return true if the remote content has changed
	    if ($resource->isModified()) {

	        $parser = $reader->getParser(
	            $resource->getUrl(),
	            $resource->getContent(),
	            $resource->getEncoding()
	        );
	        $format = $reader->detectFormat($resource->getContent());
	        $feeds = $parser->execute();

	        $no = 0;
	        foreach ($feeds->getItems() as $key => $value) {

	        	if($account->feed_type == 1){
	        		$html = $value->content;
	        		
					$crawler = new Crawler($html);
					$crawler = $crawler->filter('img');

					if($value->getEnclosureUrl() != ''){
						$img = $value->getEnclosureUrl();
					}else{
						$img = ((count($crawler) > 0) ? $crawler->first()->attr('src') : '');
					}

					$html = str_replace("\n\n", "</p><p>", $value->getContent());
					$html = "<p>" . $html . "</p>";
					if($value->getEnclosureUrl() != ''){
						$html = '<img src="'.$value->getEnclosureUrl().'">'.$html;
					}
					
	        	}else{
	        		$config->setGrabberRulesFolder(base_path().'/rules');
					$grabber = new Scraper($config);
					$grabber->setUrl($value->url);
					$grabber->execute();
					$html = $grabber->getRelevantContent();
					$crawler = new Crawler($html);
					$crawler = $crawler->filter('img');
					$img = ((count($crawler) > 0) ? $crawler->first()->attr('src') : '');
					
	        	}
	        	
	        	$news = App\NewsMongo::where('title',$value->title)->first();
	        	
	        	if(!$news){
	        		$no ++;
	        		$category = array();

	        		foreach ($value->getTag('category') as $key => $cat) {
	        			$category[] = ['name' => strtolower($cat)];
	        		}

	        		$date = new DateTime($value->date->format("c"));
					$date->setTimezone(new DateTimeZone(config('app.timezone')));
	        		$news = App\NewsMongo::firstOrNew([
	        			'title' => $value->title,
	        			'content' => cleanHtml($html),
	        			'url'	=> $value->url,
	        			'created_at' => ($value->date->format('Y') < (date('Y'))) ? date('Y-m-d H:i:s') : $date->format('Y-m-d H:i:s'),
	        			'image'		=> $img,
	        			'view'		=> 0,
	        			'categories' => $category
	        		]);
	        		$news = $account->news()->save($news);
	        	
	        	}else{
	        		echo $news->title . ' : uda ada! <br>';
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

		$tag_attribute_whitelist = array(
		    'br' => array(),
		    'a' => array(),
		    'img' => array(),
		    'div' => []
		);

		$config = new Config();
		$config->setFilterWhitelistedTags($tag_attribute_whitelist);
		$reader = new Reader($config);
        $resource = $reader->download('http://metrobali.com/feed');
	    // Return true if the remote content has changed
	    if ($resource->isModified()) {

	        $parser = $reader->getParser(
	            $resource->getUrl(),
	            $resource->getContent(),
	            $resource->getEncoding()
	        );
	        $format = $reader->detectFormat($resource->getContent());
	        $feeds = $parser->execute();

	        $no = 0;
	        foreach ($feeds->getItems() as $key => $value) {
	        	
	        	$html = str_replace("\n\n", "</p><p>", $value->getContent());
				$html = "<p>" . $html . "</p>";
				if($value->getEnclosureUrl() != ''){
					$html = '<img src="'.$value->getEnclosureUrl().'">'.$html;
				}
				
	        	return cleanHtml($html);
	        }
	    }
	    return 1;

		$tag_attribute_whitelist = array(
			
		);
		$config = new Config();
		$config->setGrabberRulesFolder(base_path().'/rules');
		$config->setFilterWhitelistedTags($tag_attribute_whitelist);

		$grabber = new Scraper($config);
		$grabber->setUrl("http://baliberkarya.com/index.php/read/2016/10/14/201610140026/Waspadalah-Polda-Bali-Kerahkan-Satgas-Operasi-Tangkap-Pejabat-Terindikasi-Pungli.html");
		$grabber->execute();

		// Get raw HTML content
		//echo $grabber->getRawContent();

		// Get relevant content
		echo cleanHtml($grabber->getRelevantContent());

		// Get filtered relevant content
		//echo $grabber->getFilteredContent();

		// Return true if there is relevant content
		//var_dump($grabber->hasRelevantContent());
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
	$account = App\AccountMongo::find('57f366216aa7fc0cb81fe4b2');
	return $account->news()->delete();
});


function cleanHtml($html){
    //remove new line
    $html = trim(preg_replace('/\s+/', ' ', $html));
    //remove image link
    $html = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $html);

    $html = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html);

    $html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);

    //remove width and height
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

    //remove empty p
    $html = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $html); 
    $html = preg_replace('/<p[^>]*> <\\/p[^>]*>/', '', $html);

    $html = htmlspecialchars_decode($html);
    //remove
    return $html;
}

Route::get('fcm',function(){

	$url = "https://fcm.googleapis.com/fcm/send";
	$client = new GuzzleHttp\Client(['base_uri' => $url]);
	$news = App\NewsMongo::select(['_id','title'])->orderBy('created_at','desc')->take(2)->get();
	$news = $news[0 ];

	$device = App\DeviceMongo::orderBy('_id','desc')->first();
    
    
    
    $n = [];
    $n['app_name'] = 'Dekka!';
    $n['type'] = 'news_notif';
    $n['_id'] = $news->_id;
    $n['title'] = $news->title;

	$res = $client->request('POST', '', [
		'headers'        => [
			'Content-Type' => 'application/json',
			'Authorization' =>'key='.config('app.server_key'),
		],
	    'json' => [
	    	'to' => $device->registration_ids,
	    	'time_to_live' => 60,
			 "data" => $n
	    ]
	]);

	return ($res->getBody());
});


Route::get('feed', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'dekkanews');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 20 posts
       $posts = \App\NewsMongo::orderBy('created_at', 'desc')->where('image','!=','')->take(20)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'DekkaNews';
       $feed->description = 'Baca Berita Dalam Genggaman';
       $feed->logo = '';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'id';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       foreach ($posts as $post)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($post->title, $post->author->name, url('news/'.$post->id), $post->created_at, '', $post->content);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);

});