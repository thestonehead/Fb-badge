#overlay
<?php 
	require( __DIR__.'/facebook_start.php' );
	
	$token = $_SESSION['facebook_access_token'];
   	//$r = new HttpRequest('https://graph.facebook.com/me?access_token='.$r, HttpRequest::METH_POST);

	$output = curly($token);
	//echo $output;
	$r=json_decode($output, true);
	$id= $r['id'];
	$path = "cache/".$id.".jpg";
	$_SESSION['path'] = $path;
	// only create if not already exists in cache
	//if (!file_exists($path)){	
		create($id, $path);
	//}
	//else{
	//	echo " \n already exitst : ".$path;
	//}
	//override line 13. Always create for testing purposes
	//create($id, $path);
		//output as jpeg
	//header('Content-Type: image/jpg');
	//readfile($path);

	//upload($path,$token,$fb);


	// HttpRequest for user profile image 
	function curly($token){

        // create curl resource
		$ch = curl_init();

        // set url
		curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=".$token);

        //return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
		$output = curl_exec($ch);

        // close curl resource to free up system resources
		curl_close($ch); 

		return $output;
	}

	// Create image 
	function create($id, $path){
		$size = 320;
		$overlayType = isset($_COOKIE['selectedOverlay']) ? $_COOKIE['selectedOverlay'] : 1;
		echo 'Overlay '. $overlayType;
	
	    // base image is just a transparent png in the same size as the input image
		$base_image = imagecreatefrompng("images/template".$size.".png");
	    // Get the facebook profile image 
		$photo = imagecreatefromjpeg("http://graph.facebook.com/".$id."/picture?width=".$size."&height=".$size);

	    // read overlay  
		$overlay = imagecreatefrompng("images/overlay".$size."_".$overlayType.".png");
	    // keep transparency of base image
		imagesavealpha($base_image, true);
		imagealphablending($base_image, true);
	    // place photo onto base (reading all of the photo and pasting unto all of the base)
		imagecopyresampled($base_image, $photo, 0, 0, 0, 0, $size, $size, $size, $size);
		
	    // place overlay on top of base and photo
		imagecopy($base_image, $overlay, 0, 0, 0, 0, $size, $size);
	    // Save as jpeg
		imagejpeg($base_image, $path);
	}

	?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show your support for SFeraKon 2017 | Update </title>
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
				<h1>You new profile picture is ready !</h1>
			</div>
			<img class="profile" src=<?php echo $path . '?t=' . date('U') ?> alt="">  
			<div class="content">
				<br/>
				<form action="update.php" method='post'>
				 <label for="update" >Status:</label>
				  <textarea class="u-full-width" placeholder="" name="text"></textarea>
				  <input class="button-primary" value="Post" type="submit">
				</form>
				<br/>
			<?php require( __DIR__.'/footer.php' ); ?>
	    </div>
		
    </div>

    <script src="invaders.js"></script>
  </body>
</html>