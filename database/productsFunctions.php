<?php
	function displayAllListings($POST, $DBH){
		if(!(isset($POST["Search"]))){
			//Get all the listings
			$STH = $DBH->prepare("SELECT * FROM listing");
			$STH->execute();
		}
		else{
			//Get search results
			$STH = $DBH->prepare("SELECT * FROM listing WHERE " . $POST["select"] . " LIKE '%" . $POST["search"] . "%'");
			$STH->execute();
		}
		
		//Start building the table
		echo "<table border='1' style='border-style: solid; border-width: medium;' align='center'><tr>";
		echo "<th>Image</td><th>Posted By</th><th>Product Name</th><th>Category</th><th>Price</th><th>Condition</th><th>List Date</th><th>Link</th></tr>";
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
			echo "<td><img style='width: 50px; height: 50px;' src='img/" . $rowcname["name"] . ".png' /></td>";
			echo "<td><a href='user.php?userp=" . $uid . "'>" . $rowuname["username"] . "</a></td>";
			echo "<td>" . $row["product_name"] . "</td>";
			echo "<td>" . $rowcname["name"] . "</td>";
			echo "<td>$" . $row["price"] . "</td>";
			echo "<td>" . $row["item_condition"] . "</td>";
			echo "<td>" . $row["list_date"] . "</td>";
			echo "<td><form action='product.php' method='GET'><input type='hidden' id='listing_id' name='listing_id' value='" . $row['listing_id'] . "' /><input type='submit' value='Go to'/></form></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>