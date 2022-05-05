<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<link href="../static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include '../static/menu.php'; ?>
	
	<?php include '../static/connection.php'; ?>
	
	<h2 style="text-align:left;float:left;">Shop Sign Up</h2>
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
	<form method="POST" style="text-align:left;float:left;">
		<label for="shopNameUp">Shop Name:</label>
		<input required="true" type="text" id="shopNameUp" name="shopNameUp"><br>
		<label for="shopPassUp">Password(8 characters):</label>
		<input required="true" minlength=8 maxlength=8 type="text" id="shopPassUp" name="shopPassUp"><br>
		<label for="zipUp">Zip Code:</label>
		<input required="true" minlength=5 maxlength=5 type="text" id="zipUp" name="zipUp"><br>
		<label for="phoneShopUp">Phone Number (123-456-7890):</label>
		<input required="true" pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" type="text" id="phoneShopUp" name="phoneShopUp"><br>
		<input type="submit" name="shopUp">
	</form>
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$shopName = ($_POST['shopNameUp']);
			$password = ($_POST['shopPassUp']);
			$sql = 'SELECT * '.
				'FROM shop '.
				'WHERE shopName = ? AND password = ?;';
			$statement = $pdo->prepare($sql);
			$statement->bindParam(1, $shopName);
			$statement->bindParam(2, $password);
			try{
				$ret = $statement->execute();
			}catch(Exception $e){
				// "Lookup error: ", $e->getMessage();
			}
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($row === TRUE){
				echo "Shop name and password already exists.";
			}else{
				$zip = ($_POST['zipUp']);
				$phoneNum = ($_POST['phoneshopUp']);
				$sql = 'INSERT INTO shop (shopName, password, zip, phoneNum) '.
					'VALUES(?, ?, ?, ?);';
				$statement = $pdo->prepare($sql);
				$statement->bindParam(1, $shopName);
				$statement->bindParam(2, $password);
				$statement->bindParam(3, $zip);
				$statement->bindParam(4, $phoneNum);
				try{
					$ret = $statement->execute();
				}catch(Exception $e){
					// "Lookup error: ", $e->getMessage();
				}
				$_SESSION['shopName'] = $shopName;
				$_SESSION['password'] = $password;
				header('Location: /shop/signUp.php');
			}
		}
	?>
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			if(isset($_POST['shopUp'])){
				$shopName = ($_POST['shopNameUp']);
				$password = ($_POST['shopPassUp']);
				$zipCode = ($_POST['zipUp']);
				$phoneNum = ($_POST['phoneShopUp']);
				$sql = 'INSERT INTO shop (shopName, password, zipCode) VALUES($shopName, $password, $zipCode, $phoneNum);';
			}
		}
	?>
	
	<hr style = "clear:both;"/>
	
	<?php include '../static/footer.html'; ?>
</body>
</html>