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
	
	<?php include 'static/connection.php'; ?>
	
	<h2>Shop Reservations</h2>
	<form method='GET'>
		<label>Select type of service.</label>
		<select name="service">
		<?php 
			include 'mem.php';
			$sql = 'SELECT DISTINCT s.service '.
				'FROM service s '.
				'ORDER BY s.service ASC;';
			$statement = $pdo->query($sql);
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$result = doQuery($mem, $pdo, $sql);
			if(isset($_GET['service'])){
				if($row['service'] != $_GET['service']){
					echo '<option value ="' . $_GET['service'] . '">' . $_GET['service'] . '</option>';
				}
				foreach($result as $row){
					if($row['service'] != $_GET['service']){
						echo '<option value ="' . $row['service'] . '">' . $row['service'] . '</option>';
					}
				}
			}else{
				foreach($result as $row){
					echo '<option value ="' . $row['service'] . '">' . $row['service'] . '</option>';
				}
			}
		?>
		</select> 
		<input type="submit" value="select">
	</form>

	<?php
		if(!isset($_GET['service'])){
			$service = 'oil change';
		}else{
			$service = $_GET['service'];
		}
		$sql = 'SELECT r.startD, r.startT, r.endT, sh.shopName, s.service '.
			'FROM reservation r '.
			'INNER JOIN shop sh on sh.shopNo = r.shopNo '.
			'INNER JOIN service s on s.servNo = r.servNo '.
			'WHERE r.startD >= ? AND s.service = ?'.
			'ORDER BY r.startD, r.startT ASC '.
			'LIMIT 10;';
		$statement = $pdo->prepare($sql);
		date_default_timezone_set('America/New_York');
		$statement->bindValue(1, date('Y-m-d'));
		$statement->bindValue(2, $service);
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
			<th>zip code</th>
			<th>phone number</th>
			<th>minutes</th>
			<th>price</th>
		</tr>
    <?php
		$sql = 'SELECT s.service, s.price, s.minutes, sh.phoneNum, sh.shopName, sh.zipCode '.
			'FROM service s '.
			'INNER JOIN shop sh on s.shopNo = sh.shopNo '.
			'WHERE s.service = ? '.
			'ORDER BY s.service, sh.shopName ASC;';
		$statement = $pdo->prepare($sql);
		$statement->bindParam(1, $service);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Lookup error: ", $e->getMessage();
		}
		$i=0;
		while(($row = $statement->fetch(PDO::FETCH_ASSOC)) && $i < 10){
			echo "<tr>";
			echo "<td>" . $row['service'] . "</td>";
			echo "<td>" . $row['shopName'] . "</td>";
			echo "<td>" . $row['zipCode'] . "</td>";
			echo "<td>" . $row['phoneNum'] . "</td>";
			echo "<td>" . $row['minutes'] . "</td>";
			echo "<td>" . $row['price'] . "</td>";
			echo "</tr>";
			$i++;
		}
    ?>
	</table>
	
	<?php include 'static/footer.html'; ?>
</body>
</html>