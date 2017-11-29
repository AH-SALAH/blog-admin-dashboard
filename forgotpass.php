<?php 	$pagetitle = 'Forgot Password';
		include 'includes/template/header.php';
	// ========================================
	// forgot pssword form check				

	if (isset($_POST['submit'])) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) :

			$username 	= $_POST['username'];
			$email 		= $_POST['email'];

				// name check 
				if(!isset($username) || empty($username)){
					$err[] = '<strong class=""> name mustn\'t be empty..!</strong>';
				}else{
					$check_name = check_input($username);
					if (!preg_match('/^[a-zA-Z0-9]*[a-zA-Z]+[ ]*[-]*[a-zA-Z0-9]*$/i', $check_name)){
						$err[] = '<strong class=""> name must only contains a-z | A-Z | 0-9 | - | space ..!</strong>';
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

				if (!isset($err)) {
					
					$q 		= $pdo->prepare("SELECT user_name,email FROM users WHERE user_name = ? AND email = ?");
					$stmt 	= array($check_name,$check_email);
					$q->execute($stmt);
					$row 	= $q->rowCount();

					if ($row == 1 ) {

						$success[] 	= '<strong class=""> correct details..!</strong>
										<br/>please,be patient .. we will send a reset link to your email so you can update your password...<br/>';

						$uniq 		= uniqid('/reset_/',true);
						$md5 		= md5($uniq); 
						$rand_salt 	= hash('sha512', $md5.$check_email); // random salt
				        $reset_url 	= "www.yoursitehere.com/resetpass.php?reset_q=".$rand_salt;
				        $expired 	= date('Y-m-d H:i:s',strtotime('+1 hour'));

						$que 		= $pdo->prepare("UPDATE users SET reset_token = ? , token_expired = ? WHERE user_name = ? AND email = ?");
						$stmt 		= array($rand_salt,$expired,$check_name,$check_email);
						$que->execute($stmt);

						// send the email
						$to 			= $check_email;
						$subject 		= "Your Recovered Password";
						$message 		= "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $reset_url . "\n\nThanks,\nThe Administration ";
						$headers 		= "From : ahmed@mail.com";
						
						if(mail($to, $subject, $message, $headers)){
							$success[] 	= "Your recovery key has been sent to your email id";
						}else{
							$error[] 	= "Failed to Recover your password, try again";
						}

					}elseif ($row == 0 ){
						$err[] 	= '<strong class=""> sorry,make sure of your details..!</strong>';
					}else{
						$err[] 	= '<strong class=""> some thing went wrong try again..!</strong>';
					}

				}

		endif;
	}
?>
<!-- ================================================ -->
<div class="container-fluid login-form-container">
	<div class="row">
		<form class="login-form list-group-item no-border-rad" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<h2 class="text-center list-group-item-heading">Forgot Password</h2>
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
								<?php echo '<li><span class="glyphicon glyphicon-ok" style="color:#3cb371";></span> '.$success.'</li>'; ?>
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
						<input class="form-control input-sm no-border-rad" type="text" name="username" value="<?php if(isset($username)) echo $username; ?>" placeholder="your name" auto-complete="on"/>
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
						<input class="form-control input-sm no-border-rad" type="email" name="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="email" auto-complete="off"/>
						<div class="pass-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					</div>
				</div>
				<button class="submit btn-sm btn btn-block form-group text-center" type="submit" name="submit" value=""><span class="glyphicon glyphicon-send"></span> Send</button>
				<!-- <button class="signup btn-sm btn btn-block form-group text-center" type="button" name="register" value="" onclick="window.location='register.php'">Create Account</button> -->
			</div> <!-- /.inputs -->
			<div class="bottom-nav">
				<small class="pull-left"><span class="glyphicon glyphicon-log-in"></span><a href="index.php" class="btn-link"> log in</a></small>
				<small class="pull-right"><span class="glyphicon glyphicon-home"></span><a href="../index.php" class="btn-link"> Return </a></small>
			</div>
		</form>
	</div> <!-- /.row -->
</div> <!-- /.container -->
<!-- ================================================ -->
<?php include 'includes/template/footer.php'; ?>
