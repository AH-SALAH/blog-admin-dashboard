<?php
        if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
                header('location:index.php');
                exit;
        }
        //ob_start();

        $pagetitle = 'Add User';
        // ===================================== //
    	if (isset($_SESSION['id']) && is_numeric($_SESSION['id']) && $_SESSION['group_id'] == 1){
    		$id 	= $_SESSION['id'];

            // if (isset($_POST['submit'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST' ) :

                    $firstname 	= $_POST['firstname'];
                    $lastname 	= $_POST['lastname'];
                    $username 	= $_POST['username'];
                    $email 		= $_POST['email'];
                    $password 	= $_POST['password'];
                    $group_id 	= isset($_POST['group_id']) ? $_POST['group_id'] : 0;
                    $user_type 	= handle_group_id();
                    $reg_status = 1;


                    //first & last name check
                    if((!isset($firstname) || empty($firstname)) || (!isset($lastname) || empty($lastname)) ){
                        $err[] = '<strong class="" style="color:#f00;"> first name & last name mustn\'t be empty..!</strong>';
                    }elseif ((strlen($firstname) < 4 || strlen($lastname) < 4) || (strlen($firstname) > 20 || strlen($lastname) > 20)){
                        $err[] = '<strong class="" style="color:#f00;"> first name & last name mustn\'t be less than 4 charachters or more than 20 charachters..!</strong>';
                    }else{
                        $check_fname = check_input($firstname);
                        $check_lname = check_input($lastname);
                        $array 		 = array($check_fname,$check_lname);
                        foreach ($array as $name) {
                            if (!preg_match('/^[a-zA-Z]*+[ ]*[a-zA-Z]*$/i', $name)){
                                $err[] = '<strong class="" style="color:#f00;"> first name & last name must only contains a-z | A-Z and space ..!</strong>';
                            }
                        }
                    }

                    // user name check
                    if(!isset($username) || empty($username)){
                        $err[] = '<strong class="" style="color:#f00;"> user name mustn\'t be empty..!</strong>';
                    }elseif (strlen($username) < 4 || strlen($username) > 20){
                        $err[] = '<strong class="" style="color:#f00;"> user name mustn\'t be less than 4 charachters or more than 20 charachters..!</strong>';
                    }else{
                        $check_username = check_input($username);
                        if (!preg_match('/^[a-zA-Z0-9]*[a-zA-Z]+[ ]*[-]*[_]*[a-zA-Z0-9]*$/i', $check_username)){
                            $err[] = '<strong class="" style="color:#f00;"> name must only contains a-z | A-Z | 0-9 | _ | - | space ..!</strong>';
                        }elseif(in_array($check_username, array('admin','admine','administrator','adomin'))){
                            $err[] 	= '<strong class="" style="color:#f00;"> sorry,this user name not allowed..! try another ..</strong>';
                        }
                    }

                    // email check
                    if(!isset($email) || empty($email)){
                        $err[] = '<strong class="" style="color:#f00;"> email mustn\'t be empty..!</strong>';
                    }else{
                        $check_email 	= check_input($email);
                        $sanit_mail 	= filter_var($check_email, FILTER_SANITIZE_EMAIL);
                        $valid_mail 	= filter_var($sanit_mail, FILTER_VALIDATE_EMAIL);

                        // var_dump($check_email,$sanit_mail,explode('@', $check_email,2));
                        if (!preg_match('/^[a-zA-Z0-9_\\-.]*[@]+[a-z]*[.]+[a-z0-9]*$/i', $check_email)){
                            $err[] = '<strong class="" style="color:#f00;"> email syntax is not valid check again ..!</strong>';
                        }
                        if(stripos($check_email, '@') < 0) {
                            $err[] = '<strong class="" style="color:#f00;"> email is not valid check twice ..!</strong>';
                        }
                        if(!$valid_mail == true){
                            $err[] = '<strong class="" style="color:#f00;"> email is not valid check one more time ..!</strong>';
                        }

                        $ex 	= explode('@', $check_email,2);
                        $mail 	= $ex[0];
                        // $count 	= strlen($mail);
                    }

                    // password check
                    if (!isset($password) || empty($password)){
                        $err[] = '<strong class="" style="color:#f00;"> password mustn\'t be empty..!</strong><br/><strong>Note:</strong> white spaces,/\,<> are not accepted as password.';
                    }elseif (strlen($password) < 6 || strlen($password) > 15){
                        $err[] = '<strong class="" style="color:#f00;"> password mustn\'t be less than 6 charachters or more than 15 charachters..!</strong>';
                    }elseif (!preg_match('/^[a-zA-Z0-9*#_@]{6,15}$/i', $password)){
                        $err[] = '<strong class="" style="color:#f00;"> password must contains only digits or only alphanumeric or both and only *#_@ are accepted..!</strong>';
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
                                $que 		= $pdo->prepare("INSERT INTO users (user_num,first_name,last_name,user_name,email,password,group_id,user_type,reg_status,reset_token,token_expired,registered) SELECT MAX(user_num)+ 1,?,?,?,?,?,?,?,?,?,?,now() FROM users");
                                $stmt 		= array($check_fname,$check_lname,$check_username,$check_email,$hash,$group_id,$user_type,$reg_status,null,null);
                                $que->execute($stmt);

                                $success    = '<strong style="color:#35de79;"> Account created successfully..!</strong>';

                            }else{
                                $err[] 	= '<strong class="" style="color:#f00;"> sorry,this email already exist..! try another ..</strong>';
                            }

                        }else{
                            $err[] 	= '<strong class="" style="color:#f00;"> sorry,this user name already exist..! try another ..</strong>';
                        }


                    }

                endif;

            // }
            // ==============================================
            // handle delete account
            // if (isset($_POST['rm_un']) && isset($_POST['rm_email'])) {
            //     $rm_un      = $_POST['rm_un'];
            //     $rm_email   = $_POST['rm_email'];
            //
            //     $q      = $pdo->prepare("DELETE FROM users WHERE user_name = ? AND email = ?");
            //     $q->bindValue(1,$rm_un);
            //     $q->bindValue(2,$rm_email);
            //     $q->execute();
            //     $rows   = $q->rowCount();
            //
            //     if ($rows > 0) {
            //         $del_success  = '<span class="glyphicon glyphicon-ok"></span><strong style="color:#35de79;"> Account deleted successfully..</strong>';
            //     }else{
            //         $del_err 	  = '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><strong class="" style="color:#f00;"> this account already not exist..!</strong>';
            //     }
            //
            // }


