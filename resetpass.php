<?php 	$pagetitle = 'Reset Password';
		include 'includes/template/header.php';
	// ========================================
	// reset password form check

// ===========================================
// check for the url token existence first

	if (isset($_GET['reset_q'])) {
		$url = $_GET['reset_q'];
		$check_url = trim($url);

		// check for the correct hashed length
		if (strlen($check_url) != 128){
			$err[] = '<strong class=""> you can\'t browes this page directly ..!</strong>';
			die('<strong class="" style="color:red;text-align:center;position:absolute;top:40%;left:0;right:0;"><span class="glyphicon glyphicon-warning-sign"></span> seems you lost your navigation ..!</strong>');
		}else{
			// check for the token existence in the db
			$qw 	= $pdo->prepare("SELECT reset_token FROM users WHERE reset_token = ? ");
			$qw->bindValue(1,$check_url);
			$qw->execute();
			$row 	= $qw->rowCount();

			if ($row == 0 ) { // if not error -> die
				$err[] = '<strong class=""><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly..! <br/> or <br/> this page seems to be expired..!</strong>';
				die('<strong class="" style="color:red;text-align:center;position:absolute;top:40%;left:0;right:0;"><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly ..!<br/> or <br/> this page seems to be expired..!</strong>');
			}
		}

	}else{
		$err[] = '<strong class=""> you can\'t browes this page directly ..!</strong>';
		die('<strong class="" style="color:red;text-align:center;position:absolute;top:40%;left:0;right:0;"><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly ..!</strong>');
	}

// =================================================

	if (isset($_POST['submit'])) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) :

			$url 		= $_GET['reset_q'];
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];

				// email check
				if(!isset($email) || empty($email)){
					$err[] = '<strong class=""> email mustn\'t be empty..!</strong>';
				}else{
					$check_email 	= check_input($email);
					$sanit_mail 	= filter_var($check_email, FILTER_SANITIZE_EMAIL);
					$valid_mail 	= filter_var($sanit_mail, FILTER_VALIDATE_EMAIL);

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
				if (!isset($password) || empty($password)){
					$err[] = '<strong class=""> password mustn\'t be empty..!</strong><br/><strong>Note:</strong> white spaces,/\,<> are not accepted as password.';
				}elseif (strlen($password) < 6 || strlen($password) > 15){
					$err[] = '<strong class=""> password mustn\'t be less than 6 charachters or more than 15 charachters..!</strong>';
				}elseif (!preg_match('/^[a-zA-Z0-9*#_@]{6,15}$/i', $password)){
					$err[] = '<strong class=""> password must contains only digits or only alphanumeric or both and only *#_@ are accepted..!</strong>';
				}else{
					$check_pass = check_input($password);
					$hash 		= password_hashing($check_pass);
					// echo $hash.'<br>'.$sha;
				}

				if (!isset($err)) { //if there r no err
					//check for the rows existence
					$q 		= $pdo->prepare("SELECT email,reset_token,token_expired FROM users WHERE email = ? AND reset_token = ?");
					$stmt 	= array($check_email,$check_url);
					$q->execute($stmt);
					$row 	= $q->rowCount();

					if ($row == 1 ) { //if row exist
						// fetch for the expired col
						$token_expired = $q->fetchColumn(2);

						if ($token_expired < date('Y-m-d H:i:s',strtotime('+1 hour'))) { //if expired

							// delete the token
							$quee 	= $pdo->prepare("UPDATE users SET reset_token = NULL,token_expired = NULL WHERE email = ? ");
							$quee->bindValue(1,$check_email);
							$quee->execute();

							//show the error
							$err[] = '<strong class=""><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly..! <br/> or <br/> this page seems to be expired..! <br/> or <br/> you may be late for your request..!</strong>';
							die('<strong class="" style="color:red;text-align:center;position:absolute;top:40%;left:0;right:0;"><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly ..!<br/> or <br/> this page seems to be expired..!<br/> or <br/> you may be late for your request..!</strong>');

							// redirect
							echo 	'<script>
										setTimeout(function(){window.location="index.php";},2000);
									</script>';
							
						}else{

							// update the password
							$que 		= $pdo->prepare("UPDATE users SET password = ? WHERE email = ? AND reset_token = ?");
							$stmt 		= array($hash,$check_email,$check_url);
							$que->execute($stmt);

							// delete the token
							$quee 		= $pdo->prepare("UPDATE users SET reset_token = NULL,token_expired = NULL WHERE email = ? ");
							$quee->bindValue(1,$check_email);
							$quee->execute();

							$success[] 	= '<strong class=""> successfull password reset..!</strong>
											<br/>password has been updated successfully for this account you can login with your new password...<br/>';
							
							// send a confirmation email
							$login_url 		= "www.yoursitehere.com/index.php";
							$to 			= $check_email;
							$subject 		= "Your password updated successfully..!";
							$message 		= "Dear user,\n\nIf this e-mail appears that it has sent wrongly to you, please go ahead and report a compromised email to us. \n\nIt appears that you have requested a password reset\n\nTo reset your password, and your password reset operation done successfully. you can login with your new password from here ".$login_url." If you cannot click it, please paste it into your web browser's address bar.\n\nThanks,\nThe Administration ";
							$headers 		= "From : ahmed@mail.com";
							
							if(mail($to, $subject, $message, $headers)){
								$success[] 	= "Your recovery key has been sent to your email id";
							}else{
								$error[] 	= "Failed to Recover your password, try again";
							}

							echo 	'<script>
										setTimeout(function(){window.location="index.php";},2000);
									</script>';
						}

					}elseif ($row == 0 ){
						$err[] 	= '<strong class=""><span class="glyphicon glyphicon-warning-sign"></span> sorry,this page has expired..!</strong>';
						die('<strong class="" style="color:red;text-align:center;position:absolute;top:40%;left:0;right:0;"><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly ..!<br/>sorry,this page has expired..!</strong>');
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
		<form class="login-form list-group-item no-border-rad" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?reset_q='.$url; ?>" method="post">
			<h2 class="text-center list-group-item-heading">Reset Password</h2>
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
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon no-border-rad">
							<span class="glyphicon glyphicon-lock"></span>
						</div>
						<input class="form-control input-sm no-border-rad" type="password" name="password" value="" placeholder="password" auto-complete="off"/>
						<div class="pass-warning has-warning has-feedback">
							<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
							<svg class="checkmark form-control-feedback" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
								<circle class="checkmark__circle" cx="24" cy="24" r="16" fill="none"/>
									<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
							</svg>
						</div>
					</div>
				</div>
				<button class="submit btn-sm btn btn-block form-group text-center" type="submit" name="submit" value=""><span class="glyphicon glyphicon-refresh"></span> reset</button>
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
