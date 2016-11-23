<?php
	function getProductDetails($GET, $DBH){
		//Get listing data
		$STH = $DBH->prepare("SELECT * FROM listing WHERE listing_id='" . $GET['id'] . "'");
		$STH->execute();
		$row = $STH->fetch();
		
		if($row != null){
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
			
			//Get the user reputation
			$STHrep = $DBH->prepare("SELECT count(feedback) FROM reputation WHERE user_id=" . $cid);
			$STHrep->execute();
			$rep = $STHrep->fetch();
			
			//Create the table
			echo "	<table cellspacing='10' style='color: #e5edb8;' align='center'>
						<tr>
							<td colspan='5' align='center'>" . $row["product_name"] . "</td>
						</tr>
						<tr>
							<td rowspan='3'><img width='250px' height='250px' src='img/" . $rowcname["name"] . ".png' /></td>
							<td rowspan='3'>&nbsp;</td>
							<td valign='top'>
								<table cellspacing='10'>
									<tr style='color: #e5edb8;'><td valign='top'>Description:</td><td>&nbsp;</td><td valign='top'>" . $row["product_description"] . "</td></tr>
									<tr style='color: #e5edb8;'><td valign='top'>Price:</td><td>&nbsp;</td><td valign='top'>$" . $row["price"] . "</td></tr>
									<tr style='color: #e5edb8;'><td valign='top'>Condition:</td><td>&nbsp;</td><td valign='top'>" . $row["item_condition"] . "</td></tr>
									<tr style='color: #e5edb8;'><td valign='top'>Date Listed:</td><td>&nbsp;</td><td valign='top'>" . $row["list_date"] . "</td></tr>
								</table>
							</td>
							<td rowspan='3'>&nbsp;</td>
							<td rowspan='3' valign='top'>
							
								<table border='1' style='border-style: solid; border-width: medium;'>
									<tr style='color: #e5edb8;'><td>USER</td><td>Reputation</td></tr>
									<tr style='color: #e5edb8;'><td><a href='user.php?userp=" . $uid . "'>" . $rowuname["username"] . "</a></td>
									<td align='right'>" . getRepuation($uid, $DBH) . "</td></tr>
									
									<tr style='color: #300018;'><td colspan='2'>
										<br />
										<form action='' method='POST'>
											<input type='hidden' id='report' name='report' value='' />
											<input type='submit' name='edit' onclick='promptMessage()' value='Report Listing' />
										</form>
										
										<script language='javascript'>
											promptMessage = function (){
												if(confirm('Are you sure you want to report this listing?')){
													var message = document.getElementById('report');
													message.value = prompt('Please enter a reason');
												}
											}
										</script>
									</td></tr>
								</table>
								
							</td>
						</tr>
					</table>";
		}
		
		print_r($_COOKIE);
		
		//Check if a report has been submitted
		if(isset($_POST["report"])){
			reportListing($_POST["report"], $_SESSION["user"], $row, $DBH);
			echo '<script language="javascript">';
			echo 'alert("A ticket has been submitted!");';
			echo '</script>';
		}
		
		//Check if the add to cart button has been pressed
		if(isset($_POST["listing_id"])){
			//Check for duplicates
			if(checkCart()){
				addToCart();
				echo '<script language="javascript">';
				echo 'alert("Item has been added to the cart!");';
				echo '</script>';
			}
			else{
				echo '<script language="javascript">';
				echo 'alert("Item is already in cart!");';
				echo '</script>';
			}
		}
		
		return $row;
	}
	
	function createBuyButton($row){
		echo "	<form action='' method='POST'>
					<input type='hidden' id='listing_id' name='listing_id' value='" . $row['listing_id'] . "' />
					<input type='submit' value='Add to Cart'/>
				</form>";
	}
	
	function reportListing($reason, $user, $row, $DBH){
		//Get the ID of PENDING status
		$STHpending = $DBH->prepare("SELECT id FROM status WHERE name='PENDING'");
		$STHpending->execute();
		$rowpending = $STHpending->fetch();
		
		//Insert the ticket
		$STH = $DBH->prepare("	INSERT INTO ticket (ticket_id, sender_id, listing_id, verified_by, description, status)
								VALUES (NULL, '" . $user . "', '" . $row["listing_id"] . "', NULL,
								'" . $reason . "', '" . $rowpending["id"] . "')");
		$STH->execute();
	}
	
	function addToCart(){
		//Check if there already is a cart
		if(isset($_COOKIE["cart"]) && !empty($_COOKIE["cart"])){
			//Remove slashes that are escaping quotes
			if(get_magic_quotes_gpc() == true){
				foreach($_COOKIE as $key){
					$_COOKIE[$key] = stripslashes($value);
				}
			}
			$cart = json_decode($_COOKIE["cart"], true); //Return to a regular array
			array_push($cart, $_GET["id"]); //Add the new item
			$json_cart = json_encode($cart); //Turn the cart to JSON
			setcookie("cart", $json_cart, time() + (86400 * 30), "/"); //Insert the cookie
		}
		else{
			$cart = array(); //Create an array			
			array_push($cart, $_GET["id"]); //Add the new item
			$json_cart = json_encode($cart); //Turn the cart to JSON
			setcookie("cart", $json_cart, time() + (86400 * 30), "/"); //Insert the cookie
		}
	}
	
	function checkCart(){
		if(isset($_COOKIE["cart"]) && !empty($_COOKIE["cart"])){
			//Remove slashes that are escaping quotes
			if(get_magic_quotes_gpc() == true){
				foreach($_COOKIE as $key){
					$_COOKIE[$key] = stripslashes($value);
				}
			}
			$cart = json_decode($_COOKIE["cart"], true); //Return to a regular array
			
			$listing_id = $_POST["listing_id"];
			
			//Dupilcation check 
			return ($key = array_search($listing_id, $cart)) === false;
		}
		else{
			return true;
		}
	}
	
	function getRepuation($userid, $DBH){
		$STH = getUserReputation($userid, $DBH);
		$counter = 0;
		$row = $STH->fetch();
		while (is_numeric($row['feedback'])){
			$counter = $counter + $row['feedback'];
			$row = $STH->fetch();
		} 
		return $counter;
	}
	
	function getUserReputation($userid, $DBH){
		$STH = $DBH->query("SELECT * FROM reputation WHERE user_id='$userid'");
		return $STH;
	}
?>