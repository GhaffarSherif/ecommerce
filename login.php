<html>
<head>
	<title>GameExchange</title>

	<link rel="stylesheet" type="text/css" href="default.css">
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
				<h1 style='color: #e5edb8;'>Sign In</h1>
					<div class="pure-u-1-2 dpanel">
						<div>
							<legend>Enter your information</legend>
							<form action='' method='POST'>
								<table align="center">
									<tr style='color: #e5edb8;' id="dtable-item1">
										<td class="labelcell" style="margin-bottom: 5%">Username <span style="color: red">*</span></td>
										<td class="inputcell2">
										<input name="username" size="25" style="width: 75%;" />
										</td>
									</tr>
									<tr style='color: #e5edb8;' id="dtable-item2">
										<td class="labelcell">Password <span style="color: red">*</span></td>
										<td class="inputcell2">
										<input type="password" name="password" size="25" style="width: 75%;" />
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
					
				<p id="submitbutton">
					<input type="submit" name="submit" id="submit" value="Login" />
				</p>
				<?php
					require "database/databaseTools.php";
					require "database/loginFunctions.php";
					$DBH = loginToDatabase();
					if(isAlreadyLoggedIn()){
						echo "<script>window.location.assign('index.php');</script>";
					}
					
					if(isset($_POST["submit"])){
						loginUser($_POST, $DBH);
					}
				?>
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
</html>