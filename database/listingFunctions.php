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
	//
	function deleteUserListing($list_id){
		$DBH = initializeListingDb();
		
		$STH = $DBH->prepare("UPDATE listing 
		SET status = 6
		WHERE listing_id='$list_id';");
		$STH->execute();
	}
	
	//
	function updateListing($POST, $list_id){
		$product_name = $POST["productName"];
		$category = $POST["category"];
		$price = $POST["price"];
		$item_condition = $POST["condition"];
		$product_description = $POST["description"];
		
		
		$DBH = initializeListingDb();
		

		if (!empty($product_name)){
			$STH = $DBH->prepare("UPDATE listing 
			SET product_name='$product_name'
			WHERE listing_id='$list_id';");
			$STH->execute();
		}
		if (!empty($category)){
			$STH = $DBH->prepare("UPDATE listing 
			SET category='$category'
			WHERE listing_id='$list_id';");
		$STH->execute();
		}
		if (!empty($price)){
			$STH = $DBH->prepare("UPDATE listing 
			SET price='$price'
			WHERE listing_id='$list_id';");
		$STH->execute();
		}
		if (!empty($item_condition)){
			$STH = $DBH->prepare("UPDATE listing 
			SET item_condition='$item_condition'
			WHERE listing_id='$list_id';");
			$STH->execute();
		}
		if (!empty($product_description)){
			$STH = $DBH->prepare("UPDATE listing 
			SET product_description='$product_description'
			WHERE listing_id='$list_id';");
			$STH->execute();
		}

	}
	
	// Checking if the listingID belongs to the given user_id or not
	function listingBelongsToUser($user_id, $list_id){
		$DBH = initializeListingDb();
		$STH = $DBH->query("SELECT user_id FROM listing WHERE listing_id='$list_id' ORDER BY listing_id DESC LIMIT 1");
		$row = $STH->fetch();
		
		if ($row['user_id'] == $user_id)
			return TRUE;
		else
			return FALSE;
	}
?>