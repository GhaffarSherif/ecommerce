<html>
<head>
 	<title>GameExchange</title>

	<link rel="stylesheet" type="text/css" href="lib/pure-min.css">
	<link rel="stylesheet" type="text/css" href="lib/grids-responsive-min.css">
	<link rel="stylesheet" type="text/css" href="styles/default.css">
</head>
<body>
	<div id="doverlay"></div>
	<header>
		<div id="dmenu" class="dmenu pure-g">
			<?php session_start(); require "scripts/createMenuBar.php"; createMenu($_SESSION); ?>
		</div>
	</header>
	<article>
		<form id="form2" method="post" action="">
			<div id="main">
				<h1>Register</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend>Enter your information</legend>
						<table align="center">
							<tr id="dtable-item1">
								<td class="labelcell" style="margin-bottom: 5%">Username<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="username" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Password<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="password" type="password" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Confirm Password<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="cpassword" type="password" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">First Name<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="fname" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Last Name<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="lname" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Email<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="email" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Address<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="address" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Phone<span style="color: red">*</span></td>
								<td class="inputcell2">
								<input name="phone" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							
						</table>
						<p class='result'></p>
					</div>
					<?php					
						include 'validation/validation.php';
						require "database/databaseTools.php";
						require "database/registerFunctions.php";
						$DBH = loginToDatabase();
						
						// If user submits then validate user input!
						if(isset($_POST["submit"]) && registerVal($_POST["username"], $_POST["password"], $_POST["cpassword"], $_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["address"], $_POST["phone"])){
							registerUser($_POST, $DBH); //Function to insert user information to database
							// Alerting user that registering was successful!
							echo '<script language="javascript">alert("Registeration Successful!");</script>';
						}
					?>
				</div>
				<p>
					<input type="submit" class="submit" name="submit" value="Register" />
				</p>
			</div>
		</form>
	</article>
    <footer>
        <div id="footer" class="dfooter">
            Copyright 2016 GameExchange
        </div>
    </footer>
    <script src="lib/jquery.js"></script>
    <script defer="defer" src="scripts/menu.js"></script>
    <script defer="defer" src="scripts/footer.js"></script>
</body>
</html