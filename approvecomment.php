<?php 
    // ==============================================
    // handle approve comment
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['capprove']) && $_SESSION['group_id'] == 1) {
            $cid    = $_POST['capprove'];

            $q      = $pdo->prepare("UPDATE comments SET com_status = 1 WHERE comment_id = ?");
            $q->bindValue(1,$cid);
            $q->execute();
            $rows   = $q->rowCount();

            if ($rows > 0) {
                echo '<div class="approve-message"><div class="center-block text-center alert alert-success"><span class="glyphicon glyphicon-ok"></span><strong style="color:#35de79;"> comment approved successfully..</strong></div></div>';
            }else{
                echo '<div class="approve-message"><div class="center-block text-center alert alert-danger"><span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><strong class="" style="color:#f00;"> this comment already approved or some thing went wrong..!</strong></div></div>';
            }

        }
    }else{
        echo '<div class="approve-message"><div class="center-block text-center alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span><strong class="text-danger"> sorry, you seem in the wrong place..!</strong></div></div>';
    }

?>