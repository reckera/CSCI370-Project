<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<link href="/static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include 'static/menu.php'; ?>
	
	<?php 
		$mem  = new Memcached();
		// List memcache servers
		$mem->addServer('host.docker.internal',11211);

		if($mem->getVersion() === FALSE){
			echo "<h2>Memcache server connection error</h2>";
		}
	?>

	<h2>Mechanic looking for work?</h2>
	<p>Are you a mechanic with fine motor skills who's not well known, doesn't have a lot of space, or just wants to branch out and reach more customers? 
	Whether you're a single mechanic or a shop with dozens, we make it easy for you. We bring the customers to you, or you to them, technically.</p>
	
	
	<h2>Need help finding a mechanic?</h2>
	<p>Whether you don't want to get your lazy *** off the couch for the arduous drive to the nearest quicklube, don't want to let the mechanic
	out of your sight while they work on your precious car, they can occasionally be devious and might even steal your headlight fluid, don't have
	the money for gas, or just need a mechanic to show up at your house to get your engine going, we can find you the right one.
	<finePrint>This is not an actual guarantee that you will be satisfied.</finePrint></p>
	<div>
	<img src="/images/jack.jpg" width = "25%">
	<img src="/images/instrumentCluster.jpg" width = "40%">
	<img src="/images/jack2.jpg" width = "25%">
	</div>
	<?php include 'static/footer.html'; ?>
</body>
</html>