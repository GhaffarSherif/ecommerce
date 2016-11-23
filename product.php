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
			<div class="pure-u-1-2 dpanel">
				<?php
					require "database/databaseTools.php";
					require "database/productFunctions.php";
					
					$DBH = loginToDatabase();
					$row = getProductDetails($_GET, $DBH);
				?>
			</div>
		</div>
		<?php
			createBuyButton($row);
		?>
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