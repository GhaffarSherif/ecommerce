<?php
	function createMenu($SESSION){
		if(isset($SESSION["user"])){
			echo "	<div class='dmenu-item pure-u-1 pure-u-lg-1-4'>
						<a href='index.php'>Home</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='products.php'>Shop</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='sell.php'>Sell</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'><a href='user.php'>Profile</a></div>";
					
			echo "	<div class='dmenu-item pure-u-1 pure-u-lg-1-8'><a href='logout.php'>Logout</a></div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='admin.php'>Cart</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='about.php'></a>
					</div>";
		}
		else{
			echo "	<div class='dmenu-item pure-u-1 pure-u-lg-1-4'>
						<a href='index.php'>Home</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='products.php'>Shop</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='sell.php'>Sell</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'><a href='register.php'>Register</a></div>";
					
			echo "	<div class='dmenu-item pure-u-1 pure-u-lg-1-8'><a href='login.php'>Login</a></div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='admin.php'>Cart</a>
					</div>
					<div class='dmenu-item pure-u-1 pure-u-lg-1-8'>
						<a href='about.php'></a>
					</div>";
		}
	}
?>