?>


<form id="add-user-form" class="add-user-form col-md-12 well well-sm clearfix" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=adduser'; ?>" method="post" enctype="multipart/form-data">
	<div class="col-md-6 list-group-item no-border-rad clearfix form-left">
		<div class="table-responsive">
            <h4>Create Account</h4>
                <span class="alrt">
                    <?php
                        if (isset($err)) {
            				foreach ($err as $val) :
            					echo '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span> '.$val.'<br/>';
            				endforeach;
                        }
                        if (isset($success)) {
            				echo '<span class="glyphicon glyphicon-ok" style="color:#039d41;"></span> '.$success;
                        }
            		?>
                </span>
                <span class="del-alrt">
                    <?php
                        if (isset($del_success)) {
                            echo $del_success;
                        }
                        if (isset($del_err)) {
                            echo $del_err;
                        }
            		?>
                </span>
				<table class="table table-bordered table-condensed table-striped table-hover">
					<tbody>
						<tr>
							<td>
								<div class="input-group-addon">
									<span>first name</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="text" name="firstname" value="" placeholder="first name" auto-complete="off"/>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon">
									<span>last name</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="text" name="lastname" value="" placeholder="last name" auto-complete="off"/>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
									<span> user name</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="text" name="username" value="" placeholder="user name" auto-complete="off"/>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-envelope"></span>
									<span> email</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="email" name="email" value="" placeholder="email" auto-complete="off"/>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock"></span>
									<span>password</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="password" name="password" value="" placeholder="password" auto-complete="off"/>
							</td>
						</tr>
                        <tr>
							<td>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-barcode"></span>
									<span>Group</span>
								</div>
							</td>
							<td>
                                <select class="form-control group_id" name="group_id">
                                    <option value="">select</option>
                                    <option value="1">admin</option>
                                    <option value="2">publisher</option>
                                    <option value="0">user</option>
                                </select>
							</td>
						</tr>
					</tbody>
				</table>
			<!-- </div> /.row -->
		</div><!-- /.table-responsive -->
		<button class="btn btn-primary pull-right" type="submit" name="submit" value="create"><span class="h6">Add User</span></button>
	</div> <!-- /.well -->
</form>

<?php
		}else{
			echo 'there\'s no such id..!';
		}
    	// }else{
    	// 		echo 'there\'s no such thing..!';
    	// 	}

        // ====================
        //ob_end_flush();
?>
