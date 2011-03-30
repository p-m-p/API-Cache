<?php 
	
	if (array_key_exists('widget', $_GET)) {
		
		require 'api_cache/API_cache.php';
		
		if ($_GET['widget'] == 'flickr') {
			$cache_file = 'api_cache/flickr.json';
			$api_call = 'http://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos' .
        '&api_key=5f95ec29befac25827ae66f1537f5bd1' .
        '&user_id=52747878@N04' .
        '&per_page=9' .
        '&format=json&nojsoncallback=1';
			$cache_for = 60 * 24; // one day
		}
		
		elseif ($_GET['widget'] == 'twitter') {
			$cache_file = 'api_cache/twitter.json';
			$api_call = 'http://search.twitter.com/search.json?q=nodeJS&lang=en&rpp=8';
			$cache_for = 1; // just one minute
		}
		
		$api_cache = new API_cache ($api_call, $cache_for, $cache_file);
		if (!$res = $api_cache->get_api_cache())
			$res = "{error: 'Could not load cache'}";
		
		ob_start();
		echo $res;
		$json_body = ob_get_clean();
		
		header ('Content-Type: application/json');
		header ("Expires: " . $api_cache->get_expires_datetime());
		echo $json_body;
	}
