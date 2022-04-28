<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title> CarBuddy </title>
	<link href="/static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include 'static/menu.html'; ?>
	
	<?php 
      $dsn = 'mysql:host=localhost;dbname=carBuddy';
      $username = 'root';
      $password = '';
      $pdo = new PDO($dsn, $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>
	
	<?php include 'static/footer.html'; ?>
</body>
</html>