<?php
 
	require "lib/twitteroauth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;

	/*$consumerKey = "DGziwxM5EzBI7cY2FDkwneuic";
	$consumerSecret = "RsxL5LcC4biNZ3vxdWx7CCCkuWLXs4MT1qYiVsa3JLsR7Qeh52";
	$accessToken = "17731580-KABTBpB6FH8FLLjLYzOHnVQHQObqkiNo4DKADJJPf";
	$accessTokenSecret = "rMFaO1UGHIBOf9idArrSqShJU3gxdcpKy49eok1xzFXdr";

	$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
	$content = $connection->get("account/verify_credentials");

	$statuses = $connection->get("statuses/user_timeline", ["count" => 1, "exclude_replies" => true]);*/
	//print_r($statuses);
	//foreach($statuses as $key=>$value){
	//	print $key ."=>".$value;
	//}
 
 	define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
	define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
	define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

	/* ------- Request -------- */
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	print_r($request_token);

	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

 ?>