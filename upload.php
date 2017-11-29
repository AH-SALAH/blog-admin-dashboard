<?php
        if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])) {
            header('location:index.php');
            exit;
        }
?>
<!-- ====================================== -->

<form class="upload-form col-md-12 h6 clearfix" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page_id=attach_upload'; ?>" method="post" enctype="multipart/form-data">
    <div class="status">
        <?php
                if (isset($err)){
                    foreach ($err as $val) {
                        echo $val;
                    }
                }

                if (isset($success)){
                        echo $success;
                }
        ?>
    </div>
    <div class="col-md-12 well well-sm clearfix">
        <div class="form-group">
            <div class="input-group file-input-group">
                <a class="btn btn-info" href="javascript:;">
                    Choose File...
                    <input type="file" name="file" class="form-control" value="" accept="image/*" onchange=''/>
                </a>
                &nbsp;
                <span class='label label-info' id="upload-file-info"></span>
            </div>
        </div> <!-- /.form-group -->
    </div> <!-- /.well -->
    <button class="btn btn-primary pull-left" type="submit" name="submit" value="update" placeholder=""><span class="h4">Upload</span></button>
</form>
