<?php
	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
	}
	
	$pagetitle = 'Edit Posts';
	// include_once 'db.php';
// ===============================
if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
	$post_id 	= $_GET['post_id'];

	$q 			= $pdo->prepare("SELECT * FROM posts LEFT JOIN attachments ON posts.`attach_id` = attachments.`attach_id` WHERE posts.`post_id` = ? ");
	$q->bindValue(1,$post_id);
	$q->execute();
	$post 		= $q->fetch(PDO::FETCH_ASSOC);

	// foreach($posts as $post):
		$title 			= $post['post_title'];
		$content 		= $post['post_content'];
		$attach_name 	= $post['attach_name'];
		$attach_id 		= $post['attach_id'];
		$tags 			= $post['post_tags'];
?>


<form class="edit-post-form col-md-12 no-padd clearfix" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=updateposts&post_id='.$_GET['post_id']; ?>" method="post" enctype="multipart/form-data">
	<div class="col-md-8 well well-sm clearfix">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">
					<span>Title</span>
				</div>
				<input class="form-control" type="text" name="title" value="<?php if(isset($title)) echo html_entity_decode($title); ?>" placeholder="write post title" auto-complete="off"/>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="input-group" style="width:100%;">
				<textarea id="post-content-area" style="resize:none;" class="form-control" name="content" rows="13" cols="102" placeholder="Text.."><?php if(isset($content)) echo html_entity_decode($content); ?></textarea>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="input-group">
		        <!-- <a class="btn btn-info" href="javascript:;">
		            Choose File... -->
		            <input type="hidden" name="img-file" value="<?php if(isset($attach_id)) {  echo $attach_id; } ?>" accept="image/*" onchange=''/>
		        <!-- </a>
		        &nbsp;
		        <span class='label label-info' id="upload-file-info"></span> -->
			</div>
		</div> <!-- /.form-group -->
			<button class="btn btn-primary pull-right" type="submit" name="submit" value="update" placeholder=""><span class="h4">Update</span></button>
	</div> <!-- /.well -->

	<!-- preview area -->
	<div class="col-md-4 preview clearfix">
		<!-- alerts preview area -->
		<div class="alert alert-success alert-dismissable hidden">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<!-- <span class="glyphicon glyphicon-ok-circle"></span> --><strong style="color:#3cb371;"></strong>
		</div>
		<div class="alert alert-warning alert-dismissable hidden">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<!-- <span class="glyphicon glyphicon-warning-sign"></span> --><strong style="color:#f00;"></strong>
		</div>
		<!-- post content preview area -->
		<div class="post-preview list-group-item hidden">
			<!-- <img class="img-preview img-responsive center-block" src="uploads/gallery/<?php //if(isset($attach_name)) {  echo $attach_name; } ?>"> -->
			<span class="glyphicon glyphicon-eye-open text-center center-block bg-info text-primary well-sm"></span>
			<div class="title-holder btn-block panel-heading well well-sm no-border-rad">
				<strong class="title-preview btn-block"></strong>
				<?php $now = date('d/m/Y H:i:s A'); echo '<span class="glyphicon glyphicon-calendar"></span> '.$now; ?>
			</div>
			<p class="content-preview"></p>
		</div><!-- /.post-preview -->

		<!-- post tags area -->
		<div class="post-tags panel panel-default no-border-rad">
			<div class="panel-heading h4 no-marg no-border-rad">
				<span class="glyphicon glyphicon-tags"></span> Tags
			</div>
			<div class="tag-body panel-body">
				<input class="tag-input form-control no-border-rad" name="post-tags" type="text" value="<?php if(isset($tags)) echo html_entity_decode($tags); ?>" placeholder='separate by comma ","'/>
			</div>
		</div><!-- /.post-tags-->

		<!-- post choose-img preview area -->
		<div class="post-img-preview panel panel-default no-border-rad">
			<div class="panel-heading h4 no-marg no-border-rad"><span class="glyphicon glyphicon-picture"></span> Featured Image</div>
				<div class="img-viewer panel-body">
					<img class="img-preview thumbnail img-responsive center-block" src="uploads/gallery/<?php if(isset($attach_name)) {  echo $attach_name; } ?>" style="<?php if(!isset($attach_name)) {  echo 'display:none;'; } ?>">
				</div>
				<div class="panel-footer">
					<a href="#" class="post-img-link" data-toggle="modal" data-target="#post-media"><span class="glyphicon glyphicon-link text-primary"></span><strong> choose featured image</strong></a>
					<a href="#" class="post-img-remove-link pull-right"><span class="glyphicon glyphicon-trash text-danger"></span><strong> remove</strong></a>
				</div>
		</div><!-- /.post-img-preview -->

	</div><!-- /.preview -->
	<div class="col-md-8 page-header no-padd"></div>
</form>

<?php
	}else{
		header('location:index.php');
		exit;
	}

 ?>
