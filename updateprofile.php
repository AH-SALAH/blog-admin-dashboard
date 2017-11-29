<?php  //ob_start();

		$pagetitle = 'Update Profile';

// ======================================//

	// if (isset($_POST['submit'])) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) :

			$firstname 	= $_POST['firstname'];
			$lastname 	= $_POST['lastname'];
			$username 	= $_POST['username'];
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];
			$file 		= empty($_POST['profile-file']) ? null : $_POST['profile-file'];

				//first & last name check
				if((!isset($firstname) || empty($firstname)) || (!isset($lastname) || empty($lastname)) ){
					$err[] = '<strong class=""> first name & last name mustn\'t be empty..!</strong>';
				}elseif ((strlen($firstname) < 4 || strlen($lastname) < 4) || (strlen($firstname) > 20 || strlen($lastname) > 20)){
					$err[] = '<strong class=""> first name & last name mustn\'t be less than 4 charachters or more than 20 charachters..!</strong>';
				}else{
					$check_fname = check_input($firstname);
					$check_lname = check_input($lastname);
					$array 		 = array($check_fname,$check_lname);
					foreach ($array as $name) {
						if (!preg_match('/^[a-zA-Z]*+[ ]*[a-zA-Z]*$/i', $name)){
							$err[] = '<strong class=""> first name & last name must only contains a-z | A-Z and space ..!</strong>';
						}
					}
				}

				// user name check
				if(!isset($username) || empty($username)){
					$err[] = '<strong class=""> user name mustn\'t be empty..!</strong>';
				}elseif (strlen($username) < 4 || strlen($username) > 20){
					$err[] = '<strong class=""> user name mustn\'t be less than 4 charachters or more than 20 charachters..!</strong>';
				}else{
					$check_username = check_input($username);
					if (!preg_match('/^[a-zA-Z0-9]*[a-zA-Z]+[ ]*[-]*[_]*[a-zA-Z0-9]*$/i', $check_username)){
						$err[] = '<strong class=""> name must only contains a-z | A-Z | 0-9 | _ | - | space ..!</strong>';
					}elseif(in_array($check_username, array('admin','admine','administrator','adomin'))){
						$err[] 	= '<strong class=""> sorry,this user name not allowed..! try another ..</strong>';
					}
				}

				// email check
				if(!isset($email) || empty($email)){
					$err[] = '<strong class=""> email mustn\'t be empty..!</strong>';
				}else{
					$check_email 	= check_input($email);
					$sanit_mail 	= filter_var($check_email, FILTER_SANITIZE_EMAIL);
					$valid_mail 	= filter_var($sanit_mail, FILTER_VALIDATE_EMAIL);

					// var_dump($check_email,$sanit_mail,explode('@', $check_email,2));
					if (!preg_match('/^[a-zA-Z0-9_\\-.]*[@]+[a-z]*[.]+[a-z0-9]*$/i', $check_email)){
						$err[] = '<strong class=""> email syntax is not valid check again ..!</strong>';
					}
					if(stripos($check_email, '@') < 0) {
						$err[] = '<strong class=""> email is not valid check twice ..!</strong>';
					}
					if(!$valid_mail == true){
						$err[] = '<strong class=""> email is not valid check one more time ..!</strong>';
					}

					$ex 	= explode('@', $check_email,2);
					$mail 	= $ex[0];
					$count 	= strlen($mail);
				}

				// password check
				if (isset($password) && !empty($password)){

					if (strlen($password) < 6 || strlen($password) > 15){
						$err[] = '<strong class=""> password mustn\'t be less than 6 charachters or more than 15 charachters..!</strong>';
					}elseif (!preg_match('/^[a-zA-Z0-9*#_@]{6,15}$/i', $password)){
						$err[] = '<strong class=""> password must contains only digits or only alphanumeric or both and only *#_@ are accepted..!</strong>';
					}else{
						$check_pass = check_input($password);
						$hash 		= password_hashing($check_pass);
					}
				}
			// =====================================================//

					if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
						$id 	= $_SESSION['id'];

						$q 		= $pdo->prepare("SELECT user_name FROM users WHERE user_id != ? ");
						$q->bindValue(1,$id);
						$q->execute();
						$row 	= $q->rowCount();
						$col 	= $q->fetchAll(PDO::FETCH_ASSOC);

						if ($row >= 1) {
							foreach ($col as $key => $value) {
								foreach ($value as $user) {
									if ($check_username == $user){

										$err[] 	= '<strong class="" style="color:red;"> sorry,this user name already exist..!</strong>';
										// return false;
									}
								}
							}
						}

						$q 		= $pdo->prepare("SELECT SUBSTRING_INDEX(email,'@',1) AS mail FROM users WHERE email LIKE '?%' ");
						$q->bindValue(1,$mail);
						$q->execute();
						$row 	= $q->rowCount();
						$col 	= $q->fetchAll(PDO::FETCH_ASSOC);

						if ($row >= 1) {
							foreach ($col as $key => $value) {
								foreach ($value as $email) {
									if ($mail == $email){
										$err[] 	= '<br><strong class="" style="color:red;"> this email already exist..!</strong>';
										// return false;
									}
								}
							}
						}

						if (!isset($err)) {

							$q		= $pdo->prepare("UPDATE users SET first_name = ?,last_name = ?,user_name = ?,email = ?,attach_id = ? WHERE user_id = ?");
							$stmt 	= array($check_fname,$check_lname,$check_username,$check_email,$file,$id);
							$q->execute($stmt);

							if (isset($password) && !empty($password)){

									$q 		= $pdo->prepare("UPDATE users SET password = ? WHERE user_id = ?");
									$q->bindValue(1,$hash);
									$q->bindValue(2,$id);
									$q->execute();
							}


							$success 	= '<span class="glyphicon glyphicon-ok" style="color:green;"></span><strong class="" style="color:green;"> profile updated successfully..!</strong>';
						}

					}

				if (isset($success)) {

					echo '<div class="alert-prev alert alert-success text-center">'.$success.'</div>';
					// echo 	'<script>
					// 			setTimeout(function(){window.location="dashboard.php?page_id=profile";},3000);
					// 		</script>';
				}

				if (isset($err)) {
					foreach ($err as $val) :
						echo '<div class="alert-prev alert alert-danger text-center"><span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span>'.$val.'</div>';
					endforeach;
				}

				$q 	 = null;
		endif;

	// }

	//ob_end_flush();

?>
