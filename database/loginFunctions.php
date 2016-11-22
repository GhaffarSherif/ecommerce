<?php
	function loginUser($POST, $DBH){
		$user = $POST["username"];
		$pass = $POST["password"];
		
		$STH = $DBH->query("SELECT user_id, passwordhash FROM user WHERE username LIKE '" . $user . "'");
		$row = $STH->fetch();
		$hash = $row["passwordhash"];
		
		if(password_verify($pass, $hash)){
			$_SESSION["user"] = $row["user_id"];
			echo "Successfully logged in!";
		}
		else
			echo "Username or password incorrect!";
	}
?>