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
			<?php session_start(); require "scripts/createMenuBar.php"; createMenu($_SESSION); ?>
        </div>
    </header>
    <article>
		<div id="main">
			<div class="pure-u-1-2 dpanel">
				<div>
					<img src='./img/logo.png' style="width:322px;height:322px;">
					<p> Welcome to GameExchange! An E-Commerce project developed by Sherif Ghaffar and Lucas Kourouklis !</p>
					<img src='./img/1.gif' style="width:128px;height:128px;" >
					<h2></h2>
				</div>
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