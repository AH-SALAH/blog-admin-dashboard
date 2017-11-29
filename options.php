<?php
    if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
            header('location:index.php');
            exit;
    }

    $pagetitle = 'Options';

    // ==========================
    if (isset($_SESSION['id'])) {
    	$s_id = $_SESSION['id'];
    }

    	$theme = $pdo->prepare("SELECT * FROM admin_theme_option WHERE user_id = ?");
	    $theme->execute(array($s_id));
	    $throw = $theme->rowCount();

	    if ($throw > 0) {
	    	$op = $theme->fetch(PDO::FETCH_ASSOC);
	    	
	    }

    // ==========================
// if (isset($_POST['submit'])) {
    	
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	if (isset($_GET['page_id']) && $_GET['page_id'] == 'options') {

	    	$header_color 			= $_POST['header_color'];
	    	$left_nav_color 		= $_POST['left_nav_color'];
	    	$left_nav_btns_bg_color = $_POST['left_nav_btns_bg_color'];
	    	$left_nav_btns_color 	= $_POST['left_nav_btns_color'];
	    	$footer_color 			= $_POST['footer_color'];
	    	$all 					= array($header_color,$left_nav_color,$left_nav_btns_bg_color,$left_nav_btns_color,$footer_color);

	    	foreach ($all as $input) {
	    		if (!empty($input) || $input != null || $input != undefined) {
		    		$filtered 	= filter_var($input, FILTER_SANITIZE_STRING);
		    	}else{
		    		$err[] 		= 'input values not properly set..!';
		    	}
	    	}

	    	if (!isset($err)) {
	    		
	    		$que = $pdo->prepare("SELECT * FROM admin_theme_option WHERE user_id = ?");
			    $que->execute(array($s_id));
			    $srows = $que->rowCount();

			    if ($srows > 0) {

					$q 		= $pdo->prepare("UPDATE admin_theme_option SET header_color = ? ,left_nav_color = ?,left_nav_btns_bg_color = ?,left_nav_btns_color = ?,footer_color = ? WHERE user_id = ? ");
		    		$args 	= array($header_color,$left_nav_color,$left_nav_btns_bg_color,$left_nav_btns_color,$footer_color,$s_id);
		    		$q->execute($args);
		    		$rows 	= $q->rowCount();

		    		if ($rows > 0) {
		    			$success[] 	= 'Theme color has been updated successfully..';

		    			$theme = $pdo->prepare("SELECT * FROM admin_theme_option WHERE user_id = ?");
					    $theme->execute(array($s_id));
					    $throw = $theme->rowCount();

					    if ($throw > 0) {
					    	$op = $theme->fetch(PDO::FETCH_ASSOC);
					    	
					    }
	    
		    		}else{
		    			$err[] 		= 'something went wrong .. No record affected..! or same values set..!';
		    		}

	    		}else{
	    			$qwe 	= $pdo->prepare("INSERT INTO admin_theme_option(header_color,left_nav_color,left_nav_btns_bg_color,left_nav_btns_color,footer_color,user_id) VALUES(?,?,?,?,?,?) ");
		    		$args 	= array($header_color,$left_nav_color,$left_nav_btns_bg_color,$left_nav_btns_color,$footer_color,$s_id);
		    		$ins 	= $qwe->execute($args);

		    		if($ins){
		    			$success[] = 'Theme Color has been set successfully..';

		    			$theme = $pdo->prepare("SELECT * FROM admin_theme_option WHERE user_id = ?");
					    $theme->execute(array($s_id));
					    $throw = $theme->rowCount();

					    if ($throw > 0) {
					    	$op = $theme->fetch(PDO::FETCH_ASSOC);
					    	
					    }

		    		}else{
		    			$err[] 		= 'something went wrong .. No record has been set..!';
		    		}

	    		}

	    	}
	    }
    	
    }

// }

