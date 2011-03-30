<?php 
	
		require 'api_cache/API_cache.php';
		
    $cache_file = 'api_cache/twitter.json';
    $api_call = 'http://search.twitter.com/search.json?q=nodeJS&lang=en';
    $cache_for = 5; // just one minute
		
		$api_cache = new API_cache ($api_call, $cache_for, $cache_file);
		if (!$res = $api_cache->get_api_cache())
			$res = "{error: 'Could not load cache'}";
		
		ob_start();
		echo $res;
		$json_body = ob_get_clean();
		
		header ('Content-Type: application/json');
    header ('Content-length: ' . strlen($json_body));
		header ("Expires: " . $api_cache->get_expires_datetime());
		echo $json_body;
