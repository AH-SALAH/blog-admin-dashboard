<div class="col-xs-10 col-xs-offset-2 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-content">
	<div class="row no-border-rad">
		<!-- <div class="col-md-1"></div> -->
		<div class="content-wrapper col-xs-12 col-sm-12 col-md-12">
			<div class="panel panel-default no-border-rad">
				<div class="panel-heading h3 no-marg"><?php content_panel_heading(); ?></div>
				<div class="panel-body">
					<?php content_body(); ?>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-4"></div> -->
	</div>
</div>

<!-- ===================================== -->
<!-- media modal -->

<!-- Modal -->
<div class="modal fade" id="post-media" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header" style="">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4><span class="glyphicon glyphicon-picture"></span> Media Attachment</h4>
        	</div>
        	<div class="modal-body" style="">
        		<?php if(function_exists('get_attachments') && ($_GET['page_id'] == 'createposts' || $_GET['page_id'] == 'editposts')) echo get_attachments(); ?>
        	</div>
        	<div class="modal-footer">
          		<button type="submit" name="choose" class="btn btn-primary btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-record"></span> Choose</button>
        	</div>
      	</div>
    </div>
</div>

<!-- ===================================== -->
<!-- media modal -->

<!-- Modal -->
<div class="modal fade" id="media" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header" style="">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4><span class="glyphicon glyphicon-picture"></span> Media Attachment</h4>
        	</div>
        	<div class="modal-body" style="">
        		<?php if(function_exists('get_attachments') && ($_GET['page_id'] == 'profile' || $_GET['page_id'] == 'edituser')) echo get_attachments(); ?>
        	</div>
        	<div class="modal-footer">
          		<button type="submit" name="choose" class="btn btn-primary btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-record"></span> Choose</button>
        	</div>
      	</div>
    </div>
</div>


<!-- ===================================== -->
<!-- file name edit modal -->

<!-- Modal -->
<div class="modal fade" id="name-edit" role="dialog">
    <div class="modal-dialog modal-sm">
      	<div class="modal-content">
        	<div class="modal-header" style="">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4><span class="glyphicon glyphicon-picture"></span> Attachment Rename</h4>
        	</div>
        	<div class="modal-body" style="">
        		<input type="text" name="modal_attach" class="form-control" value="<?php if(isset($file['attach_name'])) echo $file['attach_name']; ?>" data-id="<?php if(isset($file['attach_id'])) echo $file['attach_id']; ?>" style=""/>
        		<small>Tip: !important " rename with the file extension. (ex: admin<span style="color:red;">.jpg</span> ). "</small>
        	</div>
        	<div class="modal-footer">
          		<button type="submit" name="rename" class="btn btn-primary btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-edit"></span> Rename</button>
        	</div>
      	</div>
    </div>
</div>
