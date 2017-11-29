<?php
        if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
            header('location:index.php');
            exit;
        }

	$pagetitle = 'Comments';
// ================================
	if (isset($_GET['post_id'])){
		$post_id = $_GET['post_id'];

		$q = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY comment_num DESC ");
		$q->bindValue(1,$post_id);
		$q->execute();
		$comments = $q->fetchAll();

	}else{
        header('location:dashboard.php?page_id=manageposts');
        exit;
    }

// ==================================


?>

<div class="comment-container table-responsive">
	<table id="comment-table" class="data-table table table-striped table-bordered table-hover table-condensed bg-info" cellspacing="0">
		<thead>
			<tr class="bg-warning">
				<th class="col-xs-1">#</th>
				<th class="col-xs-2"><span class="glyphicon glyphicon-user"></span> Author</th>
				<th class=""><span class="glyphicon glyphicon-comment"></span> <?php if (function_exists('post_comments_rows')) echo post_comments_rows($post_id); ?></th>
				<th class="col-xs-2"><span class="glyphicon glyphicon-calendar"></span> Date</th>
				<th class="col-xs-2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($comments as $comment){
				$author_id = $comment['comment_author'];

				$que = $pdo->prepare("SELECT user_name FROM users WHERE user_id = ? ");
				$que->bindValue(1,$author_id);
				$que->execute();
				$author_name = $que->fetchColumn();

			?>
			<tr class="">
				<td>
					<p id="comment<?= $comment['comment_id']; ?>" class="text-center comment-num"><span><?= $comment['comment_num']; ?></span></p>
					<input id="comment<?= $comment['comment_id']; ?>" type="hidden" name="comment-id" value="<?= $comment['comment_id']; ?>" data-post-id="<?= $_GET['post_id']; ?>" >
				</td>
				<td>
					<p class="text-center comment-author"><?= $author_name; ?></p>
				</td>
				<td>
					<p class="comment-body" style="word-break: break-all;"><span><?= $comment['comment']; ?></span></p>
					<div class="comment-textarea hidden">
						<textarea class="form-control textarea col-xs-12 col-sm-12 col-md-12" style="width:100%;"></textarea>
						<div class="form-group pull-right h6" style="margin-right:20px;">
							<div class="input-group ">
								<button class="btn btn-primary btn-sm" type="button" name="cancel-edit">cancel</button>
								<input class="btn btn-primary btn-sm" type="submit" name="post-edit" value="Save"/>
							</div>
						</div>
					</div>
				</td>
				<td class="text-center">
					<small class="comment-date"><?php
							$date = date('d/m/Y | H:i:s A',strtotime($comment['comment_date']));
							echo $date;
						?>
					</small>
				</td>
				<td class="text-center comment-action">
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postcomment&amp;post_id='.$comment['post_id']; ?>" class="btn btn-info btn-sm comment-edit-btn" data-toggle="tooltip" title="Edit" data-trigger="hover"><span class="glyphicon glyphicon-edit"></span></a>
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postcomment&amp;post_id='.$comment['post_id']; ?>" class="btn btn-danger btn-sm comment-delete-btn" data-toggle="tooltip" title="Delete" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-trash"></span></a>
					<?php if (isset($comment['com_status']) && $comment['com_status'] == 1) : ?>
						<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postcomment&amp;post_id='.$comment['post_id']; ?>" class="btn btn-success btn-sm comment-approve-btn" data-toggle="tooltip" title="approved" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-ok"></span></a>
					<?php else: ?>
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postcomment&amp;post_id='.$comment['post_id']; ?>" class="btn btn-danger btn-sm comment-approve-btn" data-toggle="tooltip" title="Need Approval click to approve" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-exclamation-sign"></span></a>
					<?php endif; ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div><!-- /.manage-posts-container -->
