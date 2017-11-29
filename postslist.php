<?php
	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
	}

	$pagetitle = 'Posts List';
?>

<div class="row">
	<?php
		if (function_exists('show_posts')){
			$posts = show_posts('post_id,post_title, LEFT(post_content,60) as content');
		}
		foreach($posts as $post){ ?>

		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div class="caption">
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>"><h3><?= html_entity_decode($post['post_title']); ?></h3></a>
					<p><?= html_entity_decode($post['content']); ?><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>"> ...</a></p>
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>" class="btn btn-primary" role="button">Read more</a>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
