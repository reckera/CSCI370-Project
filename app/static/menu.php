<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<link href="/static/menu.css" rel="stylesheet" type="text/css" />
</head>

<h1><center><font size="+5"> CarBuddy </font></center></h1>

<?php 
session_start();
if(!isset($_SESSION['fName']) AND !isset($_SESSION['shopName'])){
	echo'<div>
		<ul id="menu">
			<li><a href="/">Home</a></li>
			<li><a href = "/reservations.php">See Reservations</a></li>
			<li><a href = "/makeReservation.php">Make Reservation</a>
				<ul>
					<li><a href = "/cust/signUp.php">New Customer</a></li>
					<li><a href = "/cust/signIn.php">Returning Customer</a></li>
				</ul>
			</li>
			<li><a>Sign In/Up</a>
				<ul>
					<li><a href = "/cust/signUp.php">New Customer</a></li>
					<li><a href = "/cust/signIn.php">Returning Customer</a></li>
					<li><a href = "/shop/signUp.php">New Shop</a></li>
					<li><a href = "/shop/signIn.php">Returning Shop</a></li>
				</ul>
			</li>
		</ul>
	</div>';
}else if(isset($_SESSION['fName'])){
	echo'<div>
		<ul id="menu">
			<li><a href="/">Home</a></li>
			<li><a href = "/reservations.php">See Reservations</a></li>
			<li><a href = "/makeReservation.php">Make Reservation</a></li>
			<li><a href = "/sign.php">Sign In/Up/Out</a>
				<ul>
					<li><a href = "/cust/signUp.php">New Customer</a></li>
					<li><a href = "/cust/signIn.php">Returning Customer</a></li>
					<li><a href = "/shop/signUp.php">New Shop</a></li>
					<li><a href = "/shop/signIn.php">Returning Shop</a></li>
					<li><a href = "/signOut.php">Sign Out</a></li>
				</ul>
			</li>
			<li><a>Current Customer Is '.$_SESSION["fName"].' '.$_SESSION["lName"].'</a></li>
		</ul>
	</div>';
}else{
	echo'<div>
		<ul id="menu">
			<li><a href="/">Home</a></li>
			<li><a href = "/reservations.php">See Reservations</a></li>
			<li><a href = "/makeReservation.php">Make Reservation</a></li>
			<li><a href = "/sign.php">Sign In/Up/Out</a>
				<ul>
					<li><a href = "/cust/signUp.php">New Customer</a></li>
					<li><a href = "/cust/signIn.php">Returning Customer</a></li>
					<li><a href = "/shop/signUp.php">New Shop</a></li>
					<li><a href = "/shop/signIn.php">Returning Shop</a></li>
					<li><a href = "/signOut.php">Sign Out</a></li>
				</ul>
			</li>
			<li><a>Current Shop Is '.$_SESSION["shopName"].'</a></li>
		</ul>
	</div>';
}
?>
<hr style = "clear:both; border:none; height:1px; margin:-1px 0;"/>