<?php 
	session_start();
	include('config/db_connect.php');
	$username = $password = '';
	$errors = array('username'=>'', 'password'=>'');

		if(isset($_POST['submit'])){

		// check title
		if(empty($_POST['username'])){
			$errors['username'] = 'A username is required <br />';
		} else{
			$username = $_POST['username'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
				$errors['username'] = 'Username must be letters and spaces only';
			}
		}

		// check password
		if(empty($_POST['password'])){
			$errors['password'] = 'Password cannot be empty <br />';
		} else{
			// $password = $_POST['password'];
			// if(!preg_match('/^([a-zA-Z\s]+$/', $password)){
			// 	$errors['password'] = 'Password invalid';
			// }
        }
        
        if(!array_filter($errors)){

			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			

			$sql = "SELECT * FROM user_data WHERE username = '$username' AND password = '$password'";
			$result = mysqli_query($conn,$sql);
			$count = mysqli_fetch_array($result);

			if($count == 1) {
				$_SESSION['username'] = $username;
				
				header("location: index.php");
			 }else {
				$error = "Your Login Name or Password is invalid";
			 }
			
			
        }
	} // end POST check
	

?>

<!DOCTYPE html>
<html>
	

	<section class="container grey-text">
		<h4 class="center">Student Login</h4>
		<form class="white" action="login.php" method="POST">
			<label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username)?>">
            <div class="red-text"><?php echo $errors['password']?></div>
			<label>Password</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password)?>">
            <div class="red-text"><?php echo $errors['password']?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand ">
			</div>
		</form>
	</section>

   
    

</html>