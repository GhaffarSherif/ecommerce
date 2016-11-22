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
	function getUserInfo($userp){
		$DBH = initializeDb();
		$STH = $DBH->query("SELECT * FROM user WHERE user_id='$userp'");
		return $STH->fetch();
		
	}
	function getUserBalance($userp){
		$DBH = initializeDb();
		$STH = $DBH->query("SELECT * FROM balance WHERE user_id='$userp'");
		return $STH->fetch();
	}
	function getUserReputation($userp){
		$DBH = initializeDb();
		$STH = $DBH->query("SELECT * FROM repuatation WHERE user_id='$userp'");
		return $STH;
	}
	
	// Retrieve Username of user
	function getUsername($userp){
		$row = getUserInfo($userp);
		
		echo $row["username"];
	}
	
	//retrieve First name of user
	function getFname($userp){
		$row = getUserInfo($userp);
		
		echo $row["fname"];
	}
	//retrieve Last Name of user
	function getLname($userp){
		$row = getUserInfo($userp);
		
		echo $row["lname"];
	}
	//retrieve Email of user
	function getEmail($userp){
		$row = getUserInfo($userp);
		
		echo $row["email"];
	}
	//retrive repuation of user
	function getRepuation($userp){
		$STH = getUserReputation($userp);
		$count = 0;
		while ($row = $STH->fetch()){
			$count = $count +1;
		} 
		echo $count;
	}
	// Retrive address from user
	function getAddress($userp){
		$row = getUserInfo($userp);
		
		echo $row["address"];
	}
	// Retrieve Phone from user
	function getPhone($userp){
		$row = getUserInfo($userp);
		
		echo $row["phone_num"];
	}
	// Retrieve Balance from user
	function getBalance($userp){
		$row = getUserBalance($userp);
		
		echo $row["total"];
	}
	
?>