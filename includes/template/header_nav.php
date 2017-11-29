<?php 
	if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
		$id = $_SESSION['id'];

		$q 	= $pdo->prepare("SELECT attachments.`attach_name`,users.`user_name` FROM attachments LEFT JOIN users ON attachments.`attach_id` = users.`attach_id` WHERE users.`user_id` = ? ");
		$q->bindValue(1,$id);
		$q->execute();
		$user 	= $q->fetch(PDO::FETCH_ASSOC);
	}
?>
<!-- ============================================ -->
	<!-- <div class="container-fluid"> -->
		<!-- <div class="row"> -->
			<header>
				<nav id="header-nav" class="navbar navbar-default navbar-fixed-top" style="background-color:<?php if(isset($op['header_color'])) echo '#'.$op['header_color']; ?>">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="brand-side">
								<a class="navbar-brand" href="#">Blogger Dashboard</a>
							</div>
						</div>
						<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<div class="dash-user-pic">
									<span class="glyphicon glyphicon-user"></span>
									<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=profile'; ?>" title="<?php if(isset($user['user_name'])){echo $user['user_name'];}else{echo 'admin';} ?>">
										<img class="dash-img" src="uploads/gallery/<?php if(isset($user['attach_name'])){ echo $user['attach_name']; }else{ echo 'admin.jpg'; } ?>">
									</a>
								</div>
								<li class="dropdown">
						          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						          		<?php echo greet_user(); ?>
						          		<span class="caret"></span>
						          	</a>
						          	<ul class="dropdown-menu">
						            	<li>
											<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=profile'; ?>"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
										</li>
										<li>
											<a href="../index.php" class="visit-site" target="_blank"><span class="glyphicon glyphicon-globe"></span> Visit Site</a>
										</li>
						            	<li>
											<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
										</li>
						          	</ul>
						        </li>
						    </ul>
						    <div class="clock navbar-right">
							    <script type="text/javascript">
									var d = new Date();
									var n = d.toDateString() +' | '+ d.toLocaleTimeString();
									var a = d.getDay();
									var m = d.getMonth();
									var y = d.getUTCFullYear();
									document.getElementsByClassName('clock')[0].innerHTML += n;
								</script>
							</div>
							<form class="navbar-form navbar-right" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=search'; ?>" method="post">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon no-border-rad">
											<span class="glyphicon glyphicon-search"></span>
										</div>
										<input type="search" class="form-control" placeholder="Search...">
									</div>
								</div>
								<ul class="search-dropdown"></ul>
							</form>
						</div>
					</div>
			    </nav>
			</header><!-- /.container -->
