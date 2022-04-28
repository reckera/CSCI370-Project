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
	
	<hr>
	
	<h2>Reservation Entry</h2>
	
	<form>
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
	
	<?php include 'static/footer.html'; ?>
</body>
</html>