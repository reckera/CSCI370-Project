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
	
	<h2 style="text-align:left;float:left;">Customer Sign In</h2>
	<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>
	
	<form method="POST" style="text-align:left;float:left;">
		<label for="fNameIn">First Name:</label>
		<input required="true" type="text" id="fNameIn" name="fNameIn"><br>
		<label for="lNameIn">Last Name:</label>
		<input required="true" type="text" id="lNameIn" name="lNameIn"><br>
		<label for="custPassIn">Password:</label>
		<input required="true" minlength=8 maxlength=8 type="text" id="custPassIn" name="custPassIn"><br>
		<input type="submit" name="custIn">
	</form>
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$fName = ($_POST['fNameIn']);
			$lName = ($_POST['lNameIn']);
			$password = ($_POST['custPassIn']);
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
			if($row === FALSE){
				echo "Wrong name(s) or password.";
			}else{
				$_SESSION['fName'] = $row['fName'];
				$_SESSION['lName'] = $row['lName'];
				$_SESSION['password'] = $password;
				header('Location: /cust/signIn.php');
			}
		}
	?>
	
	<hr style = "clear:both;"/>
	
	<?php include '../static/footer.html'; ?>
</body>
</html>