?>
<form class="option-form" method="post" accept-charset="utf-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?page_id=options'; ?>" enctype="multipart/form-data">
	<div class="row">
		<div class="error has-error col-sm-12">
			<?php  
				if (isset($err)) {
					foreach ($err as $er) {
						echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> '. $er .'</div>';
					}
				}
				
				if (isset($success)) {
					foreach ($success as $suc) {
						echo '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> '. $suc .'</div>';
					}
				}

			?>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="table-responsive">
				<table class="table-bordered table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th colspan="2" class="label-default">
								<span>Theme Color Setting</span>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="input-group-addon"><span>Header Nav</span></div> 
							</td>
							<td>
								<span>Background Color: </span>
								<input id="header-color" class="jscolor {styleElement:'header-nav',onFineChange:'update(this)'} form-control" name="header_color" value="<?php if(isset($op['header_color'])) { echo $op['header_color']; }else{ echo '39576B'; } ?>">
								<input id="header-color-hidden" class="form-control" name="header_color" type="hidden" value="<?php if(isset($op['header_color'])) { echo $op['header_color']; }else{ echo '39576B'; } ?>">
								<script>
									function update(jscolor) {
									    // 'jscolor' instance can be used as a string
									    document.getElementById('header-color').style.backgroundColor = '#' + jscolor;
									    document.getElementById('header-color').style.color = '#ccc';
									}
								</script>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon"><span>Left Nav</span></div>
							</td>
							<td>
								<span>Background Color: </span>
								<input id="left-nav-color" class="jscolor {styleElement:'left-nav',onFineChange:'update_l_bg_input(this)'} form-control" name="left_nav_color" value="<?php if(isset($op['left_nav_color'])) { echo $op['left_nav_color']; }else{ echo '39576B'; } ?>">
								<input id="left-nav-color-hidden" class="form-control" name="left_nav_color" type="hidden" value="<?php if(isset($op['left_nav_color'])) { echo $op['left_nav_color']; }else{ echo '39576B'; } ?>">
								
								<span>Buttons Bg Color: </span>
								<input id="left-nav-btns-bg-color" class="jscolor {onFineChange:'update_l_bg_btns(this)'} form-control" name="left_nav_btns_bg_color" value="<?php if(isset($op['left_nav_btns_bg_color'])) { echo $op['left_nav_btns_bg_color']; }else{ echo 'ffffff'; } ?>">
								<input id="left-nav-btns-bg-color-hidden" class="form-control" name="left_nav_btns_bg_color" type="hidden" value="<?php if(isset($op['left_nav_btns_bg_color'])) { echo $op['left_nav_btns_bg_color']; }else{ echo 'ffffff'; } ?>">
								
								<span>Buttons Color: </span>
								<input id="left-nav-btns-color" class="jscolor {onFineChange:'update_l_clr_btns(this)'} form-control" name="left_nav_btns_color" value="<?php if(isset($op['left_nav_btns_color'])) { echo $op['left_nav_btns_color']; }else{ echo '555555'; } ?>">
								<input id="left-nav-btns-color-hidden" class="form-control" name="left_nav_btns_color" type="hidden" value="<?php if(isset($op['left_nav_btns_color'])) { echo $op['left_nav_btns_color']; }else{ echo '555555'; } ?>">
								
								<script>
									function update_l_bg_input(jscolor) {
									    // 'jscolor' instance can be used as a string
									    document.getElementById('left-nav-color').style.backgroundColor = '#' + jscolor;
									}
									function update_l_bg_btns(jscolor) {
									    // 'jscolor' instance can be used as a string
									    document.querySelectorAll('.left-nav-links')[0].style.backgroundColor = '#' + jscolor;
									}
									function update_l_clr_btns(jscolor) {
									    // 'jscolor' instance can be used as a string
									    document.querySelectorAll('.left-nav-links')[0].style.color = '#' + jscolor;
									}
								</script>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group-addon"><span>Footer</span></div> 
							</td>
							<td>
								<span>Background Color: </span>
								<input id="footer-color" class="jscolor {styleElement:'footer',onFineChange:'update_footer_input(this)'} form-control" name="footer_color" value="<?php if(isset($op['footer_color'])) { echo $op['footer_color']; }else{ echo '39576B'; } ?>">
								<input id="footer-color-hidden" class="form-control" name="footer_color" type="hidden" value="<?php if(isset($op['left_nav_btns_color'])) { echo $op['footer_color']; }else{ echo '39576B'; } ?>">
								<script>
									function update_footer_input(jscolor) {
									    // 'jscolor' instance can be used as a string
									    document.getElementById('footer-color').style.backgroundColor = '#' + jscolor;
									}
								</script>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" value="">Save</button>
								<button type="button" name="default" class="btn btn-primary btn-sm pull-left" value="">Default</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
		</div><!-- /.col.. -->
	</div><!-- /.row -->
</form>
