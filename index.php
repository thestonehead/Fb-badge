<?php

  require( __DIR__.'/facebook_start.php' );
  require( __DIR__.'/cred.php' );
 
  $helper = $fb->getRedirectLoginHelper();
 
  $permissions = ['email', 'user_posts','publish_actions']; // optional
  $loginUrl    = $helper->getLoginUrl($callback_url, $permissions);

  ?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show your support for Net Neutralty </title>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link href="css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="css/flickity.css" media="screen">
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
          <h1>Show your support for SFeraKon 2017</h1>
		  <div class="carousel" >
			<img class="profile" src="images/default480_1.png"/>
			<img class="profile" src="images/default480_2.png"/>
			<img class="profile" src="images/default480_3.png"/>
		  </div>
        </div>
        <div class="content">
        <br/>
        <p>Show your support for SFeraKon 2017 by updating your facebook picture. </p>       
          <a class="button button-primary" href=<?php echo htmlspecialchars($loginUrl);?> > Log in to Facebook </a> 
 
       </div>
		
		<?php require( __DIR__.'/footer.php' ); ?>
      </div>
	  
    </div>
	
   
	<script	  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
	<script src="flickity.pkgd.min.js"></script>
	<script src="invaders.js"></script>
	<script type="text/javascript">

		var $carousel = $('.carousel');
		var flkty = new Flickity('.carousel', {
			wrapAround: true,
			percentPosition: false
		});
		//data-flickity='{ "wrapAround": true, "percentPosition": false }'
		
		document.cookie = 'selectedOverlay=1' ;
		// bind event listener
		$carousel.on( 'select.flickity', function() {
			  //alert( 'Flickity select ' + flkty.selectedIndex )
			  document.cookie = 'selectedOverlay=' + (flkty.selectedIndex +1);
			});
	</script>
  </body>
</html>
