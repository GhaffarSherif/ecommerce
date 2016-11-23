<?php
	session_start();
	if(!(isset($_SESSION["user"]))){
		echo '<script language="javascript">';
		echo 'alert("Please log in or register before checking out!");';
		echo '</script>';
		
		echo "<script>setTimeout(\"location.href = './login.php';\",0);</script>";
		exit();
	}
?>
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
			<?php require "scripts/createMenuBar.php"; createMenu($_SESSION); ?>
		</div>
	</header>
    <article>
		<div class="main">
			<div class="pure-u-3-4 dpanel">
				<?php
					require "database/databaseTools.php";
					require "database/checkoutFunctions.php";
					
					$DBH = loginToDatabase();
					
					showCart($DBH);
				?>
				<form method='POST'>
					<input type="hidden" id="confirm" name="confirm" value="" />
					<input type="submit" name="edit" onclick="promptMessage()" value="Confirm" />
				</form>
				
				<script language="javascript">
					promptMessage = function () {
						confirm('Are you sure you want to purchase everything in the cart?');
					}
				</script>
			</div>
		</div>
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