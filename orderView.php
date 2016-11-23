  <?php
	//starting session
	session_start();
	// adding the file I need
		include './database/userFunctions.php';
		
	if (!isset($_GET['order_id'])){
		echo "<script>alert('No order id selected'); setTimeout(\"location.href = './index.php';\",0);</script>";
		exit();	
	}
	if (!orderBelongsToUser($_GET, $_SESSION)){
		echo "<script>alert('Listing does not belong to you!'); setTimeout(\"location.href = './index.php';\",0);</script>";
		exit();
	}
 ?>
 
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
			<?php require "scripts/createMenuBar.php"; createMenu($_SESSION); ?>
        </div>
    </header>
    <article>
		<div>
			<div class="pure-u-1-2 dpanel">
				<div>
					<legend> Order Details For order ID #<?php echo $_GET['order_id'] ?></legend>
					
					<p> <?php displayUserOrderDetail($_GET['order_id']) ?></p>
				</div>
			</div>
		</div>
		<p><form action"" method="post"> <input onClick="location.href = 'user.php'" type="button" value="Back" />
		
		<input name="refund" type="submit" value="Refund" /></form></p>
		
    </article>
	
        <footer>
         <div id="footer" class="dfooter">
             Copyright 2016 GameExchange
         </div>
     </footer>
     <script src="lib/jquery.js"></script>
     <script defer="defer" src="scripts/menu.js"></script>
     <script defer="defer" src="scripts/footer.js"></script>
	 <?php 
		// If user submits, then validate user input!
		if(isset($_POST["refund"]) && !isRefunded($_GET))
		{
			// Refund the user's order
			refundOrder($_SESSION["user"], $_GET); 
			// Alerting user that change was successful!
			echo '<script language="javascript">';
			echo 'alert("Purchase Refunded!");';
			echo '</script>';
		}
	 ?>
	
 </body>
 </html>
 
 