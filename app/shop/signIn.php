<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<link href="../static/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include '../static/menu.php'; ?>
	
	<h2 style="text-align:left;float:left;">Shop Sign In</h2>
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
	<form method="POST" style="text-align:left;float:left;">
		<label for="shopNameIn">Shop Name:</label>
		<input required="true" type="text" id="shopNameIn" name="shopNameIn"><br>
		<label for="shopPassIn">Password(8 characters):</label>
		<input required="true" minlength=8 maxlength=8 type="text" id="shopPassIn" name="shopPassIn"><br>
		<input type="submit" name="shopIn">
	</form>
	
	<?php 
		include '../static/connection.php';
		include '../mem.php';
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$shopName = ($_POST['shopNameIn']);
			$password = ($_POST['shopPassIn']);
			$sql = 'SELECT * '.
				'FROM shop '.
				'WHERE shopName = ? AND password = ?;';
			$statement = $pdo->prepare($sql);
			$statement->bindParam(1, $shopName);
			$statement->bindParam(2, $password);
			$row = doQuery($mem, $statement, $sql);
			if($row === FALSE){
				echo "Wrong shop name or password.";
			}else{
				$_SESSION['shopName'] = $shopName;
				$_SESSION['password'] = $password;
				header('Location: /shop/signIn.php');
			}
		}
	?>
	
	<hr style = "clear:both;"/>
	
	<?php include '../static/footer.html'; ?>
</body>
</html>