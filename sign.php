<?php
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $_GET['oauth_token'], $_GET['oauth_token_secret'], true);

$auth = $twitterObj->httpRequest( isset($_GET['method']) ? $_GET['method'] : 'GET', urldecode($_GET['url']), isset($_GET['params']) ? json_decode($_GET['params'], true) : null);

if ( isset($_GET['callback']) && preg_match('/^\w+$/', $_GET['callback']) ) {
	header('Content-Type: text/javascript');
	echo $_GET['callback'].'(\''.$auth.'\');';
} else {
	echo $auth;
}
?>