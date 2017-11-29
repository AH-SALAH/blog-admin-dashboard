<?php   //ob_start();

		$pagetitle = 'Update Comment';
        // ======================

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        	if (isset($_POST['com_id']) && isset($_POST['post_id']) && isset($_POST['textarea'])){
        		$com_id  = $_POST['com_id'];
                $post_id = $_POST['post_id'];
                $txt     = $_POST['textarea'];

        		$q    = $pdo->prepare("UPDATE comments SET comment = ? WHERE comment_id = ? AND post_id = ? ");
        	    $args = array($txt,$com_id,$post_id);
        		$up   = $q->execute($args);

        		if ($up){
        			echo '<div class="center-block text-center update-message alert alert-success"><span class="glyphicon glyphicon-ok"></span><span class="text-success"> comment has been updated successfully..!</span></div>';
        		}
        	}
        }else{
        	echo '<div class="center-block text-center update-message alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span><strong class="text-danger"> sorry, you seem in the wrong place..!</strong></div>';
        }


        //ob_end_flush();
?>
