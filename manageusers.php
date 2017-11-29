<?php 	if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
            header('location:index.php');
            exit;
        }

// ==================================
    $pagetitle = 'Manage Users';
// ==================================

// ================================
	if (isset($_SESSION['id']) && $_SESSION['group_id'] == 1) :
		$id       = $_SESSION['id'];
        $group_id = $_SESSION['group_id'];

        $query = '';
        if (isset($_GET['status']) && $_GET['status'] == 'pending') {
            $query = 'AND reg_status = 0';
        }

		$q      = $pdo->prepare("SELECT * FROM users WHERE user_id != ? AND group_id != ? $query ORDER BY user_num DESC ");
        $args   = array($id,$group_id);
		$q->execute($args);
		$users  = $q->fetchAll(PDO::FETCH_ASSOC);

    // ==============================================
    // handle delete account
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['uid']) && $_SESSION['group_id'] == 1) {
            $uid    = $_POST['uid'];

            $q      = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
            $q->bindValue(1,$uid);
            $q->execute();
            $rows   = $q->rowCount();

            if ($rows > 0) {
                $del_success  = '<span class="glyphicon glyphicon-ok"></span><strong style="color:#35de79;"> Account deleted successfully..</strong>';
            }else{
                $del_err 	  = '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><strong class="" style="color:#f00;"> this account already not exist..!</strong>';
            }

        }
    }


    // ==============================================
    // handle approve account
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['uapprove']) && $_SESSION['group_id'] == 1) {
            $uid    = $_POST['uapprove'];

            $q      = $pdo->prepare("UPDATE users SET reg_status = 1 WHERE user_id = ?");
            $q->bindValue(1,$uid);
            $q->execute();
            $rows   = $q->rowCount();

            if ($rows > 0) {
                $approve_success  = '<span class="glyphicon glyphicon-ok"></span><strong style="color:#35de79;"> Account approved successfully..</strong>';
            }else{
                $approve_err 	  = '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><strong class="" style="color:#f00;"> this account already approved or some thing went wrong..!</strong>';
            }

        }
    }

?>

<div class="manage-users-container table-responsive">
    <div class="alrt">
        <?php
            if (isset($del_success)) {
                echo '<div class="alert-prev alert-success text-center">'.$del_success.'</div>';
            }
            if (isset($del_err)) {
                echo '<div class="alert-prev alert alert-warning text-center">'.$del_err.'</div>';
            }
            if (isset($approve_success)) {
                echo '<div class="alert-prev alert alert-success text-center">'.$approve_success.'</div>';
            }
            if (isset($approve_err)) {
                echo '<div class="alert-prev alert alert-warning text-center">'.$approve_err.'</div>';
            }
        ?>
    </div>
    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=adduser'; ?>" class="btn btn-primary btn-sm add-user-btn" data-toggle="tooltip" title="create New User" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-plus"></span><strong> Add User</strong>
    </a>
	<table id="users-table" class="data-table table table-striped table-bordered table-hover table-condensed bg-info" cellspacing="0">
		<thead>
			<tr class="bg-warning">
				<th class="col-xs-1">#</th>
                <th class="col-xs-2">First Name</th>
                <th class="col-xs-2">Last Name</th>
				<th class="col-xs-2"><span class="glyphicon glyphicon-user"></span> User Name</th>
				<th class=""><span class="glyphicon glyphicon-envelope"></span> Email</th>
				<th class="col-xs-2"><span class="glyphicon glyphicon-calendar"></span> Registered Date</th>
				<th class="col-xs-2">Action</th>
			</tr>
		</thead>
		<tbody>
            <?php foreach ($users as $user) { ?>
			<tr class="">
				<td>
					<p class="center-block text-center user-num"><span><?= $user['user_num']; ?></span></p>
					<input type="hidden" name="user-id" value="<?= $user['user_id']; ?>" >
				</td>
				<td>
					<p class="center-block text-center fname"><?= $user['first_name'];  ?></p>
				</td>
                <td>
					<p class="center-block text-center lname"><?= $user['last_name'];  ?></p>
				</td>
				<td>
					<p class="user-name"><span><?= $user['user_name']; ?></span></p>
				</td>
                <td>
					<p class="user-email"><span><?= $user['email']; ?></span></p>
				</td>
				<td>
					<small class="center-block text-center registered-date">
                        <?php
							$date = date('d/m/Y | H:i:s A',strtotime($user['registered']));
							echo $date;
						?>
					</small>
				</td>
				<td class="text-center action-btns">
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=edituser&amp;user_id='.$user['user_id']; ?>" class="btn btn-info btn-sm user-edit-btn" data-toggle="tooltip" title="Edit" data-trigger="hover"><span class="glyphicon glyphicon-edit"></span>
                    </a>
					<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=manageusers'; ?>" class="btn btn-danger btn-sm user-delete-btn" data-toggle="tooltip" title="Delete" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-trash"></span>
                    </a>
                <?php if ($user['reg_status'] == 0 ): ?>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page_id=manageusers'; ?>" class="btn btn-danger btn-sm user-need-approve-btn" data-toggle="tooltip" title="Need Approval click to approve" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-exclamation-sign"></span>
                    </a>
                <?php else: ?>
                    <button class="btn btn-sm btn-success user-approved-btn" data-toggle="tooltip" title="Approved" data-trigger="hover" onclick=""><span class="glyphicon glyphicon-ok"></span>
                    </button>
                <?php endif; ?>
				</td>
			</tr>
            <?php } ?>
		</tbody>
	</table>
</div><!-- /.manage-users-container -->

<?php
    endif;
?>
