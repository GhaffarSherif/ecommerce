<?php 
	// Start the db and return DBH reference
	function initializeDb(){
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
		$DBH = initializeDb();
		
		$username = $POST["username"];
		$uStatus = $POST["uStatus"];
		
		
		$STH = $DBH->prepare("UPDATE user 
			SET status='$uStatus'
			WHERE username='$username';");
		$STH->execute();
		
	}
	
	// Admin can change status of a listing
	function updateListingStatus($POST){
		$DBH = initializeDb();
		
		$listId = $POST["listId"];
		$lStatus = $POST["lStatus"];
		
		
		$STH = $DBH->prepare("UPDATE listing 
			SET status='$lStatus'
			WHERE listing_id='$listId';");
		$STH->execute();
	}
	
	// Admin can Change the status of tickets
	function updateTicketStatus($POST){
		$DBH = initializeDb();
		
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
		$DBH = initializeDb();
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
	
	// Checking if the listing exists
	function ticketExists($POST){
		$DBH = initializeDb();
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
	
	function listingExists($POST){
		$DBH = initializeDb();
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
?>