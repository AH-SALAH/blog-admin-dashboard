<?php
        if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
                header('location:index.php');
                exit;
        }

	$pagetitle = 'Profile';
// ===================================== //
	if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
		$id 	= $_SESSION['id'];

		$q 		= $pdo->prepare("SELECT * FROM users LEFT JOIN attachments ON attachments.`attach_id` = users.`attach_id` WHERE users.`user_id` = ? ");
		$q ->bindValue(1,$id);
		$q->execute();
		$row 	= $q->rowCount();
		$user 	= $q->fetch(PDO::FETCH_ASSOC);

		if ($row > 0) {

?>


<form id="profile-form" class="profile-form col-md-9 well well-sm clearfix" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=updateprofile'; ?>" method="post" enctype="multipart/form-data">
	<div class="col-md-7 list-group-item no-border-rad clearfix form-left">
		<div class="table-responsive">
			<!-- <div class="row"> -->
				<table class="table table-bordered table-condensed table-striped table-hover">
					<tbody>
						<tr>
							<td>
								<div class="input-group-addon">
									<span>first name</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="text" name="firstname" value="<?php if(isset($user['first_name'])) echo $user['first_name']; ?>" placeholder="first name" auto-complete="off"/>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon">
									<span>last name</span>
								</div>
							</td>
							<td>
								<input class="form-control" type="text" name="lastname" value="<?php if(isset($user['last_name'])) echo $user['last_name']; ?>" placeholder="last name" auto-complete="off"/>
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
								<input class="form-control" type="text" name="username" value="<?php if(isset($user['user_name'])) echo $user['user_name']; ?>" placeholder="user name" auto-complete="off"/>
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
								<input class="form-control" type="email" name="email" value="<?php if(isset($user['email'])) echo $user['email']; ?>" placeholder="email" auto-complete="off"/>
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
								<div class="input-group-addon upload-addon">
									<span class="glyphicon glyphicon-picture"></span> profile picture
								</div>
							</td>
					        <td>
					        	<a class="btn btn-info form-control upload-link" href="javascript:;">
					            Choose File...
					            	<!-- MAX_FILE_SIZE must precede the file input field -->
			    					<!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> -->
			    					<input type="hidden" class="btn btn-primary form-control" name="profile-file" value="<?php if(isset($user['attach_id'])) echo $user['attach_id']; ?>" accept="image/*" onchange=''/>

					            	<input type="button" class="btn btn-primary form-control" name="file" value="<?php if(isset($user['attach_name'])) echo 'uploads/gallery/'.$user['attach_name']; ?>" accept="image/*" onchange='' data-toggle="modal" data-target="#media"/>
					        	</a>
					        	&nbsp;
					        	<span class='label label-info' id="upload-file-info"></span>
					        </td>
					    </tr>
					</tbody>
				</table>
			<!-- </div> /.row -->
		</div><!-- /.table-responsive -->
		<button class="btn btn-primary pull-right" type="submit" name="submit" value="update" placeholder=""><span class="h4">Update</span></button>
	</div> <!-- /.well -->

	<!-- preview area -->
	<!-- <div class="col-md-2"></div> -->
	<div class="col-md-5 preview clearfix no-padd">
		<!-- alerts preview area -->
        <div class="alert-prev">
            <?php if (isset($success)) : ?>
    		<div class="alert alert-success alert-dismissable">
    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<span class="glyphicon glyphicon-ok" style="color:green;"></span><strong><?php echo $success; ?></strong>
    		</div>
            <?php endif; ?>
            <?php if (isset($err)) : ?>
    		<div class="alert alert-warning alert-dismissable">
    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><strong><?php foreach ($err as $val) { echo $val; } ?></strong>
    		</div>
            <?php endif; ?>
        </div>
		<!-- profile content preview area -->
		<div class="profile-preview list-group-item no-border-rad">
			<div class="img-viewer">
				<img class="img-preview" src="uploads/gallery/<?php if(isset($user['attach_name'])) { echo $user['attach_name']; }else{ echo 'admin.jpg'; } ?>">
			</div>
			<div class="title-holder btn-block panel-heading well well-sm no-border-rad">
				<h4><strong class="username-preview btn-block"><?php if (isset($user['user_name'])) echo $user['user_name']; ?></strong></h4>
			</div>
			<p class="content-preview"></p>
		</div><!-- /.post-preview -->
	</div><!-- /.preview -->
</form>

<?php
		}else{
			echo 'there\'s no such id..!';
		}
	}else{
			echo 'there\'s no such thing..!';
		}
?>
