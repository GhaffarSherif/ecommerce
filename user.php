 <html>
 <head>
 	<title>GameExchange</title>

	<link rel="stylesheet" type="text/css" href="lib/pure-min.css">
	<link rel="stylesheet" type="text/css" href="lib/grids-responsive-min.css">
	<link rel="stylesheet" type="text/css" href="styles/default.css">
 </head>
 <body>
	<?php 
		// Starting Session
		session_Start();
		//add the includes
		include './database/userFunctions.php';
		include './validation/validation.php';	
		
		// Validating URL
		userDisplayVal($_GET, $_SESSION);
		
	?>
     <div id="doverlay"></div>
	 <header>
         <div id="dmenu" class="dmenu pure-g">
			<?php require "scripts/createMenuBar.php"; createMenu($_SESSION); ?>
         </div>
     </header>
    
	<article>
	
		<h1>User Profile</h1>
			<div class="pure-u-1-2 dpanel">
				<div>
					<legend text-align="center">User Information</legend>
					<table align="left">
						<tr id="dtable-item1">
							<td class="labelcell" style="margin-bottom: 5%">Username: </td>
							<td></td>
							<td class="inputcell2">
							<?php getUsername($_GET['userp']);?>
							</td>
						</tr>
						<tr id="dtable-item2">
							<td class="labelcell">First Name: </td>
							<td></td>
							<td class="inputcell2">
							<?php getFname($_GET['userp']); ?>
							</td>
						</tr>
						<tr id="dtable-item2">
							<td class="labelcell">Last Name: </td>
							<td></td>
							<td class="inputcell2">
							<?php getLname($_GET['userp']); ?>
							</td>
						</tr>
						<tr id="dtable-item2">
							<td class="labelcell">Email: </td>
							<td></td>
							<td class="inputcell2">
							<?php getEmail($_GET['userp']); ?>
							</td>
						</tr>
						<tr id="dtable-item2">
							<td class="labelcell">Reputation: </td>
							<td></td>
							<td class="inputcell2">
							<?php //getRepuation($_GET['userp']); 
							?>
							</td>
						</tr>
						
						<?php 
							// Checking if the current user is owner of profile!
							if ($_GET['userp']  == $_SESSION['user']){
						?>
						
						<tr id="dtable-item2">
							<td class="labelcell">Address: </td>
							<td></td>
							<td class="inputcell2">
							<?php getAddress($_GET['userp']); ?>
							</td>
						</tr>
						<tr id="dtable-item2">
							<td class="labelcell">Phone Number: </td>
							<td></td>
							<td class="inputcell2">
							<?php getPhone($_GET['userp']); ?>
							</td>
						</tr>
						<tr id="dtable-item2">
							<td class="labelcell">Balance: </td>
							<td></td>
							<td class="inputcell2">
							<?php getBalance($_GET['userp']); ?>
							</td>
						</tr>	
						<?php 
							}
						?>
					</table>
				</div>
			</div>
		
	</article>
	
	<?php 
		// Checking if the current user is owner of profile!
		if ( $_GET['userp']  != $_SESSION['user']){
		?>
		<article>
			<div>
				<input value="Upvote User" name="upvote" type="button">
				<input value="Downvote User" name="downvote" type="button">
			</div>
		</article>
		<?php
		}
		else{
	?>
	<article>
		<form id="form2" method="post" action="">
			<h1>Modify Profile</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend text-align="center">Modify Your information</legend>
						<table align="center">
							
							<tr id="dtable-item2">
								<td class="labelcell">First Name:</td>
								<td class="inputcell2">
								<input name="fname" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Last Name:</td>
								<td class="inputcell2">
								<input name="lname" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Email:</td>
								<td class="inputcell2">
								<input name="email" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Address:</td>
								<td class="inputcell2">
								<input name="address" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Phone Number:</td>
								<td class="inputcell2">
								<input name="phone" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>
							<tr id="dtable-item2">
								<td class="labelcell">Withdraw Balance:</td>
								<td class="inputcell2">
								<input name="wbalance" type="text" size="25" style="width: 75%;" />
								</td>
							</tr>	
						</table>
					</div>
				</div>
			<p>
				<input type="submit" class="modify" name="modify" value="Confirm" />
			</p>
		</form>
	</article>
	
	<article>
		<form method="post" action="">
			<h1>Your Listings</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend text-align="center">Manage Your Listings:</legend>
						<table align="center">
							
						</table>
					</div>
				</div>
			<p>
				<input type="submit" class="modify" name="modify" value="Confirm" />
			</p>
		</form>
	</article>
	
	<article>
		<form method="post" action="">
			<h1>Your Orders</h1>
				<div class="pure-u-1-2 dpanel">
					<div>
						<legend text-align="center">View/Modify Your Orders</legend>
						<table align="center">
							
						</table>
					</div>
				</div>
			<p>
				<input type="submit" class="modify" name="modify" value="Confirm" />
			</p>
		</form>
	</article>
	
	<?php } ?>

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