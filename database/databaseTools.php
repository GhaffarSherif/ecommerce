<?php
	function loginToDatabase(){
		$servername = "localhost";
		$username = "lucas";
		$password = "alpine";
		$dbname = "ecommerce";
		
		try {
			$DBH = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		
		return $DBH;
	}
?>