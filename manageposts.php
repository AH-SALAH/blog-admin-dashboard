<?php
	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
	}


	$pagetitle = 'Manage Posts';
// ================================
	$q = $pdo->prepare("SELECT post_id,post_num,post_title,post_tags,post_views,post_likes,post_dislikes,LEFT(post_content,60) AS content FROM posts ORDER BY post_num DESC ");
	$q->execute();
	$posts = $q->fetchAll();
// ==================================
	function delete_salt(){
		global $posts;
		$uniq 		= uniqid('/delete_this_post/',true);
		$md5 		= md5($uniq);
		$rand_salt 	= hash('sha512', $md5.$posts[0]['post_id']); // random salt

		return $rand_salt;
	}

?>

<div class="manage-posts-container table-responsive">
	<table id="manage-posts-table" class="data-table table table-striped table-bordered table-hover table-condensed bg-info" cellspacing="0">
	<?php if(isset($_GET['deleted_post'])) : ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span class="glyphicon glyphicon-ok-circle"></span><strong style="color:#3cb371;"><?php echo ' Post has been deleted successfully..';?></strong>
	</div>
	<?php endif; ?>
	<?php if(isset($_GET['updated_post'])) : ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span class="glyphicon glyphicon-ok-circle"></span><strong style="color:#3cb371;"><?php echo ' Post has been updated successfully..';?></strong>
	</div>
	<?php endif; ?>
		<thead>
			<tr class="" style="background:#808080;color:#fff;">
				<th class="">#</th>
				<th class="col-sm-4"><span class="glyphicon glyphicon-paperclip"></span> <?php echo total_posts('post','posts'); ?></th>
				<th class="col-sm-2"><span class="glyphicon glyphicon-tags"></span> Tags</th>
				<th class="col-sm-1"><span class="glyphicon glyphicon-thumbs-up"></span> Likes</th>
				<th class="col-sm-1"><span class="glyphicon glyphicon-thumbs-down"></span> Dislikes</th>
				<th class="col-sm-1"><span class="glyphicon glyphicon-eye-open"></span> Views</th>				
				<th class="col-sm-1"><span class="glyphicon glyphicon-comment"></span> <?php echo total_comments(); ?></th>
				<th class="col-sm-2"><span class="glyphicon glyphicon-cog"></span> Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($posts as $post){

			// ==================================
				$post_id = $post['post_id'];
			// ==================================
		?>
			<tr class="">
				<td>
					<?= $post['post_num']; ?>
				</td>
				<td>
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>" style="word-break: break-all;"><?= html_entity_decode($post['post_title']).'...' ?></a>
				</td>
				<td>
					<?php 
						if (isset($post['post_tags']) && !empty($post['post_tags'])) {
						
							$ex = explode(',', $post['post_tags']);
							foreach ($ex as $tag) {
					?>
						<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=posttags&amp;tag='.$tag; ?>" class="label label-info no-border-rad" style="margin-bottom:3px;display:inline-block;"><span class="glyphicon glyphicon-tag"></span> <?= html_entity_decode(trim($tag)).' '; ?></a>&nbsp;
					<?php 
							} 
						}
					?>
				</td>
				<td style="">
					<small class="badge no-border-rad center-block likes-badge" style="line-height:initial;" data-toggle="tooltip" data-trigger="hover" title="<?php if(isset($post['post_likes'])) echo $post['post_likes'] <= 1 ? $post['post_likes'].' Like' : $post['post_likes'].' Likes'; ?>"><?php echo post_likes($post['post_likes']); ?> <span class="glyphicon glyphicon-thumbs-up"></span></small>
				</td>
				<td style="">
					<small class="badge no-border-rad center-block dislikes-badge" style="line-height:initial;" data-toggle="tooltip" data-trigger="hover" title="<?php if(isset($post['post_dislikes'])) echo $post['post_dislikes'] <= 1 ? $post['post_dislikes'].' Dislike' : $post['post_dislikes'].' Dislikes'; ?>"><?php echo post_dislikes($post['post_dislikes']); ?> <span class="glyphicon glyphicon-thumbs-down"></span></small>
				</td>
				<td style="">
					<small class="badge no-border-rad center-block views-badge" style="line-height:initial;" data-toggle="tooltip" data-trigger="hover" title="<?php if(isset($post['post_views'])) echo $post['post_views'] <= 1 ? $post['post_views'].' View' : $post['post_views'].' Views'; ?>"><?php echo post_views($post['post_views']); ?> <span class="glyphicon glyphicon-eye-open"></span></small>
				</td>
				<td style="">
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postcomment&amp;post_id='.$post['post_id']; ?>" class="btn btn-warning center-block post-comment-btn" data-toggle="tooltip" title="<?php if (function_exists('post_comments_rows')) echo post_comments_rows($post_id,'comment','comments'); ?>" data-trigger="hover" onclick="" style="<?php if (function_exists('post_comments_rows')) echo post_comments_rows($post_id) > 0 ? 'color:#d43f3a' : 'cursor:not-allowed'; ?>"><span class="glyphicon glyphicon-comment"></span> <?php if (function_exists('post_comments_rows')) echo post_comments_rows($post_id); ?></a>
				</td>
				<td class="text-center" style="">
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=editposts&amp;post_id='.$post['post_id']; ?>" class="btn btn-info btn-sm post-edit-btn" data-toggle="tooltip" title="Edit" data-trigger="hover"><span class="glyphicon glyphicon-edit"></span></a>

					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=deleteposts&amp;post_id='.$post['post_id'].'&amp;nonce='.delete_salt(); ?>" class="btn btn-danger btn-sm post-delete-btn" data-toggle="tooltip" title="Delete" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

</div><!-- /.manage-posts-container -->