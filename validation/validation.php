<?php 
	function registerVal($username, $password, $cpassword, $firstname, $lastname, $email, $address, $phone){
		//check if username is not taken from dba_close
		
		//Checking if the fields were filled!
		if (empty($password) || empty($cpassword) || empty($firstname) || empty($lastname) || empty($email) || empty($address) || empty($phone)){
			echo '<script language="javascript">';
			echo 'alert("Please fill ALL fields!");';
			echo '</script>';
			return FALSE;
		}
		
		//checking if passwords match
		if ( ($password !== $cpassword)){
			echo '<script language="javascript">';
			echo 'alert("Passwords do not match!");';
			echo '</script>';
			return FALSE;
		}
		
		// Checking if email format is valid!
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo '<script language="javascript">';
			echo 'alert("Email address format not valid!");';
			echo '</script>';
			return FALSE;
		}
		
		// Everything is alright!
		RETURN TRUE;
	}
	
	// This function validates input values in the sell.php page
	function sellVal($productName, $description, $category, $price, $condition){
		// Check if the field is empty
		if (empty($productName) || empty($description) || empty($price)){
			echo '<script language="javascript">';
			echo 'alert("Not all fields have been filled!")';
			echo '</script>';
			return FALSE;
		}
		
		// checking that price is a number! (thats not negative too)
		if (!is_numeric($price) || $price < 0){
			echo '<script language="javascript">';
			echo 'alert("Price is not numeric OR smaller than 0!!")';
			echo '</script>';
			return FALSE;
		}
		return TRUE;
	}
	
	//Validation for the user page
	function userDisplayVal($GET, $SESSION){
		// TO-DO: CHECK IF user exists, CHECK BALANCE, 
		// Checking If link it proper!
		 if (!isset($SESSION['user'])){ //checking if user is logged in
			 echo '<script language="javascript">';
			 echo 'alert("Please Login First!")';
			 echo '</script>';
			 header("Location:./login.php");
			 exit();
		 }
		 //If nothing is in url
		 else if (!isset($GET['userp'])){
			header("Location: ./user.php?userp=".$SESSION['user']);
			exit();
		}
	}
	
	// Validating The Modification fields in the user profile
	function  userModifyVal($POST){
		// Checking if Fields are empty
		if (empty($POST['fname']) && empty($POST['lname']) && empty($POST['email']) && empty($POST['address']) && empty($POST['wbalance'])){
			 echo '<script language="javascript">';
			 echo 'alert("No fields are filled for modification!")';
			 echo '</script>';
			return FALSE;
		}
	}
	
	// In the begginging of the admin page, doing some verification
	function adminStartVal($SESSION){
		// Checking if user is admin or not!
		if (!isAdmin($SESSION)){
			echo '<script language="javascript">';
			echo 'alert("NOT admin!");';
			echo '</script>';
			
			header("Location: ./index.php");
			exit();	
		}
	}
	
?>