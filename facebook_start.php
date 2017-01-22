<?php 
  ini_set('display_errors',1); 
  error_reporting(E_ALL);
  session_start();
  require( __DIR__.'/Facebook/autoload.php' );
  require( __DIR__.'/cred.php' );
  $fb = new Facebook\Facebook(array(
    'app_id'                => $_YOUR_APP_ID,
    'app_secret'            => $_YOUR_APP_SECRET,
    'default_graph_version' => 'v2.3',
    ));

  $bg_path = "images/starrySky.png";

  function debug_to_console($data) {
      if(is_array($data) || is_object($data))
    {
      echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
    } else {
      echo("<script>console.log('PHP: ".$data."');</script>");
    }
  }
  
  function getRootUrl() {
	$base_url  = preg_replace("!^${doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
	$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
	//$port      = $_SERVER['SERVER_PORT'];
	$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
	$domain    = $_SERVER['SERVER_NAME'];
	$full_url  = "${protocol}://${domain}${disp_port}${base_url}"; # Ex: 'http://example.com', 'https://example.com/mywebsite', etc.
	return $full_url;
  }
?>