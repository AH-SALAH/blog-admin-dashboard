<?php 	/*error_reporting(E_ALL);
		ini_set('display_errors', true);*/
		session_start();
		if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
				header('location:dashboard.php');
				exit;
		}
		// $nofooternav;
		$pagetitle = 'Log In';
		include 'includes/template/header.php';
	// ========================================
	// log in form check

	if (isset($_POST['submit'])) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) :

			$username 	= $_POST['username'];
			$password 	= $_POST['password'];

				// name check
				if(!isset($username) || empty($username)){
					$err[] = '<strong class=""> name mustn\'t be empty..!</strong>';
				}elseif (strlen($username) < 4 || strlen($username) > 20){
					$err[] = '<strong class=""> user name mustn\'t be less than 4 charachters or more than 20 charachters..!</strong>';
				}else{
					$check_name = check_input($username);
					if (!preg_match('/^[a-zA-Z0-9]*[a-zA-Z]+[ ]*[-]*[a-zA-Z0-9]*$/i', $check_name)){
						$err[] = '<strong class=""> name must only contains a-z | A-Z | 0-9 | - | space ..!</strong>';
					}
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

					$q 		= $pdo->prepare("SELECT user_id,user_name,password,group_id FROM users WHERE user_name = ? AND password = ?");
					$stmt 	= array($check_name,$hash);
					$q->execute($stmt);
					$row 	= $q->rowCount();
					$user 	= $q->fetch(PDO::FETCH_ASSOC);

					if ($row == 1 ) {
						$stored_hash 	= $user['password'];
						// Verify stored hash against plain-text password
						if (password_verify($check_pass, $stored_hash)) { //password_verify(password, hash)

							session_start();
							$id 				= $user['user_id'];
							$group_id 			= $user['group_id'];

							$_SESSION['name'] 		= $check_name;
							$_SESSION['id'] 		= $id;
							$_SESSION['group_id'] 	= $group_id;

							$success 	= '<strong class=""> Logged In successfully..!</strong>
											<br>you\'ll be redirected..<br> if not click <a href="dashboard.php">Here</a>';
							// echo '<meta http-equiv="refresh" content="5;url=dashboard.php?un='.$username.'" />';
							header('location:dashboard.php');
							// exit;

						    // Check if a newer hashing algorithm is available or the cost has changed
						    if (password_needs_rehash($stored_hash, PASSWORD_DEFAULT)) {
						        // If so, create a new hash, and replace the old one
						        $newHash = password_hash($hash, PASSWORD_DEFAULT);
						    }
						}else{
							$err[] 	= '<strong class=""> sorry,login details not match..!</strong>';
						}

					}else{
						$err[] 	= '<strong class=""> sorry,make sure of your login details..!</strong>';
					}

				}

		endif;
	}
?>
<!-- ================================================ -->
<div class="container-fluid login-form-container">
	<div class="row">
		<form class="login-form list-group-item no-border-rad" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<h2 class="text-center list-group-item-heading">Log In</h2>
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
						<?php foreach ($err as $val) :
							echo '<li><span class="glyphicon glyphicon-warning-sign"></span> '.$val.'</li>';
							endforeach;
						?>
						</ul>
					</div>
				<?php endif; ?>
				<?php if(isset($success)): ?>
					<div class="alert alert-success alert-dismissible no-border-rad" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<ul class="no-padd">
							<?php echo '<li><span class="glyphicon glyphicon-ok" style="color:#3cb371;"></span> '.$success.'</li>'; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>

			<div class="inputs well no-border-rad">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-user"></span>
						</div>
						<input class="form-control no-border-rad" type="text" name="username" value="<?php if(isset($username)) echo $username; ?>" placeholder="your name" auto-complete="on"/>
						<div class="user-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<!-- <svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg> -->
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-lock"></span>
						</div>
						<input class="form-control no-border-rad" type="password" name="password" value="" placeholder="password" auto-complete="off"/>
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-eye-close"></span>
						</div>
						<div class="pass-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<!-- <svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg> -->
						</div>
					</div>
				</div>
				<button class="submit btn-sm btn btn-block form-group text-center" type="submit" name="submit" value=""><span class="glyphicon glyphicon-log-in"></span> Log In</button>
				<button class="signup btn-sm btn btn-block form-group text-center" type="button" name="register" value="" onclick="window.location='register.php'">Create Account</button>
			</div> <!-- /.inputs -->
			<div class="bottom-nav">
				<small class="pull-left"><span class="glyphicon glyphicon-link"></span><a href="forgotpass.php" class="btn-link"> Forgot Your Password?</a></small>
				<small class="pull-right"><span class="glyphicon glyphicon-home"></span><a href="../index.php" class="btn-link"> Return </a></small>
			</div>
		</form>
	</div> <!-- /.row -->
</div> <!-- /.container -->
<!-- ================================================ -->
<?php include 'includes/template/footer.php'; ?>
