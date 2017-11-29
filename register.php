<?php  	session_start();
		if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
			header('location:dashboard.php');
			exit;
		}

		$pagetitle = 'Register';
		include 'includes/template/header.php';
	// ========================================
	// reg form check

	if (isset($_POST['submit'])) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) :

			$firstname 	= $_POST['firstname'];
			$lastname 	= $_POST['lastname'];
			$username 	= $_POST['username'];
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];

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
					// $count 	= strlen($mail);
				}

				// password check
				if (!isset($password) || empty($password)){
					$err[] = '<strong class=""> password mustn\'t be empty..!</strong><br/><strong>Note:</strong> white spaces,/\,<> are not accepted as password.';
				}elseif (strlen($password) < 6 || strlen($password) > 15){
					$err[] = '<strong class=""> password mustn\'t be less than 6 charachters or more than 15 charachters..!</strong>';
				}elseif (!preg_match('/^[a-zA-Z0-9*#_@]{6,15}$/i', $password)){
					$err[] = '<strong class=""> password must contains only digits or only alphanumeric or both and only *#_@ are accepted..!</strong>';
				}else{
					$check_pass = check_input($password);
					$hash 		= password_hashing($check_pass);
				}

				if (!isset($err)) {

					$q 		= $pdo->prepare("SELECT user_name FROM users WHERE user_name = ? ");
					$q->bindValue(1,$check_username,PDO::PARAM_STR);
					$q->execute();
					$row 	= $q->rowCount();

					// var_dump($row,$check_username,$mail,$count);
					if ($row == 0) { //if user not found ? new user = register success : error = user already exist..

						$q 		= $pdo->prepare("SELECT SUBSTRING_INDEX(email,'@',1) AS mail FROM users WHERE email LIKE '?%' ");
						$q->bindValue(1,$mail,PDO::PARAM_STR);
						$q->execute();
						$row 	= $q->rowCount();

						if ($row == 0) {
							// $place_holders 	= implode(',', array_fill(0, count($stmt), '?'));
							$que 		= $pdo->prepare("INSERT INTO users (first_name,last_name,user_name,email,password,reset_token,token_expired,registered) VALUES (?,?,?,?,?,?,?,now())");
							$stmt 		= array($check_fname,$check_lname,$check_username,$check_email,$hash,null,null);
							$que->execute($stmt);

							$success 	= '<strong class=""> registered successfully..!</strong>
											<br>you\'ll be redirected..<br> if not click <a href="index.php">Here</a>
											<script>setTimeout(function(){window.location="index.php";},3000);</script>';
							// echo '<script>window.location="dashboard.php?un='.$username.'"</script>';
							// echo '<meta http-equiv="refresh" content="5;url=dashboard.php?un='.$username.'" />';
							// header('refresh:5;url=dashboard.php');
							// exit;
							// break;
								// $alt_q 		= $pdo->prepare("ALTER TABLE users DROP user_id");
								// $alter 		= $alt_q->execute();

								// $re_q 		= $pdo->prepare("ALTER TABLE users ADD user_id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (user_id)");
								// $return 	= $re_q->execute();
						}else{
							$err[] 	= '<strong class=""> sorry,this email already exist..! try another ..</strong>';
						}

					}else{
						$err[] 	= '<strong class=""> sorry,this user name already exist..! try another ..</strong>';
					}


				}

		endif;

	}
?>
<!-- ================================================ -->
<div class="container-fluid register-form-container">
	<div class="row">
		<div class="home-icon"><a href="../index.php"><span class="glyphicon glyphicon-home"></span></a></div>
		<form class="register-form list-group-item no-border-rad" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<h2 class="text-center list-group-item-heading">Create Account</h2>
				<div class="err text-center no-border-rad">
					<?php if(isset($err)): ?>
						<script>
							var form 	= document.getElementsByTagName("form")[0];
							var err 	= form.querySelector(".err").style.display = "block";
							// var warn 	= form.querySelector(".has-warning").style.display = "block";
						</script>
						<div class="alert alert-warning alert-dismissible no-border-rad" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<ul class="no-padd">
							<?php foreach ($err as $value) :
								echo '<li><span class="glyphicon glyphicon-warning-sign"></span> '.$value.'</li>';
								endforeach;
							?>

							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($success)): ?>
						<script>
							var form 	= document.getElementsByTagName("form")[0];
							var err 	= form.querySelector(".err").style.display = "block";
							// var warn 	= form.querySelector(".has-warning").style.display = "block";

						</script>
						<div class="alert alert-success alert-dismissible no-border-rad" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<ul class="no-padd">
								<?php echo '<li><span class="glyphicon glyphicon-ok" style="color:#3cb371";></span> '.$success.'</li>'; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>

			<div class="inputs well no-border-rad">
				<div class="form-group">
					<!-- <div class="input-group"> -->
						<!-- <div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-user"></span>
						</div> -->
						<input class="form-control no-border-rad" type="text" name="firstname" value="<?php if(isset($firstname)) echo $firstname; ?>" placeholder="first name" auto-complete="on"/>
						<div class="fname-warning has-warning has-feedback hidden">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					<!-- </div> -->
				</div>
				<div class="form-group">
					<!-- <div class="input-group"> -->
						<!-- <div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-user"></span>
						</div> -->
						<input class="form-control no-border-rad" type="text" name="lastname" value="<?php if(isset($lastname)) echo $lastname; ?>" placeholder="last name" auto-complete="on"/>
						<div class="lname-warning has-warning has-feedback hidden">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					<!-- </div> -->
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-user"></span>
						</div>
						<input class="form-control no-border-rad" type="text" name="username" value="<?php if(isset($username)) echo $username; ?>" placeholder="user name" auto-complete="on"/>
						<div class="user-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-envelope"></span>
						</div>
						<input class="form-control no-border-rad" type="email" name="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="email" auto-complete="on"/>
						<div class="email-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-lock"></span>
						</div>
						<input class="form-control no-border-rad" type="password" name="password" value="" placeholder="password" auto-complete="off"/>
						<div class="pass-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					</div>
				</div>
				<button class="signup btn-sm btn btn-block text-center" type="submit" name="submit" value=""><span class="glyphicon glyphicon-log-in"></span> Register</button>
			</div> <!-- /.inputs -->
			<div class="bottom-nav">
				<small class="pull-left">Already has account <span class="glyphicon glyphicon-link"></span><a href="index.php" class="btn-link"> Log In</a></small>
				<!-- <small class="pull-right"><span class="glyphicon glyphicon-home"></span><a href="#" class="btn-link"> Return </a></small> -->
			</div>
		</form>
	</div> <!-- /.row -->
</div> <!-- /.container -->
<!-- ================================================ -->
<?php include 'includes/template/footer.php'; ?>
