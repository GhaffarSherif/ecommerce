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
            Copyright 2015 Evil Corp
        </div>
    </footer>
    <script src="lib/jquery.js"></script>
    <script defer="defer" src="scripts/menu.js"></script>
    <script defer="defer" src="scripts/footer.js"></script>
</body>
</html>

<?php
	//If a report has been issued, submit the report
	/*if(isset($_POST["report"])){
		reportListing($_POST["report"], $_SESSION["user"], $row, $DBH);
		echo '<script language="javascript">';
		echo 'alert("A ticket has been submitted!");';
		echo '</script>';
	}*/
?>