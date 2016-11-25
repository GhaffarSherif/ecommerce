<?php
	function loginUser($POST, $DBH){
		$user = $POST["username"];
		$pass = $POST["password"];
		
		//Get user_id, and password hash for a given username
		$STH = $DBH->query("SELECT user_id, passwordhash, status FROM user WHERE username LIKE '" . $user . "'");
		$row = $STH->fetch();
		$hash = $row["passwordhash"];
		
		//Verifies the given password
		if(password_verify($pass, $hash)){
			//Checks the user's status to confirm that they have access to the site
			if(userCanLogIn($row["status"])){
				$_SESSION["user"] = $row["user_id"];
				echo '<script language="javascript">';
				echo 'alert("You have been successfully logged in!");';
				echo '</script>';
				echo "<script>window.location.assign('index.php');</script>";
			}
			else{
				echo '<script language="javascript">';
				echo 'alert("You have been banned or have had your account locked!");';
				echo '</script>';
			}
			
		}
		else{
			echo '<script language="javascript">';
			echo 'alert("Username or password is incorrect!");';
			echo '</script>';
		}
	}
	
	function userCanLogIn($status){
		return $status == 12 || $status == 13;
	}
	
	
	function isAlreadyLoggedIn(){
		return isset($_SESSION["user"]);
	}
?>