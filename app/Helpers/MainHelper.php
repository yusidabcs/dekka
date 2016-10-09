<?php
function send_fcm($id){
	$url = "https://fcm.googleapis.com/fcm/send";
	$client = new GuzzleHttp\Client(['base_uri' => $url]);
	$news = App\NewsMongo::find($id);
	$devices = App\DeviceMongo::lists('registration_ids');
  	
  	$n = [];
	$time = date("H");
    if ($time < "12") {
        $n['app_name'] = 'Pagi Dekka!';
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        $n['app_name'] = 'Berita Siang Dekka!';
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        $n['app_name'] = 'Sore, Udah baca berita ini?';
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        $n['app_name'] = 'Selamat malam, terbaru!';
    }
    
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