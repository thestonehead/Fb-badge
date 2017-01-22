<?php 
require( __DIR__.'/facebook_start.php' );
$text = 'N/A';// htmlspecialchars($_POST['text']);
//echo $text;
$token = $_SESSION['facebook_access_token'];
//var_dump($_SESSION['path']);
$path = $_SESSION['path'];
//var_dump($path);
//Upload image
upload($path,$token,$fb,$text);
function upload($path,$token,$fb,$text)
{
	// Add a new album 
	/*$albumData = [
		'name' => 'SFeraKon 2017'
	];
	
	try {
	  // Returns a `Facebook\FacebookResponse` object
	  $response = $fb->post('/me/albums', $albumData, $token);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
	$graphNode = $response->getGraphNode();
	
	$albumId = $graphNode['id'];
	*/
	$image = [
	  'caption' => $text,
	  'source' => $fb->fileToUpload($path),
	];

	try {
	  // Returns a `Facebook\FacebookResponse` object
	  $response = $fb->post('/me/photos', $image, $token);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	$graphNode = $response->getGraphNode();
	
	//print_r($graphNode);
	//echo " \n Photo ID: " . $graphNode['id'];

	try {
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get('/'.$graphNode['id'].'?fields=link', $token);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$picture =$response->getGraphNode();
		//var_dump($picture);
		//header("Location: ".$picture['link']."&makeprofile=1");
		echo("Location: ".$picture['link']."&makeprofile=1");
	}
	catch(Exception $e) {
		print "<pre>";
		print_r($e);
		print "</pre>";
	}
}

session_write_close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Show your support for Net Neutralty | Update </title>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="css/invaders.css" media="screen">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="bg">
	<div class="container">
		<div class="row">
			<div class="header">
				<h1>Thank you for your support!</h1>
				<img class="profile" src=<?php echo $path ?> alt="">
			</div>
			<div class="content">
				Your picture has been uploaded.
			</div>
			<br/>
			<?php require( __DIR__.'/footer.php' ); ?>
		</div>
	</div>

	<script src="invaders.js"></script>
</body>
</html>