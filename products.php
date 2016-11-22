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
		<div class="main">
			<div class="pure-u-3-4 dpanel">
				<form method='POST'>
					<table align="center">
						<td class="inputcell">
							<input name="search" placeholder="Search..." size="25" style="width: 75%;" />
						</td>
						<td class="inputcell">
							<select name="select">
								<option value="product_name">Product Name</option>
								<option value="item_condition">Condition</option>
							</select>
						</td>
						<td class="inputcell"><p><input type="submit" class="submit" name="Search" value="Search" /></p></td>
					</table>
				</form>
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
            Copyright 2015 Evil Corp
        </div>
    </footer>
    <script src="lib/jquery.js"></script>
    <script defer="defer" src="scripts/menu.js"></script>
    <script defer="defer" src="scripts/footer.js"></script>
</body>
</html>