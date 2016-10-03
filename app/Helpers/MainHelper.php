<?php
function send_fcm($id){
	$url = "https://fcm.googleapis.com/fcm/send";
	$client = new GuzzleHttp\Client(['base_uri' => $url]);
	$news = App\NewsMongo::find($id);
	$devices = App\DeviceMongo::lists('registration_ids');
  
    $n = [];
    $n['app_name'] = 'Dekka!';
    $n['_id'] = $news->_id;
    $n['title'] = $news->title;

	$res = $client->request('POST', '', [
		'headers'        => [
			'Content-Type' => 'application/json',
			'Authorization' => 'key='.config('app.server_key'),
		],
	    'json' => [
	    	'registration_ids' => $devices,
	    	'time_to_live' => 600,
			 "data" => $n
	    ]
	]);
	return ($res->getBody());
}