<?php
	function getProductDetails($GET, $DBH){
		$STH = $DBH->prepare("SELECT * FROM listing WHERE listing_id='" . $GET['listing_id'] . "'");
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
			
			echo "	<table cellspacing='10' style='color: white;'>
						<tr>
							<td colspan='3' align='center'>" . $row["product_name"] . "</td>
						</tr>
						<tr>
							<td rowspan='3'><img width='250px' height='250px' src='img/" . $rowcname["name"] . ".png' /></td>
							<td valign='top'>
								<table cellspacing='10'>
									<tr style='color: white;'><td valign='top'>Description:</td><td valign='top'>" . $row["product_description"] . "</td></tr>
									<tr style='color: white;'><td valign='top'>Price:</td><td valign='top'>$" . $row["price"] . "</td></tr>
									<tr style='color: white;'><td valign='top'>Condition:</td><td valign='top'>" . $row["item_condition"] . "</td></tr>
									<tr style='color: white;'><td valign='top'>Date Listed:</td><td valign='top'>" . $row["list_date"] . "</td></tr>
								</table>
							</td>
							<td rowspan='3' valign='top'>
								<table border='1' style='border-style: solid; border-width: medium;'>
									<tr style='color: white;'><td>USER</td><td>Reputation</td></tr>
									<tr style='color: white;'><td><a href='user.php?userp=" . $uid . "'>" . $rowuname["username"] . "</a></td>
									<td>" . $rep["count(feedback)"] . "</td></tr>
									<tr style='color: white;'><td colspan='2'>
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
		
		if(isset($_POST["report"])){
			reportListing($_POST["report"], $_SESSION["user"], $row, $DBH);
			echo '<script language="javascript">';
			echo 'alert("A ticket has been submitted!");';
			echo '</script>';
		}
		
		return $row;
	}
	
	function createBuyButton($row){
		echo "	<form action='cart.php' method='POST'>
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
?>