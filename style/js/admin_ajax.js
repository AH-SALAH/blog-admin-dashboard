// $.noConflict();
jQuery(document).ready(function($) {

	"use strict";

// ++++++++++++++++++++++++++++++++++++++++++
// form ajax submit

var create_post_form 	= $("form.create-post-form");
var edit_post_form 		= $("form.edit-post-form");
var profile_form 		= $("form.profile-form");
var upload_form 		= $("form.upload-form");
var attach_file_form 	= $("form.attach-file-form");
var edit_user_form 		= $("form.edit-user-form");
var add_user_form 		= $("form.add-user-form");
var settings_form 		= $("form.settings-form");
var option_form 		= $("form.option-form");


// get text excerpt
// excerpt([string|object],[number]);
function excerpt(text,length){
	var split 		= text.trim().split(' '),
		len 		= split.length,
		str 		= split.join(' '),
		splitted 	= (length == '' || length == undefined) ? str.split(' ',len/2) : str.split(' ',length),
		str_j 		= splitted.join(' ')+'...';
		return str_j;
}
// -------------------------------------------
//send data with ajax

function create_posts_form_ajax(){
	var url = $(create_post_form).attr('action');

	$(create_post_form).on('submit',function(e) {
		e.preventDefault(); //prevent default submit
		var btn 		= $(create_post_form).find('[name="submit"]'),
			ttl 		= $(create_post_form).find('[name="title"]').val(),
			cont 		= $(create_post_form).find('[name="content"]').val(),
			// cont_txt 	= $(cont).text().trim(), // exctract form content text only..
			// cont_val 	= $(create_post_form).find('[name="content"]').val(cont_txt), //assign text only again to form content val
			serial		= $(create_post_form).serialize(), //serialize with text only
			// cont_return = $(create_post_form).find('[name="content"]').val(cont), //return to original val after serialization with text only
			preview 	= $(create_post_form).find('.preview .post-preview'),
			success 	= $(preview).parent().find('.alert-success'),
			warning 	= $(preview).parent().find('.alert-warning'),
			spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:3;"></i><span class="sr-only pull-right">Loading...</span>',
			empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> Post is empty...!</span>',
			ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> Post created successfully..</span>';

			// btn loading effect
			$(spin).insertAfter(btn);
				$(btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
				// if empty ? return
			if (ttl == '' || cont == '') {
				setTimeout(function(){
					$(btn).siblings(".fa-pulse").remove();
						$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(success).addClass('hidden');
								$(warning).removeClass('hidden').children('strong').html(empty_warn).hide().fadeIn('fast');
				},1000);
						return false;
		}else{
			// send data with ajax..
			$.ajax({
				url: url,
				type: 'POST',
				data: /*new FormData() ? new FormData(this) : */serial,
				// dataType: "html",
				cache: false,
		        // contentType: false,
		        processData: false,
			})
			.done(function(data) {
				// console.log("success");
				setTimeout(function(){
					// show proper alert
					var result = $(data).find('.alert').html();

					$(warning).addClass('hidden');
						$(success).removeClass('hidden').html(result).hide().fadeIn('fast');
							$(preview).removeClass('hidden').hide().fadeIn('slow');

					var title_preview 	= $(preview).find('.title-preview').html(ttl);
					var content_preview = $(preview).find('.content-preview').html(excerpt(cont,50));

					//return btn to normal
					$(btn).siblings(".fa-pulse").remove();
					$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
				},2000);

				setTimeout(function(){
					$(success).hide("slide",{"direction":"right"},"easeOut",300);
				},6000);

			})
			.fail(function(jqXHR,textStatus) {
				console.log("Request failed: " + textStatus);
			});
		}
	});

}
create_posts_form_ajax();

// ++++++++++++++++++++++++++++++++++++++++++

function edit_posts_form_ajax(){
	var url = $(edit_post_form).attr('action');

	$(edit_post_form).on('submit',function(e) {
		e.preventDefault(); //prevent default submit
		var btn 		= $(edit_post_form).find('[name="submit"]'),
			ttl 		= $(edit_post_form).find('[name="title"]').val(),
			cont 		= $(edit_post_form).find('[name="content"]').val(),
			serial		= $(edit_post_form).serialize(), //serialize
			preview 	= $(edit_post_form).find('.preview .post-preview'),
			success 	= $(preview).parent().find('.alert-success'),
			warning 	= $(preview).parent().find('.alert-warning'),
			spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:3;"></i><span class="sr-only pull-right">Loading...</span>',
			empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> Post is empty...!</span>',
			ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> Post updated successfully..</span>';

			// btn loading effect
			$(spin).insertAfter(btn);
				$(btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

			if (ttl == '' || cont == '') { // if empty ? return
				setTimeout(function(){
					$(btn).siblings(".fa-pulse").remove();
						$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(success).addClass('hidden');
								$(warning).removeClass('hidden').children('strong').html(empty_warn).hide().fadeIn('fast');
				},1000);
						return false;
		}else{
			// send data with ajax..
			$.ajax({
				url: url,
				type: 'POST',
				data: /*new FormData() ? new FormData(this) : */serial,
				cache: false,
		        // contentType: false,
		        // dataType: 'json',
		        processData: false,
			})
			.done(function(data) {
				//console.log("success");
				setTimeout(function(){
					// show proper alert
					var result = $(data).find('.alert').html();
					$(warning).addClass('hidden');
						$(success).removeClass('hidden').html(result).hide().fadeIn('fast');
							$(preview).removeClass('hidden').hide().fadeIn('slow');
					// append inputs val into the preview section
					var title_preview 	= $(preview).find('.title-preview').html(ttl);
					var content_preview = $(preview).find('.content-preview').html(excerpt(cont,50));
					//return btn to normal
					$(btn).siblings(".fa-pulse").remove();
					$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
				},2000);

				setTimeout(function(){
					$(success).hide("slide",{"direction":"right"},"easeOut",300);
				},6000);
			})
			.fail(function(jqXHR,textStatus) {
				console.log("Request failed: " + textStatus);
			});
		}

	});

}
edit_posts_form_ajax();

// ++++++++++++++++++++++++++++++++++++++

function upload_form_ajax(){
	var url = $(upload_form).attr('action');

	$(upload_form).on('submit',function(e) {
		e.preventDefault(); //prevent default submit
		var btn 		= $(upload_form).find('[name="submit"]'),
			file 		= $(upload_form).find('input[name=file]').val(),
			serial		= $(upload_form).serialize(), //serialize
			preview 	= $(upload_form).find('.preview .post-preview'),
			showerr 	= $(upload_form).find('.status'),
			info 		= $(upload_form).find('#upload-file-info'),
			spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:3;display:inline-block;"></i><span class="sr-only pull-right">Loading...</span>',
			empty_warn 	= ' <span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><span style="color:#cd5c5c;"> file is empty...!</span>',
			ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> file uploaded successfully..</span>',
			counter 	= $("#left-nav").find('#media-badge'),
			f_list 		= $("#attach-files").find('#files-wrapper .list');


			// btn loading effect
			$(spin).insertAfter(btn);
			$(btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

		if (file == '') { // if empty ? return

			$(btn).siblings(".fa-pulse").remove();
			$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

			$(showerr).empty().append(empty_warn);
			return false;

		}else{

			// send data with ajax..
			$.ajax({
				url: url,
				type: 'POST',
				data: new FormData() ? new FormData(this) : serial,
				// dataType: "html",
				cache: false,
		        contentType: false,
		        processData: false,
		        // async: false,
			})
			.done(function(data) {
				// console.log("success");
				setTimeout(function(){
					// show proper alert
					$(showerr).empty().show(700).append(ok_alert).delay(2000).hide('slow',function(){
						$(this).empty();
						$(info).empty();
					});

					// var q 	= window.location.search;
					// window.history.pushState('','',q+'&uploaded=true');

					//return btn to normal
					$(btn).siblings(".fa-pulse").remove();
					$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');


					$(f_list).load(window.location.href + " #attach-files #files-wrapper .list li",
						function(response, status, xhr) {
							var $data = $(response);
							$('[data-toggle="tooltip"]').tooltip();
							delete_file_ajax();
					});
					$(counter).load(window.location.href + " #left-nav #media-badge > span");

				},2000);
			})
			.fail(function(jqXHR,textStatus) {
				console.log("Request failed: " + textStatus);
			})
			.always(function() {
				// console.log("complete");
			});

			return false;
		}
	});

}
upload_form_ajax();


// ++++++++++++++++++++++++++++++++++++++

function delete_file_ajax(){
	var container 	= $('#attach-files'),
		f_wrapper 	= $(container).find('#files-wrapper'),
		f_svg 		= $(f_wrapper).find('.loader'),
		li 			= $(f_wrapper).find('li'),
		url 		= $(attach_file_form).attr('action');


	$(li).each(function(index, el) {
		var del_btn = $(el).find('[name="delete"]');

		$(del_btn).on('click',function(e) {
			e.preventDefault(); //prevent default submit
			var confirm 	= window.confirm("Are you sure?");
			if(confirm === true){

				var file_d 	= $(el).find('input[name="attach_id"]').val(),
					spin 	= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw" style="line-height:3;vertical-align:middle"></i><span class="sr-only">Loading...</span>';

					// btn loading effect
					$(spin).insertAfter($(this));
					$(this).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
					$(f_wrapper).addClass('before');
					$(f_svg).addClass('show');

					// send data with ajax..
					$.ajax({
						url: url,
						type: 'POST',
						data: {"delete_id":file_d},
						// dataType: 'html',
						cache: false,
					})
					.done(function(data) {
						// console.log("success");
						setTimeout(function(){
							$(del_btn).parents('li').hide("highlight",{color:'#c31e1b'},"easeOut",1000,function(){
								$(del_btn).parents('li').remove();
							});

							$(f_svg).removeClass('show');
							$(f_wrapper).removeClass('before');

							//return btn to normal
							$(del_btn).siblings(".fa-pulse").remove();
							$(del_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

							$("#left-nav #media-badge").load(window.location.href + " #left-nav #media-badge > span");
						},2000);
					})
					.fail(function(jqXHR,textStatus) {
						console.log("Request failed: " + textStatus);
					});
			}else{
				return false;
			}
		});
	});
}
delete_file_ajax();

// ++++++++++++++++++++++++++++++++++++++++++

//===========================================
	// attachments-edit-btn function //
//===========================================

function edit_btn() {
	var container 	= $("#attach-files"),
		modal_input	= $("#name-edit").find('[name="modal_attach"]'),
		li 			= $(container).find('li');

	$(li).each(function(index, el) {
		var edit_btn 		= $(el).find('[name="edit"]'),
			input_btn_n 	= $(el).find('[name="attach_name"]'),
			input_btn_id 	= $(el).find('[name="attach_id"]');

		$(edit_btn).on('click',function(event) {
			// event.preventDefault();
			$(modal_input).val($(input_btn_n).val());
			$(modal_input).data('id', $(input_btn_id).val());
		});
	});


}
edit_btn();					//=== >
							//	  v
							//	  v -relative

// ++++++++++++++++++++++++++++++++++++++++++

function rename_file_ajax(){
	var container 	= $('#attach-files'),
		f_wrapper 	= $(container).find('#files-wrapper'),
		f_svg 		= $(f_wrapper).find('.loader'),
		li 			= $(f_wrapper).find('li'),
		modal_sub	= $("#name-edit").find('[name="rename"]'),
		url 		= $(attach_file_form).attr('action'),
		f_list 		= $(f_wrapper).find('.list');


		$(modal_sub).on('click',function(e) {
			// e.preventDefault(); //prevent default submit
			var file_d 		= $("#name-edit").find('[name="modal_attach"]').data('id'),
				modal_input	= $("#name-edit").find('[name="modal_attach"]').val(),
				spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw" style="line-height:3;vertical-align:middle"></i><span class="sr-only">Loading...</span>';

				// btn loading effect
				$(spin).insertAfter($(this));
				$(this).prop('disabled', true).css('opacity', '0.7').addClass('disabled');


				// send data with ajax..
				$.ajax({
					url: url,
					type: 'POST',
					data: {"rename_id":file_d,"re_name":modal_input},
					// dataType: 'html',
					cache: false,
				})
				.done(function(data) {
					// console.log("success");
					setTimeout(function(){
						$(modal_sub).parents('li').hide("highlight","easeOut",1000,function(){
							$(modal_sub).parents('li').remove();
						});

						//return btn to normal
						$(modal_sub).siblings(".fa-pulse").remove();
						$(modal_sub).prop('disabled', false).css('opacity', '1').removeClass('disabled');

						// $('#name-edit').modal(close);

						$(f_list).load(window.location.href + " #attach-files #files-wrapper .list li",
							function(response, status, xhr) {
								var $data = $(response);
								$('[data-toggle="tooltip"]').tooltip();
								delete_file_ajax();
								edit_btn();
						});

					},2000);
				})
				.fail(function(jqXHR,textStatus) {
					console.log("Request failed: " + textStatus);
				})
				.always(function() {
					// console.log("complete");
				});
		});
	// });
}
rename_file_ajax();

// ++++++++++++++++++++++++++++++++++++++++++
// update profile
function update_profile_ajax(){
	var url = $(profile_form).attr('action');

	$(profile_form).on('submit',function(e) {
		e.preventDefault(); //prevent default submit
		var btn 		= $(profile_form).find('[name="submit"]'),
			serial		= $(profile_form).serialize(), //serialize with text only
			preview 	= $(profile_form).find('.preview'),
			alert 		= $(preview).find('.alert-prev'),
			uname 		= $(profile_form).find('[name="username"]').val(),
			email 		= $(profile_form).find('[name="email"]').val(),
			spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:3;"></i><span class="sr-only pull-right">Loading...</span>',
			empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> user name or email shouldn\'t be empty...!</span>',
			ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> profile updated successfully..</span>',
			prof_previ 	= $("#profile-form .profile-preview .img-viewer"),
			dash_upic 	= $('header .dash-user-pic > a');

			// btn loading effect
			$(spin).insertAfter(btn);
				$(btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

		if (uname == '' || email == '') { // if empty ? return
				setTimeout(function(){
					$(btn).siblings(".fa-pulse").remove();
						$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(alert).empty().html(empty_warn).hide().slideDown('fast');
				},1000);
				setTimeout(function(){
					$(alert).slideUp('slow');
				},5000);
						return false;
		}else{
			// send data with ajax..
			$.ajax({
				url: url,
				type: 'POST',
				data: new FormData() ? new FormData(this) : serial,
				// dataType: "html",
				cache: false,
		        contentType: false,
		        processData: false,
			})
			.done(function(data) {
				// console.log("success");
				setTimeout(function(){
					// show proper alert
					var result = $(data).find('.alert-prev').html();
						$(alert).empty().html(result).slideDown('slow');

					//return btn to normal
					$(btn).siblings(".fa-pulse").remove();
					$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');


					$(prof_previ).load(window.location.href + "#profile-form .profile-preview .img-viewer img",
						function(response, status, xhr) {
							var data 	= response;
							$(prof_previ).hide().fadeIn(1000);
					});

					$(dash_upic).load(window.location.href + " header .dash-user-pic > a > img",
						function(response, status, xhr) {
							var data 	= response;
							$(dash_upic).hide().fadeIn(1000);
					});

				},2000);

				setTimeout(function(){
					$(alert).slideUp('slow');
				},7000);

			})
			.fail(function(jqXHR,textStatus) {
				console.log("Request failed: " + textStatus);
			})
			.always(function() {
				// console.log("complete");

			});
		}
	});

}
update_profile_ajax();

// ++++++++++++++++++++++++++++++++++++++++++
// update profile
function update_user_ajax(){
	var url = $(edit_user_form).attr('action');

	$(edit_user_form).on('submit',function(e) {
		e.preventDefault(); //prevent default submit
		var btn 		= $(edit_user_form).find('[name="submit"]'),
			serial		= $(edit_user_form).serialize(), //serialize with text only
			preview 	= $(edit_user_form).find('.preview'),
			alert 		= $(preview).find('.alert-prev'),
			uname 		= $(edit_user_form).find('[name="username"]').val(),
			email 		= $(edit_user_form).find('[name="email"]').val(),
			spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:3;"></i><span class="sr-only pull-right">Loading...</span>',
			empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> user name or email shouldn\'t be empty...!</span>',
			ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> profile updated successfully..</span>',
			prof_previ 	= $(edit_user_form).find(".profile-preview .img-viewer");

			// btn loading effect
			$(spin).insertAfter(btn);
				$(btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

		if (uname == '' || email == '') { // if empty ? return
				setTimeout(function(){
					$(btn).siblings(".fa-pulse").remove();
						$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(alert).empty().html(empty_warn).hide().slideDown('fast');
				},1000);
				setTimeout(function(){
					$(alert).slideUp('slow');
				},5000);

						return false;
		}else{
			// send data with ajax..
			$.ajax({
				url: url,
				type: 'POST',
				data: new FormData() ? new FormData(this) : serial,
				// dataType: "html",
				cache: false,
		        contentType: false,
		        processData: false,
			})
			.done(function(data) {
				// console.log("success");
				setTimeout(function(){
					// show proper alert
					var result = $(data).find('.alert-prev').html();
						$(alert).empty().html(result).slideDown('slow');

					//return btn to normal
					$(btn).siblings(".fa-pulse").remove();
					$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

					$(prof_previ).load(window.location.href + "#profile-form .profile-preview .img-viewer img",
						function(response, status, xhr) {
							var data 	= response;
							$(prof_previ).hide().fadeIn(1000);
					});


				},2000);

				setTimeout(function(){
					$(alert).slideUp('slow');
				},7000);

			})
			.fail(function(jqXHR,textStatus) {
				console.log("Request failed: " + textStatus);
			})
			.always(function() {
				// console.log("complete");

			});
		}
	});

}
update_user_ajax();


// ++++++++++++++++++++++++++++++++++++++++++
// delete comment

function delete_comment() {
	var com_table 	= $('#comment-table'),
		tr 			= $(com_table).find('tbody tr');

		$(tr).each(function(index, el) {
			var delete_btn = $(el).find('.comment-delete-btn');

			$(delete_btn).on('click', function(event) {
				event.preventDefault();
				var confirm 	= window.confirm("Are you sure?");
				if(confirm === true){

					var com_id = $(el).find('[name="comment-id"]').val();

					$(el).hide("highlight","easeOut",1000);

					$.ajax({
						url: 'dashboard.php?page_id=deletecomment',
						type: 'POST',
						data: {'com_id': com_id},
					})
					.done(function(data) {
						// console.log("success");
						var com_container 	= $('.comment-container');

						$(com_container).prepend('<p class="center-block text-center delete-message alert alert-success">'+data+'</p>').hide().fadeIn(500,function(){
							$(this).find('.delete-message').delay(2000).fadeOut();
						});

						$(tr).css({'pointer-events':'auto','opacity': '1'});

					})
					.fail(function() {
						console.log("error");
					});
				}else{
					return false;
				}
				// console.log(com_id);
			});
		});


}delete_comment();


// ++++++++++++++++++++++++++++++++++++++++++
// edit comment

function edit_comment() {
	var com_table 	= $('#comment-table'),
		tr 			= $(com_table).find('tbody tr');

		$(tr).each(function(index, el) {
			var edit_btn = $(el).find('.comment-edit-btn'),
				com_body = $(el).find('.comment-body'),
				com_td 	 = $(com_body).parent('td'),
				txt 	 = $(com_body).text(),
				edit_area= $(el).find('.comment-textarea'),
				txtarea  = $(edit_area).find('textarea'),
				submit 	 = $(edit_area).find('[name="post-edit"]'),
				cancel 	 = $(edit_area).find('[name="cancel-edit"]'),
				hoka_tr  = $(this).siblings(tr);

			$(edit_btn).on('click', function(event) {
				event.preventDefault();

				// disable & brightless other tr
				$(hoka_tr).css({'pointer-events':'none','opacity': '0.5'});

				// do stuff
				$(edit_area).removeClass('hidden',function(){$(this).slideDown(300);});
				$(txtarea).val(txt);

			});
			// -------------------------//
			// on key up transfer data
			$(txtarea).on('keyup', function() {
				$(com_body).html($(txtarea).val());
			});
			// ------------------------//
			// on cancel return data
			$(cancel).on('click', function(event) {
				event.preventDefault();

				$(edit_area).slideUp(300,function(){
					$(this).addClass('hidden');
				});

				$(com_body).html(txt);

				// return & brightness other tr
				$(hoka_tr).css({'pointer-events':'auto','opacity': '1'});

			});

			// ----------------------//
			$(submit).on('click', function(event) {
				event.preventDefault();
				var com_id 	= $(el).find('[name="comment-id"]').val(),
					post_id = $(el).find('[name="comment-id"]').data('post-id'),
					newtxt 	= $(txtarea).val(),
					spin 	= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:3;"></i><span class="sr-only pull-right">Loading...</span>';

					$(spin).insertAfter($(this));
					$(this).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
					$(cancel).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

				$.ajax({
					url: 'dashboard.php?page_id=updatecomment',
					type: 'POST',
					data: {'com_id': com_id,'post_id': post_id,'textarea': newtxt},
				})
				.done(function(data) {
					// console.log("success");
					var com_container 	= $('.comment-container');

						txt = newtxt;

					setTimeout(function(){
						//return btn to normal
						$(submit).siblings(".fa-pulse").remove();
						$(submit).prop('disabled', false).css('opacity', '1').removeClass('disabled');
						$(cancel).prop('disabled', false).css('opacity', '1').removeClass('disabled');

						$(com_container).prepend(data).hide().fadeIn(500,function(){
							$(this).find('.update-message').delay(2000).fadeOut();
						});
						$(this).find(com_body).load(window.location.href + " #comment-table tbody tr .comment-body > span");
					},2000);

				})
				.fail(function() {
					console.log("error");
				});

			});



		});

}edit_comment();

// ++++++++++++++++++++++++++++++++++++++++++
// delete comment

function approve_comment() {
	var com_table 	= $('#comment-table'),
		tr 			= $(com_table).find('tbody tr'),
		spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw" style="line-height:1;width:15px;"></i><span class="sr-only pull-right">Loading...</span>',
		org_icon	= '<span class="glyphicon glyphicon-ok"></span>';


		$(tr).each(function(index, el) {
			var approve_btn = $(el).find('.comment-approve-btn');

			$(approve_btn).on('click', function(event) {
				event.preventDefault();

				$(this).html(spin);
				$(com_table).find('btn').prop('disabled', true).css('opacity', '0.7').addClass('disabled');

					var com_id = $(el).find('[name="comment-id"]').val();

					$.ajax({
						url: 'dashboard.php?page_id=approvecomment',
						type: 'POST',
						data: {'capprove': com_id},
					})
					.done(function(data) {
						// console.log("success");
						var com_container 	= $('.comment-container'),
							result 			= $(data).find('.approve-message').html();

						$(el).show("highlight","easeOut",'slow');

						setTimeout(function(){
							// show proper alert
							$(com_container).prepend(result).hide().fadeIn(300,function(){
								$(this).find('.alert').delay(4000).fadeOut();
							});
							//return btn to normal
							$(approve_btn).find(".fa-pulse").remove();
							$(approve_btn).html(org_icon);
							$(approve_btn).removeClass('btn-danger').addClass('btn-success').attr('data-original-title','Approved');
							$(com_table).find('btn').prop('disabled',false).css('opacity','1').removeClass('disabled');

						},2000);

					})
					.fail(function(jqxhr,textStatus) {
						console.log("error: "+textStatus);
						$(com_container).prepend('<p class="center-block text-center approve-message alert alert-danger">'+textStatus+'</p>').hide().fadeIn(300,function(){
							$(this).find('.approve-message').delay(4000).fadeOut();
						});
					});

				// console.log(com_id);
			});
		});


}approve_comment();

// ++++++++++++++++++++++++++++++++++++++++++
// add user
function add_user_ajax(){
	var url = $(add_user_form).attr('action');

	$(add_user_form).on('submit',function(e) {
		e.preventDefault(); //prevent default submit
		var btn 		= $(add_user_form).find('[name="submit"]'),
			serial		= $(add_user_form).serialize(), //serialize
			alert 		= $(add_user_form).find('.alrt'),
			uname 		= $(add_user_form).find('[name="username"]').val(),
			email 		= $(add_user_form).find('[name="email"]').val(),
			pass 		= $(add_user_form).find('[name="password"]').val(),
			spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:50px;"></i><span class="sr-only pull-right">Loading...</span>',
			empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> Neither user name nor email nor password should be empty...!</span>',
			ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> Account created successfully..</span>';

			// btn loading effect
			$(spin).insertAfter(btn);
				$(btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

		if (uname == '' || email == '' || pass == '') { // if empty ? return
				setTimeout(function(){
					$(btn).siblings(".fa-pulse").remove();
						$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(alert).empty().html(empty_warn).hide().slideDown('fast');
				},1000);
				setTimeout(function(){
					$(alert).slideUp('slow');
				},5000);
						return false;
		}else{
			// send data with ajax..
			$.ajax({
				url: url,
				type: 'POST',
				data: new FormData() ? new FormData(this) : serial,
				// dataType: "html",
				cache: false,
		        contentType: false,
		        processData: false,
			})
			.done(function(data) {
				// console.log("success");
				setTimeout(function(){
					// show proper alert
					var alrt = $(data).find('.alrt').html();
					$(alert).empty().html(alrt).slideDown('slow');

					//return btn to normal
					$(btn).siblings(".fa-pulse").remove();
					$(btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

				},2000);
				setTimeout(function(){
					$(alert).slideUp('slow');
					window.location = 'dashboard.php?page_id=manageusers';
				},7000);
			})
			.fail(function(jqXHR,textStatus) {
				console.log("Request failed: " + textStatus);
				$(alert).empty().html('<span style="color:#f00">something went wrong..! '+textStatus+'</span>');
			});
		}
	});

}
add_user_ajax();

// ++++++++++++++++++++++++++++++++++++++++++
// delete user
function delete_user_ajax(){
	var users_table = $('#users-table'),
		url 		= $('#users-table').find('.user-delete-btn').attr('href'),
		tr 			= $(users_table).find('tbody tr'),
		add_btn 	= $(users_table).find('.add-user-btn'),
		edit_btn 	= $(users_table).find('.user-edit-btn'),
		approve_btn = $(users_table).find('.user-need-approve-btn');

	$(tr).each(function(index, el) {
		var del_btn = $(el).find('.user-delete-btn');

		$(del_btn).on('click',function(e) {
			e.preventDefault(); //prevent default submit
			var confirm 	= window.confirm("Are you sure?");
			if(confirm === true){

				var serial		= $(users_table).serialize(), //serialize
					alert 		= $('.manage-users-container').find('.alrt'),
					uid 		= $(el).find('[name="user-id"]').val(),
					spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw" style="line-height:1;width:15px;"></i><span class="sr-only pull-right">Loading...</span>',
					org_icon	= '<span class="glyphicon glyphicon-trash"></span>',
					empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> Neither user name nor email should be empty...!</span>',
					ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> Account deleted successfully..</span>';

					// btn loading effect
					$(this).html(spin);
					// $(spin).insertAfter(span);
						$('.user-delete-btn').prop('disabled', true).css('opacity', '0.7').addClass('disabled');
						$(add_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
						$(edit_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
						$(approve_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

					// send data with ajax..
					$.ajax({
						url: url,
						type: 'POST',
						data: {'uid': uid},
						// dataType: "html",
						cache: false,
				        // contentType: false,
				        // processData: false,
					})
					.done(function(data) {
						// console.log("success");
						$(el).hide("highlight","easeOut",1000);
						setTimeout(function(){
							// show proper alert
							var alrt = $(data).find('.alrt').html();
							$(alert).empty().html(alrt).slideDown('fast');
							//return btn to normal
							$(del_btn).find(".fa-pulse").remove();
							$(del_btn).html(org_icon);
							$('.user-delete-btn').prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(add_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(edit_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(approve_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

						},2000);

						setTimeout(function(){
							$(alert).slideUp('slow');
						},5000);

					})
					.fail(function(jqXHR,textStatus) {
						console.log("Request failed: " + textStatus);
						$(alert).empty().html('<span style="color:#f00">something went wrong..! '+textStatus+'</span>');
					});
			}else{
				return false;
			}
		});
	});
}
delete_user_ajax();

// ++++++++++++++++++++++++++++++++++++++++++
// delete user
function approve_user_ajax(){
	var users_table = $('#users-table'),
		url 		= $('#users-table').find('.user-need-approve-btn').attr('href'),
		tr 			= $(users_table).find('tbody tr'),
		add_btn 	= $(users_table).find('.add-user-btn'),
		edit_btn 	= $(users_table).find('.user-edit-btn'),
		del_btn 	= $(users_table).find('.user-delete-btn');

	$(tr).each(function(index, el) {
		var approve_btn = $(el).find('.user-need-approve-btn');

		$(approve_btn).on('click',function(e) {
			e.preventDefault(); //prevent default submit
			var confirm 	= window.confirm("Are you sure?");
			if(confirm === true){

				var serial		= $(users_table).serialize(), //serialize
					alert 		= $('.manage-users-container').find('.alrt'),
					uid 		= $(el).find('[name="user-id"]').val(),
					spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw" style="line-height:1;width:15px;"></i><span class="sr-only pull-right">Loading...</span>',
					org_icon	= '<span class="glyphicon glyphicon-ok"></span>',
					empty_warn 	= '<span class="glyphicon glyphicon-warning-sign"></span><span style="color:#cd5c5c;"> Neither user name nor email should be empty...!</span>',
					ok_alert 	= '<span class="glyphicon glyphicon-ok"></span><span style="color:#35de79;"> Account deleted successfully..</span>';

					// btn loading effect
					$(this).html(spin);
					// $(spin).insertAfter(span);
						$('.user-need-approve-btn').prop('disabled', true).css('opacity', '0.7').addClass('disabled');
						$(add_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
						$(edit_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');
						$(del_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');


					// send data with ajax..
					$.ajax({
						url: url,
						type: 'POST',
						data: {'uapprove': uid},
						// dataType: "html",
						cache: false,
				        // contentType: false,
				        // processData: false,
					})
					.done(function(data) {
						// console.log("success");
						$(el).show("highlight","easeOut",'slow');
						setTimeout(function(){
							// show proper alert
							var alrt = $(data).find('.alrt').html();
							$(alert).empty().html(alrt).slideDown('fast');
							//return btn to normal
							$(approve_btn).find(".fa-pulse").remove();
							$(approve_btn).html(org_icon);
							$(approve_btn).removeClass('btn-danger').addClass('btn-success').attr('data-original-title','Approved');
							$('.user-need-approve-btn').prop('disabled',false).css('opacity','1').removeClass('disabled');
							$(add_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(edit_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');
							$(del_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

						},2000);

						setTimeout(function(){
							$(alert).slideUp('slow');
						},5000);


					})
					.fail(function(jqXHR,textStatus) {
						console.log("Request failed: " + textStatus);
						$(alert).empty().html('<span style="color:#f00">something went wrong..! '+textStatus+'</span>');
					});
			}else{
				return false;
			}
		});
	});
}
approve_user_ajax();


// ++++++++++++++++++++++++++++++++++++++++++
// update profile
function search() {
	var form 	= $('.navbar-form'),
		url 	= $(form).attr('action'),
		search 	= $(form).find('[type="search"]'),
		result 	= $(form).find('.search-dropdown');

	$(search).on('keyup', function() {
		var val = $(this).val();

		if(val != '' || val.match(/[a-z-A-Z]/gi) ) {
			$.ajax({
				url: 'search.php',
				type: 'POST',
				data: {'sq': val},
				cashe: false,
			})
			.done(function(data) {
				// console.log("success");
				$(result).slideDown('fast').html(data);
				if(val == '') $(result).slideUp('fast');
				$(search).on('blur', function() {
					$(result).slideUp('fast');
				});
			})
			.fail(function(jqXHR,textStatus) {
				console.log("error: "+textStatus);
			});
		}else {
			$(result).slideUp('fast');
		}
	});
}search();

// ===============================================
// time-stamp ajax

function the_clock() {
	var time = $("header").find(".clock");

	function get_time() {
		$.ajax({
			url: 'includes/functions/timestamp.php',
			// datatype: 'text',
			// crossDomain: true,
  			// contentType: false,
  			// cache: false,
  			// headers: {'Allow-Origin-Access': '*'}
  			// async:false
		})
		.done(function(data) {
			// console.log("success");
			$(time).html(data);
		})
		.fail(function(e) {
			console.log("error: ",responseText);
		});
	}

	$(time).hide().show("highlight","easeOut",3000);

	setInterval(get_time,1000);

}
the_clock();

// ===============================================
// post likes action

function post_like_action() {
	var like 	= $(".post-details .likes"),
		dislike = $(".post-details .dislikes"),
		post_id = $('[name="post_id"]').val(),
		lkid 	= $('#lk').attr('id'),
		dslkid 	= $('#dslk').attr('id');

	function like_ajax(url='',did='',id='',type='') {
		$.ajax({
			url: url,
			type: 'POST',
			data: did == 'lk' ? {'lk': id} : {'dslk': id},
		})
		.done(function(data) {
			// console.log("success");
			var vall = $(data).find('[name="returned_data"]').val();
			if (isNaN(parseFloat(vall)) ) {
				alert(vall);
			}else{
				if (type == '.likes-counter') {
					$(type).html(vall);
				}

				if (type == '.dislikes-counter') {
					$(type).html(val);
				}
			}

		})
		.fail(function() {
			console.log("error");
		});
		
	}

	$(like).on('click', function(e) {
		e.preventDefault();
 		var url 		= $(this).attr('href'),
 			lkcounter 	= '.likes-counter';
 		like_ajax(url,lkid,post_id,lkcounter);
	});

	$(dislike).on('click', function(e) {
		e.preventDefault();
 		var url 		= $(this).attr('href'),
 			dslkcounter = '.dislikes-counter';
 		like_ajax(url,dslkid,post_id,dslkcounter);
	});

}post_like_action();



// ===============================================
// theme option ajax

function theme_option_color() {

	var url 		= $(option_form).attr('action');
	var save_btn 	= $(option_form).find('[name="submit"]');
	var spin 		= '<i class="fa fa-spinner fa-pulse fa-1.5x fa-fw pull-right" style="line-height:2em;"></i><span class="sr-only pull-right">Loading...</span>';
	var alert 		= $(option_form).find('.error');

	$(save_btn).on('click', function(event) {
		event.preventDefault();
	
		var serial 		= $(option_form).serialize();

		// btn loading effect
		$(spin).insertAfter(save_btn);
		$(save_btn).prop('disabled', true).css('opacity', '0.7').addClass('disabled');

		$.ajax({
			url: url,
			type: 'POST',
			data: serial,
			cache: false,
		    // contentType: false,
		})
		.done(function(data) {
			console.log("success");

			setTimeout(function(){
				// show proper alert
				var alrt = $(data).find('.error').html();
				$(alert).html(alrt).show("slide","easeOut","fast");

				//return btn to normal
				$(save_btn).siblings(".fa-pulse").remove();
				$(save_btn).prop('disabled', false).css('opacity', '1').removeClass('disabled');

			},2000);
			setTimeout(function(){
				$(alert).hide("slide",{"direction":"up"},"easeOut","fast");
			},7000);

			console.log(data);

		})
		.fail(function() {
			console.log("error");
		});
		
		
	});

}theme_option_color();










// ===============================================
}); //doc ready close
