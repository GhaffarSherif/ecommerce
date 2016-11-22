 <html>
 <head>

 	<title>GameExchange</title>
  
 	<meta name="description" content="Project for E-commerece class">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="Sherif Ghaffar, Lucas Kourouklis">

	<link rel="stylesheet" type="text/css" href="lib/pure-min.css">
	<link rel="stylesheet" type="text/css" href="lib/grids-responsive-min.css">
	<link rel="stylesheet" type="text/css" href="styles/default.css">
    
 
 </head>
 <body>
 <?php
	// Starting the session!
	session_start();
	// validating the data and then inserting into db
	include './validation/validation.php';
	include './database/adminFunctions.php';
	
	// Checking if user is admin or not!
	adminStartVal($_SESSION);
	
 ?>
     <div id="doverlay"></div>
     
	 <header>
         <div id="dmenu" class="dmenu pure-g">
			<?php  require "scripts/createMenuBar.php"; createMenu($_SESSION); ?>
         </div>
     </header>
    
	<article>
		<form method="post" action="" onsubmit="form.submit.disabled = true;">
			<h1>Manage User Accounts</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend text-align="center">Select What To Do With User:</legend>
						<table align="center">
							<tr id="dtable-item1">
								<td class="labelcell" style="margin-bottom: 5%">Username: </td>
								<td class="inputcell2">
								<input name="username" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
									<td class="labelcell">User Status:</td>
									<td class="inputcell2">
									<select name="uStatus">
									  <option value="5">BAN</option>
									  <option value="6">LOCK</option>
									  <option value="12">User</option>
									  <option value="13">Admin</option>
									</select>
									</td>
								</tr>
						</table>
					</div>
				</div>
			<p id="submitbutton">
				<input type="submit" name="userStatus" class="userStatus" value="Confirm" />
			</p>
		</form>
	</article>
	
	<article>
		<form method="post" action="">
			<h1>Manage Listings</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend>Select A Listing To Remove:</legend>
						<table align="center">
							<tr id="dtable-item2">
								<td class="labelcell">Listing Id:</td>
								<td class="inputcell2">
								<input name="listId" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Status:</td>
								<td class="inputcell2">
								<select name="lStatus">
								  <option value="7">AVAILABLE</option>
								  <option value="8">PURCHASED</option>
								  <option value="6">LOCKED</option>
								</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<p>
				<input type="submit" name="listingStatus" value="Confirm" />
			</p>
		</form>
	</article>
	
	<article>
		<form method="post" action="">
			<h1>Manage Tickets</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend >View Tickets</legend>
						<table align="center">
							
							<tr id="dtable-item2">
								<td class="labelcell">Display OPEN tickets here</td>
								<td class="inputcell2">
								</td>
							</tr>
							
						</table>
					</div>
					
					<legend>Change Ticket Status</legend>
					<table align="center">
							
							<tr id="dtable-item2">
								<td class="labelcell">Ticket ID:</td>
								<td class="inputcell2">
								<input type="text" name="ticketId" >
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Status:</td>
								<td class="inputcell2">
								<select name="tStatus">
								  <option value="1">OPEN</option>
								  <option value="2">CLOSED</option>
								  <option value="3">PENDING</option>
								</select>
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Verified By:</td>
								<td class="inputcell2">
								<input type="text" name="verifiedBy" >
								</td>
							</tr>
						</table>
				</div>
			<p>
				<input type="submit" name="ticketStatus" class="ticketStatus" value="Confirm" />
			</p>
		</form>
	</article>

        <footer>
         <div id="footer" class="dfooter">
             Copyright 2015 Evil Corp
         </div>
     </footer>
     <script src="lib/jquery.js"></script>
     <script defer="defer" src="scripts/menu.js"></script>
     <script defer="defer" src="scripts/footer.js"></script>

	 <?php
		
		// If user submits, then validate user input!
		if(isset($_POST["userStatus"]))
		{
			// DO some SQL INSERT to add product to DATABASE!
			updateUserStatus($_POST);
			// Alerting user that change was successful!
			echo '<script language="javascript">';
			echo 'alert("User Status Changed!");';
			echo '</script>';
			// Redirect to the product
		}
		
		if(isset($_POST["listingStatus"]) && listingExists($_POST)){
			// DO some SQL INSERT to add product to DATABASE!
			updateListingStatus($_POST);
			// Alerting user that change was successful!
			echo '<script language="javascript">';
			echo 'alert("Listing Status Changed!");';
			echo '</script>';
			// Redirect to the product
		}
		
		if(isset($_POST["ticketStatus"]) && ticketExists($_POST)){
			// DO some SQL INSERT to add product to DATABASE!
			updateTicketStatus($_POST);
			// Alerting user that change was successful!
			echo '<script language="javascript">';
			echo 'alert("Ticket Status Changed!");';
			echo '</script>';
			// Redirect to the product
		}
	 ?>
	 
	 
 </body>
 </html>