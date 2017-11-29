<?php 	
		if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
		}

	$pagetitle = 'Create Posts';
// ==================================
//file upload handling

// if (isset($_POST['submit'])) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
				$s_id 			= $_SESSION['id'];

				$title_fil 		= filter_var($_POST['title'] , FILTER_SANITIZE_STRING);
				$title 			= check_input($title_fil);
				$content_fil 	= /*filter_var(*/$_POST['content']/* , FILTER_SANITIZE_STRING)*/;
				$content 		= check_input($content_fil);


			if (!empty($title) || !empty($content)) :

				if (isset($_POST['img-file']) && !empty($_POST['img-file'])){
					$img = $_POST['img-file'];
				}else{
					$img = null;
				}

				if (isset($_POST['post-tags']) && !empty($_POST['post-tags'])){
					$tag_fil 	= filter_var($_POST['post-tags'] , FILTER_SANITIZE_STRING);
					$tags		= check_input(strtolower($tag_fil));
				}else{
					$tags = null;
				}

					$q 		= $pdo->prepare("INSERT INTO `posts`( `post_num`, `post_author`, `post_title`, `post_content`, `attach_id`,`post_tags`, `post_created_at` ) SELECT MAX(post_num)+ 1,:un,:ttl ,:cont ,:attach,:tags,now() FROM `posts`;");
					$stmt 	= array(
								'un' 	=> $s_id,
								'ttl' 	=> $title,
								'cont' 	=> $content,
								'attach'=> $img,
								'tags'	=> $tags,
								);
					$exec 	= $q->execute($stmt);


					if (isset($exec)) {
						$sts = '<div class="alert"><div class="center-block text-center update-message"><span class="glyphicon glyphicon-ok"></span><span style="color:green;"> post created successfully..</span></div></div>';
						echo $sts;
					}else{
						$err = '<div class="alert"><div class="center-block text-center update-message"><span class="glyphicon glyphicon-warning-sign"></span><span style="color:red;"> some thing went wrong..!</span></div></div>';
						echo $err;
					}

					$q 	 = null;

			else :
				echo '<span style="color:red;">form can\'t be empty..!</span>';
			endif;
		}
	}

// }

?>
<form class="create-post-form col-md-12 no-padd clearfix" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id='.$_GET['page_id']; ?>" method="post" enctype="multipart/form-data">
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
		            <!-- MAX_FILE_SIZE must precede the file input field -->
    				<!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> -->
		            <input type="hidden" name="img-file" value="<?php //if(isset($file_name)) echo $file_name; ?>" accept="image/*" onchange=''/>
		        <!-- </a>
		        &nbsp;
		        <span class='label label-info' id="upload-file-info"></span> -->
			</div>
		</div> <!-- /.form-group -->
			<button class="btn btn-primary pull-right" type="submit" name="submit" value="post" placeholder=""><span class="h4">Publish</span></button>
	</div> <!-- /.well -->

	<!-- preview area -->
	<div class="col-md-4 preview clearfix">
		<!-- alerts preview area -->
		<div class="alert alert-success alert-dismissable hidden">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span class="glyphicon glyphicon-ok-circle"></span><strong style="color:#3cb371;"></strong>
		</div>
		<div class="alert alert-warning alert-dismissable hidden">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span class="glyphicon glyphicon-warning-sign"></span><strong style="color:#f00;"></strong>
		</div>

		<!-- post content preview area -->
		<div class="post-preview list-group-item hidden">
			<!-- <img class="img-preview img-responsive center-block" src="uploads/gallery/<?php //if(isset($file_name)) echo $file_name; ?>"> -->
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
					<img class="img-preview thumbnail img-responsive center-block" src="uploads/gallery/<?php if(isset($user['attach_name'])) {  echo $user['attach_name']; } ?>" style="<?php if(!isset($user['attach_name'])) {  echo 'display:none;'; } ?>">
				</div>
				<div class="panel-footer">
					<a href="#" class="post-img-link" data-toggle="modal" data-target="#post-media"><span class="glyphicon glyphicon-link text-primary"></span><strong> choose featured image</strong></a>
					<a href="#" class="post-img-remove-link pull-right"><span class="glyphicon glyphicon-trash text-danger"></span><strong> remove</strong></a>
				</div>
		</div><!-- /.post-img-preview -->

	</div><!-- /.preview -->
	<div class="col-md-8 page-header no-padd"></div>
</form>
