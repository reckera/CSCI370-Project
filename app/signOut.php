<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<link href="/static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include 'static/menu.php';
		if(isset($_SESSION['fName']) OR isset($_SESSION['shopName'])){
			session_destroy();
		}
		header('Location: index.php');
	?>
	
	<?php include 'static/connection.php'; ?>
	
	<form method='GET'>
		<label>Select type of sign in/up.</label>
		<select name="signIn">
		<option value ="newShop">new shop</option>
		<option value ="retShop">returning shop</option>
		<option value ="newCust">new customer</option>
		<option value ="retCust">returning customer</option>
		</select> 
		<input type="submit" value="select">
	</form>
	
	<?php 
		if(isset($_GET['signIn'])){
			if($_GET['signIn'] == "newShop"){
				header('Location: shop/signUp.php');
			}else if($_GET['signIn'] == "retShop"){
				header('Location: shop/signIn.php');
			}else if($_GET['signIn'] == "newCust"){
				header('Location: cust/signUp.php');
			}else{
				header('Location: cust/signIn.php');
			}
		}
	?>

	<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			if(isset($_POST['shopUp'])){
				$shopName = ($_POST['shopNameUp']);
				$password = ($_POST['shopPassUp']);
				$zipCode = ($_POST['zipUp']);
				$numMechanic = ($_POST['numMechUp']);
				$phoneNum = ($_POST['phoneShopUp']);
				$sql = 'INSERT INTO shop (shopName, password, numMechanic, zipCode) VALUES($shopName, $password, $numMechanic, $zipCode, $phoneNum);';
			}else if(isset($_POST['shopIn'])){
				$shopName = ($_POST['shopNameIn']);
				$password = ($_POST['shopPassIn']);
			}else if(isset($_POST['custUp'])){
				$fName = ($_POST['fNameUp']);
				$lName = ($_POST['lNameUp']);
				$password = ($_POST['custPassUp']);
				$address = ($_POST['addUp']);
				$phoneNum = ($_POST['phoneCustUp']);
				$sql = 'INSERT INTO customer (fName, lName, password, address, phoneNum) VALUES($fName, $lName, $password, $address, $phoneNum);';
			}else{
				$fName = ($_POST['fNameIn']);
				$password = ($_POST['custPassIn']);
			}
		}
	?>
	
	<?php include 'static/footer.html'; ?>
</body>
</html>