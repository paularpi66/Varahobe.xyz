<?php
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Database connection
	$con = new mysqli('localhost:3307','root','','varahobe');
	if($con->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $con->prepare("select * from signup where email = ?");
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		if($stmt_result->num_rows > 0)
		{
			$data = $stmt_result->fetch_assoc();
			if($data['password'] === $password)
			{
				echo "<h2> Login Successful </h2>";
			}
		}
		else{
			echo "<h2>Invalid Email or password</h2>";
		}
		
	}
?>