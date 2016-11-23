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
		$STH = $DBH->query("SELECT * FROM reputation WHERE user_id='$userp'");
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
		$counter = 0;
		$row = $STH->fetch();
		while (is_numeric($row['feedback'])){
			$counter = $counter + $row['feedback'];
			$row = $STH->fetch();
		} 
		echo $counter;
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
		
		echo $row["current_balance"];
	}
	
	// Retrieve Balance from user
	function enoughMoney($userp, $requested){
		$row = getUserBalance($userp);
		
		if ($row["current_balance"] - $requested <0)
			return FALSE;
		else 
			return TRUE;
		
	}
	
	// A user upvotes another use 
	function upvoteUser($SESSION, $GET){
		$visitor_id = $SESSION['user'];
		$user_id = $GET['userp'];
		
		$DBH = initializeDb();
		$STH = $DBH->prepare("INSERT INTO reputation(user_id, reviewer_id, feedback)
		VALUES ('$user_id', '$visitor_id', '1') ON DUPLICATE KEY UPDATE feedback=1");
		$STH->execute();
	}
	
	// A user downvote another user
	function downvoteUser($SESSION, $GET){
		$visitor_id = $SESSION['user'];
		$user_id = $GET['userp'];
		
		$DBH = initializeDb();
		$STH = $DBH->prepare("INSERT INTO reputation(user_id, reviewer_id, feedback)
		VALUES ('$user_id', '$visitor_id', '-1') ON DUPLICATE KEY UPDATE feedback=-1");
		$STH->execute();
	}
	
	// Modify user information
	function modifyInformation($POST, $userId){
		$fname = $POST['fname'];
		$lname = $POST['lname'];
		$email = $POST['email'];
		$address = $POST['address'];
		$phone_num = $POST['phone_num'];
		$wbalance = $POST['wbalance'];
		
		$DBH = initializeDb();
		if (!empty($fname)){
			$STH = $DBH->prepare("UPDATE user 
			SET fname='$fname' WHERE user_id='$userId'");
			$STH->execute();
			return TRUE;
		}
		if (!empty($lname)){
			$STH = $DBH->prepare("UPDATE user 
			SET lname='$lname' WHERE user_id='$userId'");
			$STH->execute();
			return TRUE;
		}
		if (!empty($email)){
			$STH = $DBH->prepare("UPDATE user 
			SET email='$email' WHERE user_id='$userId'");
			$STH->execute();
			return TRUE;
		}
		if (!empty($address)){
			$STH = $DBH->prepare("UPDATE user 
			SET address='$address' WHERE user_id='$userId'");
			$STH->execute();
			return TRUE;
		}
		if (!empty($phone_num)){
			$STH = $DBH->prepare("UPDATE user 
			SET phone_num='$phone_num' WHERE user_id='$userId'");
			$STH->execute();
			return TRUE;
		}
		if (!empty($wbalance) && enoughMoney($userId, $wbalance)){
			$STH = $DBH->prepare("UPDATE balance 
			SET current_balance=current_balance-'$wbalance' WHERE user_id='$userId'");
			$STH->execute();
			return TRUE;
		}
		else {
			echo '<script language="javascript">';
			echo 'alert("You do not have that much momey");';
			echo '</script>';
			return FALSE;
		}
	}
	// Show a user his orders
	function displayUserOrders($SESSION){
		$givenId = $SESSION['user'];
		// Logging into the db
		$DBH = initializeAdminDb();
		// Retriving all ticket details
		$STH = $DBH->prepare("SELECT * FROM orders WHERE user_id ='$givenId'");
		$STH->execute();
		
		//Start building the table
		echo "<table border='1' style='border-style: solid; border-width: medium;' align='center'><tr style='color: #e5edb8;'>";
		echo "<th>Order #</th><th>Date</th><th>Total</th><th>Status</th><th>View Details</th></tr>";
		while($row = $STH->fetch()){
			//Save the status id into category
			$sid = $row["status"];
			
			
			//Get the status name
			$STHsname = $DBH->prepare("SELECT name FROM status WHERE id=" . $sid);
			$STHsname->execute();
			$rowsname = $STHsname->fetch();
			
			
			
			//Put all the information into individual table cells
			echo "<tr align='center'>";
				echo "<td>" . $row["order_id"] . "</td>";
				echo "<td>" . $row["order_date"] . "</td>";
				echo "<td>" . $row["order_total"] . "</td>";
				echo "<td>" . $rowsname["name"] . "</td>";
				echo "<td><form action='orderView.php' method='GET'><input type='hidden' id='order_id' name='order_id' value='" . $row['order_id'] . "' /><input type='submit' value='View Details' /></form></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	// Display for the user 
	function displayUserOrderDetail($id){
		// Logging into the db
		$DBH = initializeDb();
		
		
		// Retriving all order_items that correspond to the use
		$STH = $DBH->query("SELECT * FROM order_item WHERE order_id='$id'");
		$STH->execute();
		
		//Start building the table
		echo "<table border='1' style='border-style: solid; border-width: medium;' align='center'><tr style='color: #e5edb8;'>";
		echo "<th>#</th><th>Product Name</th><th>Price</th></tr>";
		
		$count = 1;
		while($row = $STH->fetch()){
			//Save the status id into category
			$pid = $row["product_id"];
			
			
			//Get the status name
			$STHpname = $DBH->prepare("SELECT product_name FROM listing WHERE listing_id=" . $pid);
			$STHpname->execute();
			$rowpname = $STHpname->fetch();
			
			// Get the price of item
			$STHcname = $DBH->prepare("SELECT price FROM listing WHERE listing_id=" . $pid);
			$STHcname->execute();
			$rowcname = $STHcname->fetch();
			
			
			
			//Put all the information into individual table cells
				echo "<tr align='center'>";
				echo "<td>" . $count . "</td>";
				echo "<td>" . $rowpname["product_name"] . "</td>";
				echo "<td>" . $rowcname["price"] . "</td>";
				echo "</tr>";
				
				
				$count++;
		}
		echo "</table>";
	}
	// Refund the order of the user
	function refundOrder($userId, $GET){
		$order_id = $GET['order_id'];
		// Logging into the db
		$DBH = initializeDb();
		
		// Retriving order that wants to be refunded
		$STH = $DBH->query("SELECT order_total FROM orders WHERE order_id='$order_id'");
		$STH->execute();
		
		$row = $STH->fetch();
		$refundAmount = $row['order_total'];
		
		// Changing the status of the Order to Refunded!
		$STH = $DBH->prepare("UPDATE orders SET status = 14  WHERE order_id = $order_id");
		$STH->execute();
		
		// Adding Refund to balance
		$STH = $DBH->prepare("UPDATE balance SET current_balance = current_balance + '$refundAmount' WHERE user_id=$userId");
		$STH->execute();
		
		
		
	}
	
	// Checking if the purchase is already refunded!
	function isRefunded($GET){
		$order_id = $GET['order_id'];
		// Logging into the db
		$DBH = initializeDb();
		
		// Changing the status of the Order to Refunded!
		// Retriving order that wants to be refunded
		$STH = $DBH->query("SELECT status FROM orders WHERE order_id='$order_id'");
		$STH->execute();
		
		$row = $STH->fetch();
		
		if ($row['status'] == 14)
			return TRUE;
		
		else{
			echo '<script language="javascript">';
			echo 'alert("Purchase Already Refunded!");';
			echo '</script>';
			
			return FALSE;
		}
		
	}
	
	// Displaying all use Listings in a table
	function displayAllUserListings($SESSION){
		$givenId = $SESSION['user'];
		
		// Logging into the db
		$DBH = initializeAdminDb();
		
		// Retriving all Lisitng details for user
		$STH = $DBH->prepare("SELECT * FROM listing WHERE user_id ='$givenId'");
		$STH->execute();
		
		//Start building the table
		echo "<table border='1' style='border-style: solid; border-width: medium;' align='center'><tr style='color: #e5edb8;'>";
		echo "<th>Product Name</th><th>Category</th><th>Price</th><th>Condition</th><th>List Date</th><th>Modify</th></tr>";
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
			echo "<tr style='color: #e5edb8;'>";
			echo "<td align='center'>" . $row["product_name"] . "</td>";
			echo "<td align='center'>" . $rowcname["name"] . "</td>"; 
			echo "<td align='center'>$" . $row["price"] . "</td>";
			echo "<td align='center'>" . $row["item_condition"] . "</td>";
			echo "<td align='center'>" . $row["list_date"] . "</td>";
			echo "	<td align='center'>
						<form action='modifyListing.php' method='GET'>
							<input type='hidden' id='listing_id' name='listing_id' value='" . $row['listing_id'] . "' />
							<input style='color: #300018;' type='submit' value='Edit'/>
						</form>
					</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	// Checking if the order ID belongs to user or not
	function orderBelongsToUser($GET, $SESSION){
		$givenId = $SESSION['user'];
		$orderId = $GET['order_id'];
		
		// Logging into the db
		$DBH = initializeDb();
		// Retriving all ticket details
		$STH = $DBH->query("SELECT order_id FROM orders WHERE user_id ='$givenId'");
		$STH->execute();
		
		while ($row = $STH->fetch()){
			if ($row['order_id'] == $orderId)
				return TRUE;
			
		}
		return FALSE;
	}
	
	
	
	
?>