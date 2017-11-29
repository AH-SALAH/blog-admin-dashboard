<?php 

        if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
            header('location:index.php');
            exit;
        }

?>
<!-- ================================================ -->
<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#files-container" class="files-tab tab-button">
                <span class="glyphicon glyphicon-file"></span><span> files</span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#upload-container" class="upload-tab tab-button">
                <span class="glyphicon glyphicon-upload"></span><span> upload</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="files-container" class="tab-pane fade in active">
            <?php include_once 'attach_files.php'; ?>
        </div>
        <div id="upload-container" class="tab-pane fade">
            <?php include_once 'upload.php'; ?>
        </div>
    </div>
</div>
