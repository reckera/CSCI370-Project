<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<link href="/static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include 'static/menu.html'; ?>
	
	<?php include 'static/connection.php'; ?>

	<h2 style="text-align:left;float:left;">Shop Sign Up</h2>
	<h2 style="text-align:right;float:right;">Shop Sign In</h2>
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
	<div>
		<form method="POST" style="text-align:left;float:left;">
			<label for="shopNameUp">Shop Name:</label>
			<input required="true" type="text" id="shopNameUp" name="shopNameUp"><br>
			<label for="shopPassUp">Password(8 characters):</label>
			<input required="true" minlength=8 maxlength=8 type="text" id="shopPassUp" name="shopPassUp"><br>
			<label for="zipUp">Zip Code:</label>
			<input required="true" minlength=5 maxlength=5 type="text" id="zipUp" name="zipUp"><br>
			<label for="numMechUp">Number of Mechanics:</label>
			<input required="true" type="text" id="numMechUp" name="numMechUp"><br>
			<label for="phoneShopUp">Phone Number (123-456-7890):</label>
			<input required="true" pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" type="text" id="phoneShopUp" name="phoneShopUp"><br>
			<input type="submit" name="shopUp">
		</form>
		<form method="POST" style="text-align:right;float:right;">
			<label for="shopNameIn">Shop Name:</label>
			<input required="true" type="text" id="shopNameIn" name="shopNameIn"><br>
			<label for="shopPassIn">Password(8 characters):</label>
			<input required="true" minlength=8 maxlength=8 type="text" id="shopPassIn" name="shopPassIn"><br>
			<input type="submit" name="shopIn">
		</form>
	</div>
	
	<hr style = "clear:both;"/>
	
	<h2 style="text-align:left;float:left;">Customer Sign Up</h2>
	<h2 style="text-align:right;float:right;">Customer Sign In</h2>
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
	<div>
		<form method="POST" style="text-align:left;float:left;">
			<label for="fNameUp">First Name:</label>
			<input required="true" type="text" id="fNameUp" name="fNameUp"><br>
			<label for="lNameUp">Last Name:</label>
			<input required="true" type="text" id="lNameUp" name="lNameUp"><br>
			<label for="custPassUp">Password(8 characters):</label>
			<input required="true" minlength=8 maxlength=8 type="text" id="custPassUp" name="custPassUp"><br>
			<label for="addUp">Address:</label>
			<input required="true" type="text" id="addUp" name="addUp"><br>
			<label for="phoneCustUp">Phone Number (123-456-7890):</label>
			<input required="true" pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" type="text" id="phoneCustUp" name="phoneCustUp"><br>
			<input type="submit" name="custUp">
		</form>
		<form method="POST" style="text-align:right;float:right;">
			<label for="fNameIn">First Name:</label>
			<input required="true" type="text" id="fNameIn" name="fNameIn"><br>
			<label for="custPassIn">Password:</label>
			<input required="true" minlength=8 maxlength=8 type="text" id="custPassIn" name="custPassIn"><br>
			<input type="submit" name="custIn">
		</form>
	</div>
	
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
	<?php/*
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(isset($_POST['shopUp'])){
				$shopName = ($_POST['shopNameUp'])
				$password = ($_POST['shopPassUp'])
				$zipCode = ($_POST['zipUp'])
				$numMechanic = ($_POST['numMechUp'])
				$phoneNum = ($_POST['phoneShopUp'])
				$sql = 'INSERT INTO shop (shopName, password, numMechanic, zipCode) VALUES($shopName, $password, $numMechanic, $zipCode, $phoneNum);
			}else if(isset($_POST['shopIn'])){
				$shopName = ($_POST['shopNameIn'])
				$password = ($_POST['shopPassIn'])
			}else if(isset($_POST['custUp'])){
				$fName = ($_POST['fNameUp'])
				$lName = ($_POST['lNameUp])
				$password = ($_POST['custPassUp'])
				$address = ($_POST['addUp'])
				$phoneNum = ($_POST['phoneCustUp'])
				INSERT INTO customer (fName, lName, password, address, phoneNum) VALUES($fName, $lName, $password, $address, $phoneNum);
			}else{
				$fName = ($_POST['fNameIn'])
				$password = ($_POST['custPassIn'])
			}
			$sql = 'INSERT r.startD, r.startT, r.endT, sh.shopName, s.service '.
				'FROM reservation r '.
				'INNER JOIN shop sh on sh.shopNo = r.shopNo '.
				'INNER JOIN service s on s.servNo = r.servNo '.
				'WHERE r.startD >= ? '.
				'ORDER BY r.startD, r.startT ASC '.
				'LIMIT 10;';
			$statement = $pdo->prepare($sql);
			date_default_timezone_set('America/New_York');
			$statement->bindValue(1, date('Y-m-d'), PDO::PARAM_STR);
		}
	*/?>
	
	<?php include 'static/footer.html'; ?>
</body>
</html>