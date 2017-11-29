<?php
		if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
            header('location:index.php');
            exit;
        }else{
        	$id = $_SESSION['id'];
        }

		$pagetitle = 'Cpanel';
		// =========================
?>

<!-- =============================================== -->
<!-- total sts cards -->
<div class="sts-cards clearfix">
	<div class="row">
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12 col-md-12 well well-sm totals-container">
				<div class="col-xs-12 col-sm-6 col-md-3 total-users">
					<div class="col-xs-12 col-sm-12 col-md-12 well-sm text-center">
						<div class="col-xs-12 col-sm-6 col-md-6 no-padd card-title">
							<h5 class=""><span class="center-block">Total</span> Users</h5>
							<i class="fa fa-users"></i>
						</div>
						<a  class="col-xs-12 col-sm-6 col-md-6 no-padd center-block svg-container" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=manageusers'; ?>">
							<svg version="1.1" class="crcls" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewbox="-5 -5 60 60" xml:space="preserve">
								<defs>
									<clipPath id="rounded1">
										<use xlink:href="#rect4"/>
									</clipPath>
									<!-- <filter id="grayscale">
											  <feColorMatrix type="saturate" values="0"/>
									</filter> -->
								</defs>

								<g class="group">
									<!-- <path class="path1" fill="#01a09e" stroke-width="3" stroke="#9f0342" d="M0 0 100 0"/> -->
									<rect class="rect rect1" x="0" y="0" width="50" height="50" r="0" rx="0%" ry="0%" fill="transparent" stroke="#6495ed" stroke-width="1" style=""></rect>
									<rect class="rect rect2" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#262626" stroke-width="3" style=""></rect>
									<rect class="rect rect3" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#ffd700" stroke-width="3" style=""></rect>
									<rect id="rect4" class="rect rect4" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#9F0342" stroke-width="5" style=""></rect>
									<foreignObject x="-5" y="-5" width="60" height="60" requiredExtensions="http://www.w3.org/1999/xhtml">
										<!-- <img src="img/128.jpg" xmlns="http://www.w3.org/1999/xhtml"> -->
										<span class="counter center-block"><?php echo total_counter("user_id","users","WHERE group_id != 1"); //return users rows count ?></span>
										<i class="fa fa-users"></i>
									</foreignObject>
									<!-- <image class="svg-img" x="0" y="0" width="50" height="50" style="border-radius:0%;" xlink:href="uploads/gallery/admin.jpg" transform="" clip-path="url(#rounded1)" overflow="visible" xmlns="http://www.w3.org/1999/xhtml"/> -->
							  <!-- <circle cx="407" cy="162" r="122" fill="none" stroke="#002200" style="opacity: 1;" stroke-width="3" opacity="1"></circle> -->
							  <!-- <text x="0" y="0" width="50" height="50" >4</text> -->
								</g>
							</svg>
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 total-posts ">
					<div class="col-xs-12 col-sm-12 col-md-12 well-sm text-center">
						<div class="col-xs-12 col-sm-6 col-md-6 no-padd card-title">
							<h5 class=""><span class="center-block">Total</span> Posts</h5>
							<i class="fa fa-pencil-square-o"></i>
						</div>
						<a class="col-xs-12 col-sm-6 col-md-6 no-padd center-block svg-container" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=manageposts'; ?>">
							<svg version="1.1" class="crcls" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewbox="-5 -5 60 60" xml:space="preserve">
								<defs>
									<clipPath id="rounded2">
										<use xlink:href="#rect44"/>
									</clipPath>
								</defs>

								<g class="group">
									<rect class="rect rect1" x="0" y="0" width="50" height="50" r="0" rx="0%" ry="0%" fill="transparent" stroke="#6495ed" stroke-width="1" style=""></rect>
									<rect class="rect rect2" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#262626" stroke-width="3" style=""></rect>
									<rect class="rect rect3" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#ffd700" stroke-width="3" style=""></rect>
									<rect id="rect44" class="rect rect4" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#9F0342" stroke-width="5" style=""></rect>
									<foreignObject x="-5" y="-5" width="60" height="60" requiredExtensions="http://www.w3.org/1999/xhtml">
										<span class="counter center-block"><?php echo total_counter("post_id","posts"); //return users rows count ?></span>
										<i class="fa fa-pencil-square-o"></i>
									</foreignObject>
								</g>
							</svg>
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 total-attachments">
					<div class="col-xs-12 col-sm-12 col-md-12 well-sm text-center">
						<div class="col-xs-12 col-sm-6 col-md-6 no-padd card-title">
							<h5 class=""><span class="center-block">Total</span> Media</h5>
							<i class="fa fa-picture-o"></i>
						</div>
						<a class="col-xs-12 col-sm-6 col-md-6 no-padd center-block svg-container" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=attachments'; ?>">
							<svg version="1.1" class="crcls" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewbox="-5 -5 60 60" xml:space="preserve">
								<defs>
									<clipPath id="rounded3">
										<use xlink:href="#rect444"/>
									</clipPath>
								</defs>

								<g class="group">
									<rect class="rect rect1" x="0" y="0" width="50" height="50" r="0" rx="0%" ry="0%" fill="transparent" stroke="#6495ed" stroke-width="1" style=""></rect>
									<rect class="rect rect2" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#262626" stroke-width="3" style=""></rect>
									<rect class="rect rect3" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#ffd700" stroke-width="3" style=""></rect>
									<rect id="rect444" class="rect rect4" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#9F0342" stroke-width="5" style=""></rect>
									<foreignObject x="-5" y="-5" width="60" height="60" requiredExtensions="http://www.w3.org/1999/xhtml">
										<span class="counter center-block"><?php echo total_counter("attach_id","attachments"); //return users rows count ?></span>
										<i class="fa fa-picture-o"></i>
									</foreignObject>
								</g>
							</svg>
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 total-comments">
					<div class="col-xs-12 col-sm-12 col-md-12 well-sm text-center">
						<div class="col-xs-12 col-sm-6 col-md-6 no-padd card-title">
							<h5 class=""><span class="center-block">Total</span> Comments</h5>
							<i class="fa fa-comments"></i>
						</div>
						<a class="col-xs-12 col-sm-6 col-md-6 no-padd center-block svg-container" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=manageposts'; ?>">
							<svg version="1.1" class="crcls" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewbox="-5 -5 60 60" xml:space="preserve">
								<defs>
									<clipPath id="rounded4">
										<use xlink:href="#rect4444"/>
									</clipPath>
								</defs>

								<g class="group">
									<rect class="rect rect1" x="0" y="0" width="50" height="50" r="0" rx="0%" ry="0%" fill="transparent" stroke="#6495ed" stroke-width="1" style=""></rect>
									<rect class="rect rect2" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#262626" stroke-width="3" style=""></rect>
									<rect class="rect rect3" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#ffd700" stroke-width="3" style=""></rect>
									<rect id="rect4444" class="rect rect4" x="0" y="0" width="50" height="50" r="0" rx="50%" ry="50%" fill="transparent" stroke="#9F0342" stroke-width="5" style=""></rect>
									<foreignObject x="-5" y="-5" width="60" height="60" requiredExtensions="http://www.w3.org/1999/xhtml">
										<span class="counter center-block"><?php echo total_counter("comment_id","comments"); //return users rows count ?></span>
										<i class="fa fa-comments"></i>
									</foreignObject>
								</g>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- =============================================== -->
