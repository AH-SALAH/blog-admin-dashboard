<?php 

	if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
    	$id = $_SESSION['id'];

		$query = '';
		if (isset($_SESSION['id']) && is_numeric($_SESSION['id']) && $_SESSION['group_id'] != 1) {
			$query = 'JOIN users ON attachments.`user_id` = users.`user_id` WHERE users.`user_id` = ? ';
		}

    	$q 		= $pdo->prepare("SELECT * FROM attachments $query");
    	isset($query) ? $q->bindValue(1,$id) : '';
		$q->execute();
		$files 	= $q->fetchAll();
        // }

		// =================================== //
		// delete files handling

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        	if (isset($_POST['delete_id'])){
	        	$att_id 	= $_POST['delete_id'];

				$que 			= $pdo->prepare("SELECT attach_name FROM attachments WHERE attachments.`attach_id` = ?");
	        	$que->bindValue(1,$att_id);
				$que->execute();
				$att_name 	= $que->fetchColumn();

				unlink(dirname(__FILE__).'/uploads/gallery/'.$att_name);

	        	$quee 		= $pdo->prepare("DELETE FROM `attachments` WHERE user_id = ? AND attach_id = ?");
	        	$quee->bindValue(1,$id);
	        	$quee->bindValue(2,$att_id);
				$ex 	= $quee->execute();

				if (isset($ex)) {
					echo "file has been removed successfully..";
				}

			}

			// =================================================================
			// rename handling
			if (isset($_POST['rename_id']) && isset($_POST['re_name'])){
	        	$att_id 	= $_POST['rename_id'];
	        	$re_name 	= $_POST['re_name'];

				$qw 			= $pdo->prepare("SELECT attach_name FROM `attachments` WHERE attach_id = ?");
	        	$qw->bindValue(1,$att_id);
				$qw->execute();
				$att_name 	= $qw->fetchColumn();

				$dir = dirname(__FILE__).'/uploads/gallery/';
				rename($dir.$att_name, $dir.$re_name);

	        	$query 	= $pdo->prepare("UPDATE attachments SET attach_name = ? WHERE attach_id = ?");
	        	$query->bindValue(1,$re_name);
	        	$query->bindValue(2,$att_id);
				$ex 	= $query->execute();

				if (isset($ex)) {
					echo 'file has been renamed successfully..';
				}

			}

			// $q = null;

        }

?>

<!-- ============================================= -->
<div id="attach-files" class="container-fluid">
	<!-- <div class="row"> -->
		<div id="files-wrapper" class="col-xs-12 col-sm-12 col-md-12 list-group well well-sm h6">
			<div class="loader"></div>
			<div class="list col-xs-12 col-sm-12 col-md-12 no-padd">
				<?php foreach ($files as $file) : ?>
			    <li class="col-xs-12 col-sm-4 col-md-2 well-sm">
				    <div class="item-wrapper list-group-item well-sm no-border-rad">

			    		<div class="thumbnail">
			    			<img src="uploads/gallery/<?php if(isset($file['attach_name'])) echo $file['attach_name'];?>" class="img-responsive">
			    			<strong class="img-name" title="<?php if(isset($file['attach_name'])) echo $file['attach_name']; ?>"><?php if(isset($file['attach_name'])) echo $file['attach_name']; ?></strong>
							<?php 
					    			if(isset($file['attach_name'])) {
					    				$dir 	= __DIR__.'/uploads/gallery/';
					    				$scan 	= scandir($dir);
					    				$fl 	=  $file['attach_name'];

					    				if (file_exists($dir.$fl)) {
					    					$filesize = filesize($dir.$fl);
					    	?>
					    		<small class="center-block label label-warning"><?php echo format_size($filesize); ?></small>

				    		<?php	}
					    		}
				    		?>
						</div>
			
						<div class="btn-group-sm">
			    			<button type="submit" name="delete" class="btn btn-danger btn-sm" data-toggle="tooltip" data-trigger="hover" title="Delete | 消す"><span class="glyphicon glyphicon-trash"></span></button>

			    			<a href="#" data-toggle="modal" data-target="#name-edit">
			    				<button type="submit" name="edit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-trigger="hover" data-toggle="modal" data-target="#name-edit" title="Edit | 名前を変わる"><span class="glyphicon glyphicon-edit"></span></button>
			    			</a>
			    		</div>
			    		<input type="hidden" id="attach_name" name="attach_name" class="form-control" value="<?php if(isset($file['attach_name'])) echo $file['attach_name']; ?>" style="display:none;"/>

			    		<input type="hidden" id="attach_id" name="attach_id" value="<?php if(isset($file['attach_id'])) echo $file['attach_id']; ?>"/>
				    </div>
			    </li>
				<?php endforeach; ?>
			</div>
		</div><!-- /.files-container -->
	<!-- </div> /.row -->
</div> <!-- /.container -->
<?php } ?>
<!-- ===================================== -->
