<?php 
	// Start the db and return DBH reference
	function initializeListingDb(){
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
		$DBH = initializeListingDb();
		
		$user_id = $SESSION["user"];
		$product_name = $POST["productName"];
		$category = $POST["category"];
		$price = $POST["price"];
		$item_condition = $POST["condition"];
		$product_description = $POST["description"];
		$list_date = date('Y-m-d');
		$status = 7;
		

		$STH = $DBH->prepare("INSERT INTO listing(user_id, product_name, category, price, item_condition, product_description, list_date, status)
		VALUES ('$user_id', '$product_name', '$category', '$price', '$item_condition', '$product_description', '$list_date', '$status')");
		$STH->execute();
	}
	function getPostedListId($productName){
		$DBH = initializeListingDb();
		
		
		$STH = $DBH->query("SELECT * FROM listing WHERE product_name='$productName' ORDER BY listing_id DESC LIMIT 1");
		$row = $STH->fetch();
		return $row['listing_id'];
	}
?>