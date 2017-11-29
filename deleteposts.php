<?php
	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
	}

	$pagetitle = 'Delete Posts';
	// include_once 'db.php';
// ===============================

function update_nonce(){
	// delete_salt();
	date_default_timezone_set('Africa/Cairo');
	$expired 	= date('Y-m-d H:i:s',strtotime('+2 minute'));
	global $pdo;

	$update 	= $pdo->prepare("UPDATE posts SET post_nonce = :nonce,post_nonce_expired = :ex WHERE post_id = :id");
	$exec 		= $update->execute(array(
				'nonce' => $_GET['nonce'],
				'ex' 	=> $expired,
				'id' 	=> $_GET['post_id']
				));
}
update_nonce();


if (isset($_POST['submit'])){

	if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
		$id 	= $_GET['post_id'];

		if (isset($_GET['nonce'])){
			$nonce 	= $_GET['nonce'];
			date_default_timezone_set('Africa/Cairo');
			$date 	= date('Y-m-d H:i:s');

				$q 		= $pdo->prepare("SELECT post_nonce,post_nonce_expired FROM posts WHERE post_id = ?");
				$q->bindValue(1,$id);
				$q->execute();
				$noncee 	= $q->fetchAll();

			if ($noncee[0]['post_nonce_expired'] < $date){
				// echo $noncee[0]['post_nonce_expired'].'<br>';
				// echo '<br>'.$date.'<br>'.date('Y-m-d H:i:s',strtotime('+1 minute'));
				$q 		= $pdo->prepare("UPDATE posts SET post_nonce = null,post_nonce_expired = null WHERE post_id = ?");
				$q->bindValue(1,$id);
				$posts 	= $q->execute();

				$err[] = '<strong class="" style="color:red;text-align:center;display:block;"><span class="glyphicon glyphicon-warning-sign"></span> this page seems to be expired..!</strong>';
			}else if($noncee[0]['post_nonce'] != $nonce){
				$err[] = '<strong class="" style="color:red;text-align:center;display:block;"><span class="glyphicon glyphicon-warning-sign"></span> you suppose not to come to this page directly ..!</strong>';
			}else{

				$q 		= $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
				$q->bindValue(1,$id);
				$posts 	= $q->execute();

				if ($posts) {

					$cancel = '<script>
								setTimeout(function(){window.location="dashboard.php?page_id=manageposts&deleted_post='.$id.'";},2000);
								</script>';
					echo $cancel;
				}
			}

		}else{
			$err[] = '<strong class="" style="color:red;text-align:center;display:block;"><span class="glyphicon glyphicon-warning-sign"></span> you can\'t come this page directly ..!</strong>';
		}

	}else{
		$err[] = '<strong class="" style="color:red;text-align:center;display:block;"><span class="glyphicon glyphicon-warning-sign"></span> you can\'t browes this page directly ..!</strong>';
	}

}

?>

<form class="delete-post-form form-inline col-md-12 no-padd clearfix" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id='.$_GET['page_id'].'&post_id='.$_GET['post_id'].'&nonce='.$_GET['nonce']; ?>" method="post">
	<div class="col-md-8 well well-sm clearfix">
	<?php
		if (isset($err)){
			foreach ($err as $e) {
			 	echo $e;
			}
		}
	?>
	<?php if(isset($posts)) : ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span class="glyphicon glyphicon-ok-circle"></span><strong style="color:#3cb371;"><?php echo ' Post has been deleted successfully..';?></strong>
		</div>
	<?php endif; ?>
		<h2>Are you sure,you want to delete this post?</h2>
		<div class="form-group">
			<div class="input-group">
				<input class="form-control btn btn-primary" type="submit" name="submit" value="delete"/>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="input-group">
				<a href="<?php echo 'dashboard.php?page_id=manageposts'; ?>" class="btn btn-primary no-border-rad" type="button" name="cancel" value="" >cancel<a/>
			</div>
		</div> <!-- /.form-group -->
	</div>
</form>
