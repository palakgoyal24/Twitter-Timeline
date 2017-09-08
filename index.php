<?php

	// Loading the library files
	require "lib/twitteroauth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;
	
	// defining the consumer key and secret, and callback
	define('CONSUMER_KEY', 'DGziwxM5EzBI7cY2FDkwneuic');
	define('CONSUMER_SECRET', 'RsxL5LcC4biNZ3vxdWx7CCCkuWLXs4MT1qYiVsa3JLsR7Qeh52');
	define('OAUTH_CALLBACK', '');
	
	// start the session
	session_start();

	if(!isset($_SESSION['data']) && !isset($_GET['oauth_token'])) {
		// create a new twitter connection object
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		// get the token from connection object
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK); 
		// if request_token exists then get the token and secret and store in the session
		if($request_token){
			$token = $request_token['oauth_token'];
			$_SESSION['request_token'] = $token ;
			$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
			// get the login url from getauthorizeurl method
			$login_url = $connection->getAuthorizeURL($token);
		}
	}

	if(isset($login_url) && !isset($_SESSION['data'])){
		// echo the login url
		echo "<a href='$login_url'><button>Login with twitter </button></a>";
	}
	else{
		// get the data stored from the session
		$data = $_SESSION['data'];
		// echo the name username and photo
		echo "Name : ".$data->name."<br>";
		echo "Username : ".$data->screen_name."<br>";
		echo "Photo : <img src='".$data->profile_image_url."'/><br><br>";
		// echo the logout button
		echo "<a href='?logout=true'><button>Logout</button></a>";
	} 