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
				<table align="center">
					<tr id="dtable-item1">
						<td class="inputcell2">
							<input name="search" placeholder="Search..." size="25" style="width: 75%;" />
							<select name="category">
								<option value="user_id">Poster</option>
								<option value="product_name">Product Name</option>
								<option value="category">Category</option>
								<option value="item_condition">Condition</option>
							</select>
						</td>
					</tr>
				</table>
				<p><input type="submit" class="submit" name="submit" value="Search" /></p>
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