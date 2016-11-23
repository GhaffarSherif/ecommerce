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
		<?php
			require "database/databaseTools.php";
			require "database/cartFunctions.php";
			$DBH = loginToDatabase();
			createCart($DBH);
		?>
		<?php if(isset($_COOKIE["cart"])){ ?>
		<form action='checkout.php' method='POST'>
			<input type='submit' value='Purchase'/>
		</form>
		<?php } ?>
    </article>
    <footer>
		<div id='footer' class='dfooter'>
			Copyright 2016 GameExchange
		</div>
    </footer>
    <script src="lib/jquery.js"></script>
    <script defer="defer" src="scripts/menu.js"></script>
    <script defer="defer" src="scripts/footer.js"></script>
</body>
</html>