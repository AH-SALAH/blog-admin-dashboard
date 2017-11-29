<?php 	ob_start();

		session_start();
		if (!isset($_SESSION['name']) && !isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
			header('location:index.php');
			exit;
		}

		$pagetitle = 'Dashboard';
		include 'includes/template/header.php';
		include 'includes/template/header_nav.php';

?>
<!-- ================================================= -->
			<article>
				<div class="container-fluid content-container">
					<div class="row">
						<?php include 'includes/template/left_nav.php'; ?>
						<?php include 'includes/template/content.php'; ?>
					</div> <!-- /.row -->
				</div><!-- /.container-fluid -->
			</article>
		<!-- =========================================== -->
<?php include 'includes/template/footer.php'; ?>
<?php ob_end_flush(); ?>
