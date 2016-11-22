<?php
	function displayAllListings($DBH){
		//Get all the listings
		$STH = $DBH->prepare("SELECT * FROM listing");
		$STH->execute();
		
		echo "<table border='1'><tr>";
		echo "<th>Posted By</th><th>Product Name</th><th>Category</th><th>Price</th><th>Condition</th><th>List Date</th><th></th></tr>";
		while($row = $STH->fetch()){
			//Save the user id, and category id in variables
			$uid = $row["user_id"];
			$cid = $row["category"];
			
			//Get the username
			$STHuname = $DBH->prepare("SELECT username FROM user WHERE user_id=" . $uid);
			$STHuname->execute();
			$rowuname = $STHuname->fetch();
			
			//Get the category name
			$STHcname = $DBH->prepare("SELECT name FROM category WHERE id=" . $cid);
			$STHcname->execute();
			$rowcname = $STHcname->fetch();
			
			//Put all the information into individual table cells
			echo "<tr>";
			echo "<td>" . $rowuname["username"] . "</td>";
			echo "<td>" . $row["product_name"] . "</td>";
			echo "<td>" . $rowcname["name"] . "</td>";
			echo "<td>" . $row["price"] . "</td>";
			echo "<td>" . $row["item_condition"] . "</td>";
			echo "<td>" . $row["list_date"] . "</td>";
			echo "<td><form action='product.php' method='GET'><input type='hidden' id='listing_id' name='listing_id' value='" . $row['listing_id'] . "' /><input type='submit' value='Go to'/></form></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>