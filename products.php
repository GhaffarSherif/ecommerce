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
		<form method='POST'>
			<table align="center">
				<td><input name="search" placeholder="Search..." size="25" /></td>
				<td>
					<select name="select">
						<option value="product_name">Product Name</option>
						<option value="item_condition">Condition</option>
					</select>
				</td>
				<td><p><input type="submit" class="submit" name="Search" value="Search" /></p></td>
			</table>
		</form>
		<div class="main">
			<div class="pure-u-1-3 dpanel">
				<?php
					require "database/databaseTools.php";
					require "database/productsFunctions.php";
					
					$DBH = loginToDatabase();
					
					displayAllListings($_POST, $DBH);
				?>
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