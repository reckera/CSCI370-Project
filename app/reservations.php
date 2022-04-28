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
	
	<h2>Shop Reservations</h2>
	<!-- <form method='GET'>
		<label>Change number of shown reservations.</label>
		<select name="limit">
		<option value =1>1</option>
		<option value =10>10</option>
		<option value =20>20</option>
		<option value =50>50</option>
		<option value =100>100</option>
		</select> 
		<p><input type="submit" value="select"></p>
	</form> -->

	<?php
		//if(!isset($_GET['limit'])){
		//	$limit = 10;
		//}else{
		//	$limit = $_GET['limit'];
		//}
		$sql = 'SELECT r.startD, r.startT, r.endT, sh.shopName, s.service '.
          'FROM reservation r '.
          'INNER JOIN shop sh on sh.shopNo = r.shopNo '.
		  'INNER JOIN service s on s.servNo = r.servNo '.
		  'WHERE r.startD <= ? '.
		  'ORDER BY r.startD, r.startT ASC '.
		  'LIMIT 10;';
		$statement = $pdo->prepare($sql);
		date_default_timezone_set('America/New_York');
		$statement->bindValue(1, date('Y-d-m'), PDO::PARAM_STR);
		//$statement->bindValue(2, $limit, PDO::PARAM_STR);
    
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Lookup error: ", $e->getMessage();
		}
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			echo '<p>' . $row['shopName'] . ' has reservation for ' . $row['service'] .
			' on ' . $row['startD'] . ' from ' . $row['startT'] . ' to ' . $row['endT'] . '</p>';
		}
    ?>
	
	<hr>
	
	<h2>Shop Services</h2>
	
    <table>
      <tr>
        <th>service</th>
        <th>shop name</th>
        <th>price</th>
        <th>minutes</th>
        <th>zip code</th>
      </tr>
    <?php
      $sql = 'SELECT s.service, s.price, s.minutes, sh.shopName, sh.zipCode '.
        'FROM service s '.
		'INNER JOIN shop sh on s.shopNo = sh.shopNo '.
		' ORDER BY s.service, sh.shopName ASC;';
      $statement = $pdo->query($sql);
      while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>" . $row['service'] . "</td>";
        echo "<td>" . $row['shopName'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['minutes'] . "</td>";
        echo "<td>" . $row['zipCode'] . "</td>";
        echo "</tr>";
      }
    ?>
	</table>
	
	<?php include 'static/footer.html'; ?>
</body>
</html>