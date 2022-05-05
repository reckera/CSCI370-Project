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
	
	<h2 style="text-align:left;float:left;">Customer Sign Up</h2>
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
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
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$fName = ($_POST['fNameUp']);
			$lName = ($_POST['lNameUp']);
			$password = ($_POST['custPassUp']);
			$sql = 'SELECT * '.
				'FROM customer '.
				'WHERE fName = ? AND lname = ? AND password = ?;';
			$statement = $pdo->prepare($sql);
			$statement->bindParam(1, $fName);
			$statement->bindParam(2, $lName);
			$statement->bindParam(3, $password);
			try{
				$ret = $statement->execute();
			}catch(Exception $e){
				// "Lookup error: ", $e->getMessage();
			}
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($row === TRUE){
				echo "Name and password already exists.";
			}else{
				$address = ($_POST['addUp']);
				$phoneNum = ($_POST['phoneCustUp']);
				$sql = 'INSERT INTO customer (fName, lName, password, address, phoneNum) '.
					'VALUES(?, ?, ?, ?, ?);';
				$statement = $pdo->prepare($sql);
				$statement->bindParam(1, $fName);
				$statement->bindParam(2, $lName);
				$statement->bindParam(3, $password);
				$statement->bindParam(4, $address);
				$statement->bindParam(5, $phoneNum);
				try{
					$ret = $statement->execute();
				}catch(Exception $e){
					// "Lookup error: ", $e->getMessage();
				}
				$_SESSION['fName'] = $fName;
				$_SESSION['lName'] = $lName;
				$_SESSION['password'] = $password;
				header('Location: /cust/signUp.php');
			}
		}
	?>
	
	<hr style = "clear:both;"/>
	
	<?php include '../static/footer.html'; ?>
</body>
</html>