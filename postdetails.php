<?php
	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
	}else{
		$id = $_SESSION['id'];
	}

	$pagetitle = 'Post Details';
?>
<div class="post-details">
	<div class="row">
	<?php
		if (isset($_GET['post_id'])) {
			$post_id 	= $_GET['post_id'];

			$q 			= $pdo->prepare("SELECT *,DATE_FORMAT(post_created_at,'%d-%m-%Y %r') AS post_created_at  FROM posts WHERE post_id = ? ");
			$q->bindValue(1,$post_id);
			$q->execute();
			$row 		= $q->rowCount();

			if ($row > 0) {
				$posts 		= $q->fetchAll(PDO::FETCH_ASSOC);

				foreach($posts as $post):

					$date 	= date('Y-m-d');
					$ip 	= $_SERVER['REMOTE_ADDR'];
					
					// post views check
					if (isset($post['post_views_date']) && !empty($post['post_views_date']) && $post['post_views_date'] == $date)  {

						if (!preg_match('/'.$ip.'/i', $post['post_views_ip'])) {
							
							$newip = $ip.' '.$post['post_views_ip'];

							$que = $pdo->prepare("UPDATE posts SET post_views_ip = ?,post_views = post_views +1 WHERE post_id = ? ");
							$arg = array($newip,$post_id);
							$que->execute($arg);
						}

					}else{
						$newip = $ip.' '.$post['post_views_ip'];

						$quee 	= $pdo->prepare("UPDATE posts SET post_views_date = ?,post_views_ip = ?,post_views = post_views +1 WHERE post_id = ? ");
						$args 	= array($date,$newip,$post_id);
						$quee->execute($args);
					}

					// post likes action handeling
					// ===========================
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						if (isset($_POST['lk']) || isset($_POST['dslk'])) {

							$lkq = $pdo->prepare("SELECT post_likes_id,post_likes,post_dislikes FROM posts WHERE post_id = ? ");
							$lkq->bindValue(1,$post_id);
							$lkq->execute();
							$row = $lkq->rowCount();
							$lkf = $lkq->fetchAll(PDO::FETCH_ASSOC);

							if ($row > 0) {
								foreach ($lkf as $lkid) {
									if (isset($lkid['post_likes_id'])) {
										$lk_ids = $lkid['post_likes_id'];
										if (!preg_match('/'.$id.'/i', $lk_ids)) {

											if (isset($_POST['lk'])) {
												$newlk_id 	= $id.'_lk,'.$lk_ids;
												echo $newlk_id;

												$lkqu 		= $pdo->prepare("UPDATE posts SET post_likes_id = ?,post_likes = post_likes +1 WHERE post_id = ? ");
												$args 		= array($newlk_id,$post_id);
												$liked 		= $lkqu->execute($args);

												if ($liked) {
													$lks 	= $pdo->prepare("SELECT post_likes FROM posts WHERE post_id = ? ");
													$lks->bindValue(1,$post_id);
													$lks->execute();
													$lkcol 	= $lks->fetchColumn();

													$data[] = $lkcol;
												}

											}elseif (isset($_POST['dslk'])) {
												$newlk_id 	= $id.'_dslk,'.$lk_ids;

												$dslkqu 	= $pdo->prepare("UPDATE posts SET post_likes_id = ?,post_dislikes = post_dislikes +1 WHERE post_id = ? ");
												$args 		= array($newlk_id,$post_id);
												$disliked 	= $dslkqu->execute($args);

												if ($disliked) {
													$dslks 		= $pdo->prepare("SELECT post_dislikes FROM posts WHERE post_id = ? ");
													$dslks->bindValue(1,$post_id);
													$dslks->execute();
													$dslkcol 	= $dslks->fetchColumn();

													$data[] = $dslkcol;
												}
												
											}
										}else{
											$data[] = 'you already voted';
										}
									}
								}
							}
						}
					}
	?>
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="thumbnail">
				<div class="caption">
					<p><?=  html_entity_decode($post['post_created_at']); ?> | <?php if(isset($post['post_views'])) echo $post['post_views']; ?> <span class="glyphicon glyphicon-eye-open"></span> | 
						
						<a id="lk" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=postdetails&post_id='.$post['post_id']; ?>" class="likes"><span class="glyphicon glyphicon-thumbs-up"></span> <span class="likes-counter"><?php if(isset($post['post_likes'])){ echo $post['post_likes'];} ?></span></a> 
						
						<a id="dslk" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=postdetails&post_id='.$post['post_id']; ?>" class="dislikes"><span class="glyphicon glyphicon-thumbs-down"></span> <span class="dislikes-counter"><?php if(isset($post['post_dislikes'])) echo $post['post_dislikes']; ?></span></a>

						<input type="hidden" name="post_id" value="<?= $post_id; ?>">
						
						<?php 
							if (isset($data)) {
								foreach ($data as $value) {
									echo '<input type="hidden" name="returned_data" value="'.$value.'">';
								}
							}
						?>
					</p>
					<h3><?= html_entity_decode($post['post_title']); ?></h3>
					<p><?=  html_entity_decode($post['post_content']); ?></p>
				</div>
			</div>
		</div>
	<?php 
				endforeach; 
			}
		}
	?>
	</div><!-- /.row -->
</div><!-- /.post-details -->