<!-- latest sts panels -->
<div class="latest-sts-panels clearfix">
	<div class="row">
	 	<?php
		 	if (function_exists('show_posts')){
				$posts = show_posts('post_id,post_title, LEFT(post_content,100) as content','posts','ORDER BY post_id DESC LIMIT 1');
			}

			foreach($posts as $post){
		?>
		<div class="content-wrapper latest-posts col-xs-12 col-sm-6 col-md-4">
			<div class="panel panel-default no-border-rad">
				<div class="panel-heading h4 no-marg no-border-rad">
					<div class="pull-left">
						<i class="fa fa-pencil"></i>
						<span>Latest Posts</span>
					</div>
					<span class="glyphicon glyphicon-plus pull-right" data-target=".panel-body"></span>
				</div>
				<div class="panel-body">
					<div class="thumbnail no-marg">
						<div class="caption">
							<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>">
								<h4><?= html_entity_decode($post['post_title']); ?></h4>
							</a>
							<p><?= html_entity_decode($post['content']); ?><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>"> ...</a></p>
							<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>" class="btn btn-primary" role="button">Read more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php } ?>
	<!-- ==================================== -->
		<?php
		 	$q  = $pdo->prepare("SELECT attach_name FROM attachments LEFT JOIN users ON attachments.`user_id` = users.`user_id` WHERE users.`user_id` = ? ORDER BY attachments.`attach_id` DESC LIMIT 4 ");
			$q->bindValue(1,$id);
			$q->execute();
			$pics = $q->fetchAll(PDO::FETCH_ASSOC);


			if (isset($pics) && !empty($pics)) :
		?>
		<div class="content-wrapper latest-media col-xs-12 col-sm-6 col-md-4">
			<div class="panel panel-default no-border-rad">
				<div class="panel-heading h4 no-marg no-border-rad">
					<div class="pull-left">
						<i class="fa fa-picture-o"></i>
						<span>Latest Media</span>
					</div>
					<span class="glyphicon glyphicon-plus pull-right" data-target=".panel-body"></span>
				</div>
				<div class="panel-body">
					<div class="thumbnail no-marg col-xs-12 col-sm-12 col-md-12">
						<?php foreach($pics as $pic){ ?>
						<div class="no-marg col-xs-3 col-sm-6 col-md-3 no-padd">
							<img src="uploads/gallery/<?php if(isset($pic['attach_name'])){ echo $pic['attach_name']; } ?>" width="100%" height="75" title="<?php if(isset($pic['attach_name'])){ echo $pic['attach_name']; } ?>">
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<!-- ==================================== -->
		<?php
		 	$que  = $pdo->prepare("SELECT attachments.`attach_name`,users.`user_name`,comments.`comment_author`,comments.`com_status`,comments.`comment_id`,LEFT(comment,50) AS comment_body,DATE_FORMAT(comment_date,'%d/%m/%Y %h:%i %p') AS comment_date,posts.`post_title`,comments.`post_id` FROM attachments JOIN users ON users.`attach_id` = attachments.`attach_id` AND users.`user_id` = attachments.`user_id` JOIN comments ON comments.`comment_author` = users.`user_id` JOIN posts ON posts.`post_id` = comments.`post_id` ORDER BY comments.`comment_date` DESC LIMIT 4 ");
			// $q->bindValue(1,$id);
			$que->execute();
			$comments = $que->fetchAll(PDO::FETCH_ASSOC);


			if (isset($comments) && !empty($comments)) :
		?>
		<div class="content-wrapper latest-comments col-xs-12 col-sm-6 col-md-4">
			<div class="panel panel-default no-border-rad">
				<div class="panel-heading h4 no-marg no-border-rad">
					<div class="pull-left">
						<i class="fa fa-comments-o"></i>
						<span>Latest Comments</span>
					</div>
					<span class="glyphicon glyphicon-plus pull-right" data-target=".panel-body"></span>
				</div>
				<div class="panel-body no-padd">
					<div class="list-group-item no-marg no-border-rad no-padd col-xs-12 col-sm-12 col-md-12">
						<?php foreach($comments as $comment){ ?>
						<div class="no-marg media">
							<div class="comment-header no-border-rad">
								<div class="pull-left">
									<span class="glyphicon glyphicon-edit"></span>								
									<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=postdetails&amp;post_id='.$comment['post_id']; ?>" class=""> <?= $comment['post_title']; ?></a>
								</div>
								<?php if (isset($comment['com_status']) && $comment['com_status'] != 1) { ?>
								<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=postcomment&amp;post_id='.$comment['post_id'].'#comment'.$comment['comment_id']; ?>" class="btn btn-danger btn-xs latest-com-approval-btn pull-right">Need Approval</a>
								<?php } ?>
							</div>
							<div class="media-container well-sm">
								<div class="media-left media-middle">
									<img class="img-circle media-object" src="uploads/gallery/<?= $comment['attach_name']; ?>" alt="<?= $comment['user_name']; ?>" title="<?= $comment['user_name']; ?>">
								</div>
								<div class="media-body">
									<?php 
										$profile = (isset($_SESSION['group_id']) && $_SESSION['group_id'] != 1) ? 
													'?page_id=profile&amp;user_id='.$_SESSION['id'] : 
													'?page_id=profile&amp;user_id='.$comment['comment_author']; 
									?>
									<div class="media-heading"><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).$profile; ?>"><?= $comment['user_name']; ?></a><span><?= ' | '.$comment['comment_date']; ?></span>
									</div>
									<!-- <span class="glyphicon glyphicon-comment text-info"></span>&nbsp; -->
									<div class="comment-body"><?= $comment['comment_body'].'...'; ?></div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<!-- ================== -->
	<?php if (empty($posts) && empty($pics) && empty($comments)) echo '<strong class="text-center center-block">WELCOME,'.ucwords($_SESSION['name'],'he').' TO THE DASHBOARD..</strong><br><span class="text-center center-block">No content yet..!</span>';?>
	<!-- ================== -->

	</div> <!-- /.row -->
</div> <!-- /.latest-sts-panels -->
