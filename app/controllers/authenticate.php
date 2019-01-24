<?php
	// echo (json_encode(TRUE));
	session_start();
	require_once './connect.php';

	function check_username($username){
		global $conn;
		$check_username = "SELECT COUNT(*) FROM users WHERE username='$username'";
		if ($query_result = $conn->query($check_username)) {
			// var_dump($query_result->fetchColumn());
			if($query_result->fetchColumn() > 0){
				// echo "match";
				$fetch_prep = $conn->prepare("SELECT * FROM users WHERE username='$username'");
				$fetch_prep->execute();
				$user_details = $fetch_prep->fetch(PDO::FETCH_ASSOC);
				return $user_details;
			} else {
				return FALSE;
			}
		}
	}

	function register_user($firstname, $lastname, $username, $password, $email, $address) {
		global $conn;
		$sql = "INSERT INTO users(firstname, lastname, username, password, email, address) VALUES (?,?,?,?,?,?)";
		$insert_prep = $conn->prepare($sql);

		if($insert_prep->execute([$firstname, $lastname, $username, $password, $email, $address])){
			echo (json_encode(TRUE));
		} else {
			echo (json_encode(FALSE));
		}
	}

	function update_user($email, $address, $password, $id){
		global $conn;
		$sql = "UPDATE users SET email = ?, address = ?, password = ? WHERE id = ?";
		$update_prep = $conn->prepare($sql);
		if($update_prep->execute([$email, $address, $password, $id])){
			echo (json_encode(TRUE));
		} else {
			echo (json_encode(FALSE));
		}
	}

	if(isset($_POST['procedure'])){
		if($_POST['procedure'] == 'login'){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$hashed_pass = sha1($password);
			if($details = check_username($username)){
				// echo (json_encode(TRUE));
				if($details['password'] == $hashed_pass){
					$_SESSION['user'] = $details;
					echo (json_encode(TRUE));
				} else {
					echo (json_encode(FALSE));
				}
			} else {
				echo (json_encode(FALSE));
			}
		} elseif($_POST['procedure'] == 'logout'){
			unset($_SESSION['user']);
		} else if($_POST['procedure'] == 'editProfile'){
			$_SESSION['user']['email'] = $_POST['email'];
			$_SESSION['user']['address'] = $_POST['address'];
			$_SESSION['user']['password'] = sha1($_POST['password']);

			$user_details = $_SESSION['user'];

			update_user($user_details['email'], $user_details['address'], $user_details['password'], $user_details['id']);
		}

		// if(check_username($username)){
		// 	echo (json_encode(TRUE));
		// } else {
		// 	echo (json_encode(FALSE));
		// }

	}
?>