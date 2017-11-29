<?php session_start();

        if (!isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
            header('location:index.php');
            exit;
        }
        $nofooternav = '';
        include_once 'db.php';
        include_once 'includes/template/header.php';

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
    <div class="tab-content media-tab">
        <div id="files-container" class="tab-pane filing-tab fade in active">
            <?php include_once 'attach_files.php'; ?>
        </div>
        <div id="upload-container" class="tab-pane uploading-tab fade">
            <?php include_once 'upload.php'; ?>
        </div>
        <input id="selected-media-hidden" name="selected-media" data-media-type="" value="" type="hidden" />
    </div>
</div>
<?php include_once 'includes/template/footer.php'; ?>