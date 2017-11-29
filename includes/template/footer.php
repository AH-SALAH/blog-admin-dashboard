			<footer>
				<?php if (!isset($nofooternav)) { ?>
				<div id="footer" class="footer container-fluid <?php if(isset($_GET['page_id']) || strripos($_SERVER['PHP_SELF'], 'dashboard.php') > -1) echo 'col-xs-offset-2 col-sm-offset-2 col-md-offset-2'; ?>" style="background-color:<?php if(isset($op['footer_color'])) echo '#'.$op['footer_color']; ?>">
					<div class="row">
						<strong class="credit" data-trigger="hover" data-toggle="tooltip" title="アハマドサラーハでデザインされたと開発されたです。">Designed &amp; developed by Ahmed Salah &copy; <?= date('Y'); ?></strong>
					</div> <!-- /.row -->
				</div> <!-- /.container -->
				<?php } ?>
			</footer>
		<!-- </div> /.row -->
	<!-- </div> /.container -->
<!-- ==================================================== -->
<script type="text/javascript" src="style/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="style/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="style/js/bootstrap.min.js"></script>
<script type="text/javascript" src="style/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="style/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="style/js/jquery.nicescroll.min.js"></script>
<!-- <script type="text/javascript" src="style/js/summernote.min.js"></script> -->
<script type="text/javascript" src="style/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="style/js/jscolor.min.js"></script>
<script type="text/javascript" src="style/js/admin.js"></script>
<script type="text/javascript" src="style/js/admin_ajax.js"></script>

 </body>
 </html>
