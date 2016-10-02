<?php
function send_fcm($id){
	$url = "https://fcm.googleapis.com/fcm/send";
	$client = new GuzzleHttp\Client(['base_uri' => $url]);
	$news = App\NewsMongo::find($id);
	$resource = new League\Fractal\Resource\Item($news, new App\Transformer\NewsTransformer);
	$manager = new League\Fractal\Manager;
	$data = $manager->createData($resource);

	$devices = App\DeviceMongo::lists('registration_ids');
  
    $n = [];
    foreach ($data->toArray()['data'] as $key => $value) {
    	$n[$key] = $value;
    }

    foreach ($data->toArray()['data']['author']['data'] as $key => $value) {
    	$n['auhor_'.$key] = $value;
    }

	$res = $client->request('POST', '', [
		'headers'        => [
			'Content-Type' => 'application/json',
			'Authorization' => 'key=AIzaSyBAhqWw42QnNTCoye_ZyIWQrTC1_eSJ88o',
		],
	    'json' => [
	    	'registration_ids' => $devices,
	    	'time_to_live' => 600,
			 "data" => $n
	    ]
	]);
}