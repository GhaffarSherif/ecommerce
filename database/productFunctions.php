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
			
			echo "	<table cellspacing='10'>
						<tr>
							<td colspan='3' align='center'>" . $row["product_name"] . "</td>
						</tr>
						<tr>
							<td rowspan='3'><img width='250px' height='250px' src='img/" . $rowcname["name"] . ".png' /></td>
							<td valign='top'>
								<table cellspacing='10'>
									<tr><td>Description:</td><td>" . $row["product_description"] . "</td></tr>
									<tr><td>Price:</td><td>$" . $row["price"] . "</td></tr>
								</table>
							</td>
							<td rowspan='3' valign='top'>
								<table border='1' style='border-style: solid; border-width: medium;'>
									<tr><td>USER</td></tr>
									<tr><td>" . $rowuname["username"] . "</td></tr>
								</table>
							</td>
						</tr>
						<tr>
							
						</tr>
					</table>";
		}
	}
?>