<?php 
	// Start the db and return DBH reference
	function initializeAdminDb(){
		$servername = "localhost";
		$username = "lucas";
		$password = "alpine";
		$dbname = "ecommerce";
		$DBH;
		try 
		{
			$DBH = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			return $DBH;
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage();
		}
	}
	
	// Admin can ban or lock accounts or grant them admin privilege or demote
	function updateUserStatus($POST ){
		$DBH = initializeAdminDb();
		
		$username = $POST["username"];
		$uStatus = $POST["uStatus"];
		
		
		$STH = $DBH->prepare("UPDATE user 
			SET status='$uStatus'
			WHERE username='$username';");
		$STH->execute();
		
	}
	
	// Admin can change status of a listing
	function updateListingStatus($POST){
		$DBH = initializeAdminDb();
		
		$listId = $POST["listId"];
		$lStatus = $POST["lStatus"];
		
		
		$STH = $DBH->prepare("UPDATE listing 
			SET status='$lStatus'
			WHERE listing_id='$listId';");
		$STH->execute();
	}
	
	// Admin can Change the status of tickets
	function updateTicketStatus($POST){
		$DBH = initializeAdminDb();
		
		$ticketId = $POST["ticketId"];
		$tStatus = $POST["tStatus"];
		$verifiedBy= $POST["verifiedBy"];
		
		
		$STH = $DBH->prepare("UPDATE ticket 
			SET status='$tStatus'
			WHERE ticket_id='$ticketId';");
		$STH->execute();
		
		$STH = $DBH->prepare("UPDATE ticket 
			SET verified_by='$verifiedBy'
			WHERE ticket_id='$ticketId';");
		$STH->execute();
	}
	
	// Admin can View open/pending tickets
	function viewOpenPendingTickets(){
		
	}
	
	function isAdmin($SESSION){
		$DBH = initializeAdminDb();
		$user_id = $SESSION['user'];
		
		$STH = $DBH->query("SELECT status FROM user WHERE user_id='$user_id'");
		$row = $STH->fetch();
		
		if ($row['status'] == 13){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	// Checking if the ticket with given id exists
	function ticketExists($POST){
		$DBH = initializeAdminDb();
		$ticketId = $POST['ticketId'];
		
		$STH = $DBH->query("SELECT * FROM ticket WHERE ticket_id='$ticketId'");
		$row = $STH->fetch();
		
		if ($row['ticket_id'] == null){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	// Checks if the listing with given id exists
	function listingExists($POST){
		$DBH = initializeAdminDb();
		$listId = $POST['listId'];
		
		$STH = $DBH->query("SELECT * FROM listing WHERE listing_id='$listId'");
		$row = $STH->fetch();
		
		if ($row['listing_id'] == null){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	// Checks if username exists in the database
	function usernameExists($POST){
		$DBH = initializeAdminDb();
		$username = $POST['username'];
		
		$STH = $DBH->query("SELECT * FROM user WHERE username='$username'");
		$row = $STH->fetch();
		
		if ($row['username'] == null){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function displayAllTickets(){
		// Logging into the db
		$DBH = initializeAdminDb();
		// Retriving all ticket details
		$STH = $DBH->prepare("SELECT * FROM ticket");
		$STH->execute();
		
		//Start building the table
		echo "<table border='1' style='border-style: solid; border-width: medium;' align='center'><tr style='color: #e5edb8;'>";
		echo "<th>Ticket ID</th><th>Sender</th><th>Listing ID</th><th>Verified By</th><th>Status</th><th>View Details</th></tr>";
		while($row = $STH->fetch()){
			//Save the user id, and category id in variables
			$uid = $row["sender_id"];
			$sid = $row["status"];
			
			//Get the username of sender
			$STHuname = $DBH->prepare("SELECT username FROM user WHERE user_id=" . $uid);
			$STHuname->execute();
			$rowuname = $STHuname->fetch();
			
			//Get the status name
			$STHsname = $DBH->prepare("SELECT name FROM status WHERE id=" . $sid);
			$STHsname->execute();
			$rowsname = $STHsname->fetch();
			
			
			
			//Put all the information into individual table cells
			echo "<tr style='color: #e5edb8;' align='center'>";
				echo "<td>" . $row["ticket_id"] . "</td>";
				echo "<td>" . $rowuname["username"] . "</td>";
				echo "<td>" . $row["listing_id"] . "</td>";
				echo "<td>" . $row["verified_by"] . "</td>";
				echo "<td>" . $rowsname["name"] . "</td>";
				echo "<td style='color: black;'>
						<form action='ticketView.php' method='GET'>
							<input type='hidden' id='ticket_id' name='ticket_id' value='" . $row['ticket_id'] . "' />
							<input type='submit' value='View Details' />
						</form>
					  </td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function dispalyTicketDetails($id){
		// Logging into the db
		$DBH = initializeAdminDb();
		
		// Retriving all ticket details
		$STH = $DBH->query("SELECT description FROM ticket WHERE ticket_id='$id'");
		$STH->execute();
		
		$row = $STH->fetch();
		
		echo $row['description'];
	}
		
?>