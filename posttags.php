<?php  
	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
				header('location:index.php');
				exit;
	}else{
		$sid = $_SESSION['id'];
	}

		$pagetitle = 'Post Tags';
		//========================//

		if (isset($_GET['page_id']) && $_GET['page_id'] == 'posttags' && isset($_GET['tag']) && is_string($_GET['tag'])) {

			$tag = $_GET['tag'];

			$q 		= $pdo->prepare("SELECT *,LEFT(post_content,50) AS content FROM posts WHERE post_tags REGEXP ? ");
			$q->bindValue(1,$tag);
			$q->execute();
			$row 	= $q->rowCount();

			if ($row > 0) {
				$posts = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
	<?php  
		foreach ($posts as $post) :
	?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div class="caption">
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>"><h3><?= html_entity_decode($post['post_title']); ?></h3></a>
					<p><?= html_entity_decode($post['content']); ?><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>"> ...</a></p>
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=postdetails&amp;post_id='.$post['post_id']; ?>" class="btn btn-primary" role="button">Read more</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php
			}else{
				echo '<div class="alert alert-danger center-block"> sorry,no such tag found..</div>';				
			}

		}else{
			header('location:cpanel.php');
			echo '<div class="alert alert-danger center-block"><span class="glyphicon glyphicon-warning-sign"></span> something went wrong..</div>';
		}
?>