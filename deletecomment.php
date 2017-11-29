<?php 	//ob_start();
        // include_once 'db.php';
		$pagetitle = 'Delete Comment';
        // ======================

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        	if (isset($_POST['com_id'])){
        		$com_id = $_POST['com_id'];

        		$q = $pdo->prepare("DELETE FROM comments WHERE comment_id = ?");
        		$q->bindValue(1,$com_id);
        		$del = $q->execute();

        		if ($del){
        			echo '<div class="center-block text-center update-message alert alert-success"><span class="glyphicon glyphicon-ok"></span><span class="text-success"> comment has been deleted..!</span></div>';
        		}
        	}
        }else{
        	echo '<div class="center-block text-center update-message alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span><strong class="text-danger"> sorry, you seem in the wrong place..!</strong></div>';
        }


        //ob_end_flush();
?>
