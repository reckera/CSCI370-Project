<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title> CarBuddy </title>
	<link href="/static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include 'static/menu.php'; ?>
	
	<?php 
		if(!isset($_SESSION['fName'])){
			header('Location: cust/signUp.php');
		}
	?>
	
	<?php include 'static/connection.php'; ?>
	
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
		'ORDER BY s.service, sh.shopName ASC;';
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
	
	<hr>
	
	<h2>Reservation Entry</h2>
	
	<form method='GET'>
		<label for="date">Date:</label>
		<input type="date" id="date" name="date"><br>
		<label for="time">Time:</label>
		<input type="time" id="time" name="time"><br>
		<label for="shopName">Name of shop:</label>
		<input type="text" id="shopName" name="shopName"><br>
		<label for="service">Service:</label>
		<input type="text" id="service" name="service"><br>
		<input type="submit">
	</form>
	
	<?php
		if(isset($_GET["date"])){
		date_default_timezone_set('America/New_York');
		$date = $_GET["date"];
		$time = $_GET['time'];
		if($date < date('Y-m-d') OR ($date == date('Y-m-d') AND $time < time())){
			echo "Can't pick a date and time that are in the past";
		}else{
			$shopName = $_GET['shopName'];
			$service = $_GET['service'];
			$sql = 'SELECT s.minutes, s.shopNo, s.servNo, s.price '.
				'FROM service s '.
				'INNER JOIN shop sh on sh.shopNo = s.shopNo '.
				'WHERE sh.shopName = ? AND s.service = ? ';
			$statement = $pdo->prepare($sql);
			$statement->bindParam(1, $shopName);
			$statement->bindParam(2, $service);
			try{
				$ret = $statement->execute();
			}catch(Exception $e){
				// "Lookup error: ", $e->getMessage();
			}
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$minutes = $row['minutes'];
			$shopNo = $row['shopNo'];
			$servNo = $row['servNo'];
			$cost = $row['price'];
			$sql = 'SELECT sh.shopName '.
				'FROM service s '.
				'INNER JOIN shop sh on s.shopNo = sh.shopNo '.
				'INNER JOIN reservation r on r.shopNo = sh.shopNo '.
				'WHERE r.startD >= ? AND r.endD <= ? AND r.startT >= ? AND r.endT <= ? AND sh.shopName = ? AND s.service = ?;';
			$statement = $pdo->prepare($sql);
			$statement->bindParam(1, $date);
			$statement->bindParam(2, $date);
			$statement->bindParam(3, $time);
			$statement->bindParam(4, $time);
			$statement->bindParam(5, $shopName);
			$statement->bindParam(6, $service);
			try{
				$ret = $statement->execute();
			}catch(Exception $e){
				// "Lookup error: ", $e->getMessage();
			}
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($row === TRUE){
				echo "There is already a reservation for that shop's service at that time on that day.";
			}else{
				$sql = 'SELECT custNo '.
					'FROM customer '.
					'WHERE fName = ? AND lName = ? AND password = ?;';
				$statement = $pdo->prepare($sql);
				$statement->bindParam(1, $_SESSION['fName']);
				$statement->bindParam(2, $_SESSION['lName']);
				$statement->bindParam(3, $_SESSION['password']);
				try{
					$ret = $statement->execute();
				}catch(Exception $e){
					// "Lookup error: ", $e->getMessage();
				}
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				$custNo = $row['custNo'];
				$timeE1 = new DateTime($time);
				if($minutes <= 60){
					date_add($timeE1, date_interval_create_from_date_string('1 hour'));
				}else{
					date_add($timeE1, date_interval_create_from_date_string('2 hour'));
				}
				$timeE = $timeE1->format('H:i:s');
				$sql = 'INSERT INTO reservation (custNo, shopNo, servNo, cost, startD, startT, endD, endT) '.
					'VALUES( ?, ?, ?, ?, ?, ?, ?, ?);';
				$statement = $pdo->prepare($sql);
				$statement->bindParam(1, $custNo);
				$statement->bindParam(2, $shopNo);
				$statement->bindParam(3, $servNo);
				$statement->bindParam(4, $cost);
				$statement->bindParam(5, $date);
				$statement->bindParam(6, $time);
				$statement->bindParam(7, $date);
				$statement->bindParam(8, $timeE);
				try{
					$ret = $statement->execute();
				}catch(Exception $e){
					// "Lookup error: ", $e->getMessage();
				}
				//header('Location: /makeReservation.php');
			}
		}
		}
    ?>
	
	<?php include 'static/footer.html'; ?>
</body>
</html>