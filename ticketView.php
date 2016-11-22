 <?php
	//starting session
	session_start();
	// adding the file I need
		include './database/adminFunctions.php';
	if (!isAdmin($_SESSION)){
		echo '<script language="javascript">';
		echo 'alert("NOT admin!");';
		echo '</script>';
		
		echo "<script>setTimeout(\"location.href = './index.php';\",0);</script>";
		exit();	
	}
	else if (!isset($_GET['ticket_id'])){
		echo "<script>setTimeout(\"location.href = './ticketView.php?ticket_id=1';\",0);</script>";
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
					<legend> Ticket Details For Ticket ID = <?php echo $_GET['ticket_id'] ?></legend>
					
					<p> <?php dispalyTicketDetails($_GET['ticket_id']) ?></p>
				</div>
			</div>
		</div>
		<p><input onClick="location.href = 'admin.php'" type="button" value="Back" /></p>
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
 
 