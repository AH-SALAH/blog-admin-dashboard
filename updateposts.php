<?php 

	$pagetitle = 'Update Posts';
// ===================================
// if (isset($_POST['submit'])) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id 		= $_GET['post_id'];
		
		$title_fil 	= filter_var($_POST['title'] , FILTER_SANITIZE_STRING);
		$title 		= check_input($title_fil);
		$content_f 	= /*filter_var(*/$_POST['content']/* , FILTER_SANITIZE_STRING)*/;
		$content 	= check_input($content_f);

		if (isset($_POST['img-file']) && !empty($_POST['img-file'])){
			$img 	= $_POST['img-file'];
		}else{
			$img 	= null;
		}

		if (isset($_POST['post-tags']) && !empty($_POST['post-tags'])){
			$tag_fil 	= filter_var($_POST['post-tags'] , FILTER_SANITIZE_STRING);
			$tags		= check_input(strtolower($tag_fil));
		}else{
			$tags = null;
		}

		$q 		= $pdo->prepare("UPDATE posts SET post_title=:ttl,post_content=:cont,attach_id=:attach,post_tags=:tags WHERE post_id = :id ");
		$exec 	= $q->execute(array(
					'ttl' 	=> $title,
					'cont' 	=> $content,
					'attach'=> $img,
					'tags'	=> $tags,
					'id' 	=> $id
					));

		if (isset($exec)) {
			$sts = '<div class="alert"><div class="center-block text-center update-message"><span class="glyphicon glyphicon-ok"></span><span class="text-success"> post has been updated successfully..</span></div></div>';
			echo $sts;
		}else{
			$err = '<div class="alert"><div class="center-block text-center update-message"><span class="glyphicon glyphicon-warning-sign"></span><span class="text-success"> something went wrong.!</span></div></div>';
			echo $err;
		}

		$q 	 = null;

	}else{
	        header('location:index.php');
	        exit;
	}
// }

