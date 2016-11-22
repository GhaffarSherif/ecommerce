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
	// user_id, product_name, category, price, item_condition, product_description, list_date, status
	function insertListing($POST, $SESSION){
		$DBH = initializeDb();
		
		$user_id = $SESSION["user"];
		$product_name = $POST["productName"];
		$category = $POST["category"];
		$price = $POST["price"];
		$item_condition =$POST["condition"];
		$product_description = $POST["description"];
		$list_date = date('Y-m-d');
		$status = 7;
		
	

		//print ("Your name is: $fname $lname<br />Your e-mail is: $email<br />This is your message: $message<br /><br />");

		$STH = $DBH->prepare("INSERT INTO listing(user_id, product_name, category, price, item_condition, product_description, list_date, status)
		VALUES ('$user_id', '$product_name', '$category', '$price', '$item_condition', '$product_description', '$list_date', '$status')");
		$STH->execute();
	}
?>