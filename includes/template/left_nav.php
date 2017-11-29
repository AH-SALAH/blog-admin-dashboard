<?php
	if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
		$id = $_SESSION['id'];
	}
?>

<style type="text/css">
	.left-nav{
		/*background-color:<?php if(isset($op['header_color'])) echo '#'.$op['header_color']; ?>!important;*/
	}
	.left-nav .left-nav-links:not(.active) {
		background-color:<?php if(isset($op['left_nav_btns_bg_color'])) echo '#'.$op['left_nav_btns_bg_color']; ?>;
		color:<?php if(isset($op['left_nav_btns_color'])) echo '#'.$op['left_nav_btns_color']; ?>;		
	}
</style>


<div id="left-nav" class="col-xs-2 col-sm-3 col-md-2 left-nav" style="background-color:<?php if(isset($op['header_color'])) echo '#'.$op['header_color']; ?>;">
	<div id="left-nav-list" class="list-group nav">
		<h4 class="panel-heading no-marg left-nav-header no-border-rad">
			<a class="left-dash-img" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=profile'; ?>" title="<?php if(isset($user['user_name'])){echo $user['user_name'];}else{echo 'admin';} ?>">
				<img class="dash-img" src="uploads/gallery/<?php if(isset($user['attach_name'])){ echo $user['attach_name']; }else{ echo 'admin.jpg'; } ?>">
			</a>
			<span class="glyphicon glyphicon-dashboard"></span>
			<span>Dashboard</span>
		</h4>
		<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=cpanel'; ?>" class="list-group-item left-nav-links <?php echo leftNav_activeClass(array('cpanel'),true); ?>" title="overview" >
			<span class="glyphicon glyphicon-th-large"></span>
			<span> Overview</span>
		</a>
		<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postslist'; ?>" class="list-group-item left-nav-links <?php echo leftNav_activeClass(array('postslist','postdetails','posttags')); ?>" title="postslist" >
			<span class="glyphicon glyphicon-list-alt"></span>
			<span> posts</span>
			<span id="posts-badge" class="label <?php echo total_posts() > 0 ? 'label-success' : 'label-danger'; ?> pull-right"><?php echo total_posts(); ?></span>
		</a>
		<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=createposts'; ?>" class="list-group-item left-nav-links <?php echo leftNav_activeClass(array('createposts')); ?>" title="createposts" >
			<span class="glyphicon glyphicon-plus-sign"></span>
			<span> Create posts</span>
		</a>
		<?php if ($_SESSION['group_id'] == 1): ?>
		<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=manageposts'; ?>" class="list-group-item left-nav-links <?php echo leftNav_activeClass(array('manageposts','editposts','deleteposts','postcomment')); ?>" title="manageposts" >
			<i class="fa fa-flask"></i>
			<span> Manage posts</span>
		</a>
		<?php endif; ?>
		<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=attachments'; ?>" class="list-group-item left-nav-links <?php echo leftNav_activeClass(array('attachments','attach_upload','attach_files','upload')); ?>" title="attachments" >
			<span class="glyphicon glyphicon-picture"></span>
			<span> Media</span>
			<span id="media-badge" class="label <?php echo user_attachments() > 0 ? 'label-success' : 'label-danger'; ?> pull-right">
				<span><?php echo user_attachments(); ?></span>
			</span>
		</a>
		<?php if ($_SESSION['group_id'] == 1): ?>
		<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=options'; ?>" class="list-group-item left-nav-links <?php echo leftNav_activeClass(array('options','profile','updateprofile','settings')); ?>" title="options" >
			<span class="glyphicon glyphicon-th-list"></span>
			<span> Options</span>
		</a>
		<a href="#settings-submenu1" id="left-nav-settings" class="list-group-item left-nav-links collapsed <?php echo leftNav_activeClass(array('manageusers','edituser','adduser','updateuser')); ?>" title="settings" data-toggle="collapse"  data-parent="#left-nav-list">
			<span class="glyphicon glyphicon-cog"></span>
			<span> Settings</span>
			<!-- <span class="glyphicon glyphicon-collapse-down"></span> -->
		</a>
		<div class="submenu <?php $array = array('manageusers','edituser','adduser'); if(!isset($_GET['page_id']) || !in_array($_GET['page_id'],$array)) echo 'collapse'; ?>" id="settings-submenu1" style="height: 0px;">
			<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=manageusers'; ?>" class="list-group-item left-nav-links no-border-rad <?php echo leftNav_activeClass(array('manageusers','edituser','adduser')); ?>">
				<span class="glyphicon glyphicon-plus"></span>
				<span> Manage Users</span>
			</a>
			<!-- <a href="#" class="list-group-item no-border-rad">
				<span class="glyphicon glyphicon-edit"></span>
				<span> Edit Profile</span>
			</a> -->
		</div>
		<?php endif; ?>
		<span class="list-group-item hidden"></span>
	</div>
</div>
