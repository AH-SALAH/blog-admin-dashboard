$.noConflict();
jQuery(document).ready(function($) {

	"use strict";


// ==========================================
// log in validate

function login_validate(){

	var form 		= document.querySelector(".login-form");
	if (form) {

	var	inputs 		= form.querySelector(".inputs"),
		F_group 	= inputs.querySelectorAll(".form-group"),
		username 	= inputs.querySelector("[name='username']"),
		password 	= inputs.querySelector("[name='password']"),
		all_inputs 	= form.elements,
		submit 		= form.querySelector("[name='submit']");
// console.log(form,inputs,F_group,username,password,H_warning,submit);

		form.onsubmit = function(){
				var user_value 	= username.value,
					pass_value 	= password.value,
					U_warn 		= inputs.querySelector(".user-warning"),
					P_warn 		= inputs.querySelector(".pass-warning"),
					B_Err 		= form.querySelector(".err")/*,
					alert 		= form.querySelector(".alert"),
					N_Err 		= form.querySelector(".name-err"),
					P_Err 		= form.querySelector(".pass-err")*/;
// console.log(document.getElementsByTagName("form")[0].elements[0]);

				//both check
				if ((user_value === '' || user_value === null) && (pass_value === '' || pass_value === null) && all_inputs[0,1].value == '' ) {
					// var N_Err = form.querySelector(".name-err"),
					// 	P_Err = form.querySelector(".pass-err");
						// if (N_Err || P_Err) { N_Err.style.display = "none"; P_Err.style.display = "none"; };
					/*console.log(alert);
					if (alert) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.querySelector("li").innerHTML = '<span class="glyphicon glyphicon-warning-sign"></span><strong> name & password can\'t be empty..!</strong>',
							U_border 	= username.style.cssText = "border:1px solid #9f0342;",
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},20);
						return false;
					}else */if (B_Err) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span><strong> name & password can\'t be empty..!</strong></li></div>',
							U_border 	= username.style.cssText = "border:1px solid #9f0342;",
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},20);
						return false;
					}else{
						var create_N 	= document.createElement("div"),
							add_class	= create_N.classList.add(/*"both-err",*/"err","text-center","no-border-rad"),
							inner 		= create_N.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span></li></div>',
							create_el 	= document.createElement("strong"),
							err_message = document.createTextNode(" name & password can\'t be empty..!"),
							create_mes 	= create_el.appendChild(err_message),
							insert_err 	= create_N.querySelector("li").appendChild(create_el),
							css 		= create_N.style.display = "block",
							append 		= form.insertBefore(create_N,inputs),
							U_border 	= username.style.cssText = "border:1px solid #9f0342;",
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
							// console.log(U_warn);
							return false;
					}
				}


				// username check
				if (user_value == '' || user_value == null) {
					/*if (alert) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.querySelector("li").innerHTML = '<span class="glyphicon glyphicon-warning-sign"></span><strong> name can\'t be empty..!</strong>',
							U_border 	= username.style.cssText = "border:1px solid #9f0342;",
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},20);
						return false;
					}else */if (B_Err) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span><strong> name can\'t be empty..!</strong></li></div>',
							U_border 	= username.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},10);
						return false;
					}else{
						var create_N 	= document.createElement("div"),
							add_class	= create_N.classList.add(/*"name-err",*/"err","text-center","no-border-rad"),
							inner 		= create_N.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span></li></div>',
							create_el 	= document.createElement("strong"),
							err_message = document.createTextNode(" name can\'t be empty..!"),
							create_mes 	= create_el.appendChild(err_message),
							insert_err 	= create_N.querySelector("li").appendChild(create_el),
							css 		= create_N.style.display = "block",
							append 		= form.insertBefore(create_N,inputs),
							border 		= username.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							// console.log(U_warn);
							return false;
					}

				}else if (!user_value.match(/^[a-zA-Z0-9]*[a-zA-Z]+[ ]*[_]*[a-zA-Z0-9]*$/gi)){
					if (B_Err) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span><strong> name can only contains a-z | A-Z | 0-9 | _ | space ..!</strong></li></div>',
							U_border 	= username.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},10);
						return false;
					}else{
						var create_N 	= document.createElement("div"),
							add_class	= create_N.classList.add(/*"name-err",*/"err","text-center","no-border-rad"),
							inner 		= create_N.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span></li></div>',
							create_el 	= document.createElement("strong"),
							err_message = document.createTextNode(" name can only contains a-z | A-Z | 0-9 | _ | space ..!"),
							create_mes 	= create_el.appendChild(err_message),
							insert_err 	= create_N.querySelector("li").appendChild(create_el),
							css 		= create_N.style.display = "block",
							append 		= form.insertBefore(create_N,inputs),
							border 		= username.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							// console.log(U_warn);
							return false;
					}

				}else{
					if (B_Err) B_Err.style.display = "none";
					username.style.cssText = "border:1px solid #ccc;border-left:0 none;";
					U_warn.classList.remove("has-warning");
					U_warn.classList.add("has-success");
					U_warn.children[0].classList.remove("glyphicon-warning-sign");
					U_warn.children[0].classList.add("glyphicon-ok");
				}

					//-----------------------------\\

				// password check
				if (pass_value == '' || pass_value == null) {
					/*if (alert) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.querySelector("li").innerHTML = '<span class="glyphicon glyphicon-warning-sign"></span><strong> password can\'t be empty..!</strong>',
							U_border 	= username.style.cssText = "border:1px solid #9f0342;",
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							U_warn.style.display = "block";
							U_warn.classList.remove("has-success");
							U_warn.classList.add("has-warning");
							U_warn.children[0].classList.remove("glyphicon-ok");
							U_warn.children[0].classList.add("glyphicon-warning-sign");
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},20);
						return false;
					}else */if (B_Err) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span><strong> password can\'t be empty..!</strong></li></div>',
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},10);
						return false;
					}else{
						var create_N 	= document.createElement("div"),
							add_class	= create_N.classList.add(/*"pass-err",*/"err","text-center","no-border-rad"),
							inner 		= create_N.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span></li></div>',
							create_el 	= document.createElement("strong"),
							err_message = document.createTextNode(" password can\'t be empty..!"),
							create_mes 	= create_el.appendChild(err_message),
							insert_err 	= create_N.querySelector("li").appendChild(create_el),
							css 		= create_N.style.display = "block",
							append 		= form.insertBefore(create_N,inputs),
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
							return false;
					}

				}else if(pass_value.length < 6){
					if (B_Err) {
						B_Err.style.display = "none";
						var err_li 		= B_Err.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span><strong> password can\'t be less than 6 charachters..!</strong></li></div>',
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
						setTimeout(function(){B_Err.style.display = "block";},10);
						// console.log(txtCont,addtxt);
						return false;
					}else{
						var create_N 	= document.createElement("div"),
							add_class	= create_N.classList.add(/*"pass-err",*/"err","text-center","no-border-rad"),
							inner 		= create_N.innerHTML = '<div class="alert alert-warning alert-dismissible no-border-rad" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li><span class="glyphicon glyphicon-warning-sign"></span></li></div>',
							create_el 	= document.createElement("strong"),
							err_message = document.createTextNode(" password can\'t be less than 6 charachters..!"),
							create_mes 	= create_el.appendChild(err_message),
							insert_err 	= create_N.querySelector("li").appendChild(create_el),
							css 		= create_N.style.display = "block",
							append 		= form.insertBefore(create_N,inputs),
							P_border 	= password.style.cssText = "border:1px solid #9f0342;";
							P_warn.style.display = "block";
							P_warn.classList.remove("has-success");
							P_warn.classList.add("has-warning");
							P_warn.children[0].classList.remove("glyphicon-ok");
							P_warn.children[0].classList.add("glyphicon-warning-sign");
							return false;
					}

				}else{
					if (B_Err) B_Err.style.display = "none";
						password.style.cssText = "border:1px solid #ccc;border-left:0 none;";
						P_warn.classList.remove("has-warning");
						P_warn.classList.add("has-success");
						P_warn.children[0].classList.remove("glyphicon-warning-sign");
						P_warn.children[0].classList.add("glyphicon-ok");

				}/*else{
					if (B_Err) B_Err.style.display = "none";
					// ------------
					// var N_Err = form.querySelector(".name-err");
					// if (N_Err) {
					// 	N_Err.style.display = "none";
					// }
					username.style.cssText = "border:1px solid #ccc;border-left:0 none;";
					U_warn.classList.remove("has-warning");
					U_warn.classList.add("has-success");
					U_warn.children[0].classList.remove("glyphicon-warning-sign");
					U_warn.children[0].classList.add("glyphicon-ok");
					// ------------
					// var P_Err = form.querySelector(".pass-err");
					// if (P_Err) {
					// 	P_Err.style.display = "none";
					// }
					password.style.cssText = "border:1px solid #ccc;border-left:0 none;";
					P_warn.classList.remove("has-warning");
					P_warn.classList.add("has-success");
					P_warn.children[0].classList.remove("glyphicon-warning-sign");
					P_warn.children[0].classList.add("glyphicon-ok");
					// return false;

				}*/
					return true;
		};

	};

}/*login_validate();*/


// ======================
// password reveal function
function pass_reveal() {
	var pass 		= $('input[type="password"]');

	$(pass).each(function(index, el) {
		var addon 	= $(el).next('.input-group-addon'),
			scale1 	= '(1.5)',
			scale2 	= '(1)';

		$(addon).on('mouseenter', function() {
			$(this).css({'color':'#0b4fe6'});
			$(this).children('.glyphicon-eye-close')
					.css('transform','scale'+scale1)
					.removeClass('glyphicon-eye-close')
					.addClass('glyphicon-eye-open');
			$(el).attr('type', 'text');
		});
		$(addon).on('mouseleave', function() {
			$(this).css({'color':''});
			$(this).children('.glyphicon-eye-open')
					.css('transform','scale'+scale2)
					.removeClass('glyphicon-eye-open')
					.addClass('glyphicon-eye-close');
			$(el).attr('type', 'password');
		});

	});
}pass_reveal();

// ======================
// all inputs placeholders function
function placeholder_fn() {
	var input 		= $('input');

	$(input).each(function(index, el) {
		var pl_holder 	= $(el).attr('placeholder');

		$(el).on('focus', function() {
			$(this).data('holder', pl_holder);
				$(this).attr('placeholder','');
		});

		$(el).on('blur', function() {
			$(this).attr('placeholder',$(this).data('holder'));
				$(this).data('holder', '');
		});

	});
}placeholder_fn();

	//============================================================================//
					// ========================================== //
							// posts forms js//
					// ========================================== //
var create_post_form 	= $("form.create-post-form");
var edit_post_form 		= $("form.edit-post-form");
var profile_form 		= $("form.profile-form");

// form-><textarea> summernote charachters counter
// function content_chars_counter() {
// 	var textarea = $(create_post_form).find('textarea');
// 		$(textarea).parent().append('<span class="text-info pull-right">0 charachter</span>');

// 		$('#post-content-area').on('summernote.keyup', function(we, e) {
// 			// console.log('Key is released:', e.keyCode);
// 			// var txtL = $(this).val().length,
// 			var markupStr = $('.note-editable').text().length;
// 			var	i 	 = 0;
// 			for(i; i <= markupStr;) {
// 					$(this).parent().find('.text-info').html(i+' characters');
// 				i++
// 			}
// 		});
// }
// content_chars_counter();

// ++++++++++++++++++++++++++++++++++++++++++++
// form file preview

function file_preview(forms) {
	var file 	= $(forms).find("input[type='file']"),
		info 	= $(forms).find('#upload-file-info');
			$(file).on('change', function() {
				var val = $(file).val();
					$(info).html(val);
			});
}
file_preview('form.create-post-form,form.edit-post-form,form.profile-form,form.upload-form');


// ++++++++++++++++++++++++++++++++++++++++++++
// profile file choose function//

function create_post_img_choose() {

	var modal 			= $('#post-media'),
		attach 			= $(modal).find('#attach-files'),
		choose_btn 		= $(modal).find('[name="choose"]'),
		post_img_previ 	= $(create_post_form).find('.post-img-preview'),
		img 			= $(post_img_previ).find('.img-preview'),
		remove 			= $(post_img_previ).find('.post-img-remove-link'),
		file_input 		= $(create_post_form).find('[name="img-file"]');

		$(choose_btn).on('click',function(event) {
			var li 	= $(attach).find('li .item-wrapper.selected'),
				val = $(li).find('[name="attach_id"]').val(),
				txt = $(li).find('.img-name').text();

				$(file_input).val(val);
				$(img).hide().attr('src', 'uploads/gallery/'+txt).fadeIn(1000);

		});

		$(remove).on('click',function(event) {

			$(file_input).val('');
			$(img).hide("highlight",{color:'#c31e1b'},"easeOut",1000,function(){
				$(this).attr('src', '');
			});

		});
// console.log(choose_btn,post_img_previ,img);
}
create_post_img_choose();

// ++++++++++++++++++++++++++++++++++++++++++++

function edit_post_img_choose() {

	var modal 			= $('#post-media'),
		attach 			= $(modal).find('#attach-files'),
		choose_btn 		= $(modal).find('[name="choose"]'),
		post_img_previ 	= $(edit_post_form).find('.post-img-preview'),
		img 			= $(post_img_previ).find('.img-preview'),
		remove 			= $(post_img_previ).find('.post-img-remove-link'),
		file_input 		= $(edit_post_form).find('[name="img-file"]');

		$(choose_btn).on('click',function(event) {
			var li 	= $(attach).find('li .item-wrapper.selected'),
				val = $(li).find('[name="attach_id"]').val(),
				txt = $(li).find('.img-name').text();

				$(file_input).val(val);
				$(img).hide().attr('src', 'uploads/gallery/'+txt).fadeIn(1000);

		});

		$(remove).on('click',function(event) {
			$(file_input).val('');
			$(img).hide("highlight",{color:'#c31e1b'},"easeOut",1000,function(){
				$(this).attr('src', '');
			});

		});
// console.log(choose_btn,post_img_previ,img);
}
edit_post_img_choose();

// ++++++++++++++++++++++++++++++++++++++++++++
// profile preview  function//

function profile_keyup_preview() {

	var forms 				= $('form.profile-form,form.edit-user-form'),
		username_input 		= $(forms).find('input[name="username"]'),
		username_preview 	= $(forms).find('.username-preview'),
		img_preview 		= $(forms).find('.img-preview');

	$(username_input).on('keyup',function() {
		$(username_preview).text(username_input.val());
	});

}profile_keyup_preview();

// ++++++++++++++++++++++++++++++++++++++++++++
// profile file choose function//

function profile_file_img_preview() {

	var forms 			= $('form.profile-form,form.edit-user-form'),
		modal 			= $('#media'),
		attach 			= $(modal).find('#attach-files'),
		choose_btn 		= $(modal).find('[name="choose"]'),
		file_hidden_btn = $(forms).find('[name="profile-file"],[name="file"]'),
		info 			= $(forms).find('#upload-file-info'),
		img_preview 	= $(forms).find('.img-preview');

		$(choose_btn).on('click',function(event) {
			var li 	= $(attach).find('li .item-wrapper.selected'),
				val = $(li).find('[name="attach_id"]').val(),
				txt = $(li).find('.img-name').text();

				$(file_hidden_btn).val(val);
				$(info).text(txt);
				$(img_preview).hide().attr('src', 'uploads/gallery/'+txt).fadeIn(1000);

		});

}profile_file_img_preview();


//===========================================
	// select item function//
//===========================================

function select_item() {
	var url = window.location.search;

	if ( url.indexOf('attachments') == -1 ) { // where this is not attachments page_id

	var attach 	= $('#attach-files'),
		li 		= $(attach).find('li'),
		item 	= $(li).find('.item-wrapper'),
		link 	= $(item).find('.thumbnail'),
		body 	= $('body');

		// console.log(url.indexOf('attachments'));

		$(item).on('click', function(event) {
			// event.preventDefault();

			$(this).addClass('selected');
			$(this).parent(li).siblings().children(item).removeClass('selected');

			$(body).on("click.bodyclick touchstart.bodyclick", function(event){
				// event.preventDefault();
				var target 	= event.target;
				if ( $(item).has(target).length == 0 && $(item).is(target) == false ) {
					$(item).removeClass('selected');
					$(body).off("click.bodyclick touchstart.bodyclick"); // removes the body click event with a bodyclick "namespace" to be specific to off this event only.
					// console.log("off");
				};
			});
		});

	}

}select_item();


//===========================================
	// bootstrap-tooltip-jq-plugin
// ==========================================

$('[data-toggle="tooltip"]').tooltip();

//===========================================
	// datatable-jq-plugin
// ==========================================

$('.data-table').DataTable({
  // "ajax": "manageposts.php"
  // autoWidth: false,
  "pagingType": "full_numbers",
  "order": [[ 0, 'desc' ]/*, [ 0, 'asc' ]*/],
  // "processing": true,
  // "serverSide": true,
});

//===========================================
	// tinymce editor-plugin
// ==========================================

tinymce.init({
	selector: 'textarea#post-content-area',
	height: 300,
	width: '100%',
	theme: 'modern',
	plugins: [
	'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	'searchreplace wordcount visualblocks visualchars code fullscreen',
	'insertdatetime media nonbreaking save table contextmenu directionality',
	'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
	],
	toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
	toolbar2: 'print preview  | link image imageuploader | media | forecolor backcolor emoticons | codesample',
	image_advtab: true,
	// force_br_newlines : false,
	force_p_newlines : false,
	forced_root_block : 'div',
	// templates: [
	//   { title: 'Test template 1', content: 'Test 1' },
	//   { title: 'Test template 2', content: 'Test 2' }
	// ],
	// content_css: [
	//   // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	//   // '//www.tinymce.com/css/codepen.min.css'
	// ]
	setup: function (editor) { // v1.0
		var textarea = $('form').find('textarea');

		$(textarea).parent().append('<strong class="text-info pull-right">0 charachter</strong>');

    	editor.on('keyup', function(e) {
      		var instance 	= tinymce.activeEditor.getContent(),
      			count 		= $(instance).text().trim().length,
      			txtinfo 	= $('.text-info'),
				i 	 		= 0;

				// update personal counter
				for(i; i <= count;) {
					$(txtinfo).html(i+' <span>characters</span>');

					if ((e.keyCode != 32) && (e.keyCode != 8)) {
						$(txtinfo).find(' > span').animate({'color': '#f00'},200,function(){
							$(this).css({'color': '#31708f'});
						});
					}
					
					i++
				}

				// update orig textarea content
				$(textarea).html(instance);

    	});

	    editor.addButton('imageuploader', {
	        text: 'Liberary',
	        icon: 'image',
	        tooltip: 'Use Media Liberary',
	        classes: 'imgupload',
	        onclick: function(e) {
	            //Open window
	            editor.windowManager.open({
	                title: 'Select Media',
	                url: 'media.php',
	                buttons: [{
	                    text: 'Submit',
	                    onclick: 'submit',
	                    classes: 'media-submit'
	                    }, {
	                    text: 'Cancel',
	                    onclick: 'close',
	                    classes: 'media-cancel'
	                }],
	                width: window.innerWidth - 100,
	                height: window.innerHeight - 100,
	                onsubmit: function(e) {
	                    var frame       = document.getElementsByTagName('iframe')[1],
	                    	innerDoc    = frame.contentDocument || iframe.contentWindow.document,
	                    	el          = innerDoc.getElementsByClassName('selected')[0],
	                    	input       = $(innerDoc).find('#selected-media-hidden'),
	                    	medianame   = $(el).find('#attach_name').val(),
	                    	mediaid    	= $(el).find('#attach_id').val(),
	                    	type        = $(input).attr('data-media-type'),
	                    	imgext      = [".jpg",".jpeg",".png",".gif"],
	                    	vidext      = [".mp4",".flv",".ogg",".web"];

	                    if (medianame.length > 0){
	                    	var i = 0,
	                    		c = 0;

	                    	// img check
	                    	for(i; i < imgext.length; i++){
					    		var ele = imgext[i],
					        		val = medianame.substring(medianame.length-4);

		                        if (ele.indexOf(val,-1) > -1) {
		                            var assign1 = $(input).attr('data-media-type','image'),
		                            	assign2 = $(input).val(mediaid),
		                            	type    = $(input).attr('data-media-type');

		                            if (type == 'image'){
	                            		editor.insertContent('<img class="img-responsive" src="uploads/gallery/' + medianame + '" />');
	                            		$(textarea).html(tinymce.activeEditor.getContent());
	                            		return true;
		                        	}
		                        }
		                    }

		                    // video check
	                    	for(c; c < vidext.length; c++){
						    	var ele = vidext[i],
						        	val = medianame.substring(medianame.length-4);

		                        if(ele.indexOf(val,-1) > -1) {
		                            var assign1 = $(input).attr('data-media-type','video'),
		                            	assign2 = $(input).val(mediaid),
		                            	type    = $(input).attr('data-media-type'); 

		                            if (type == 'video'){
		                            	editor.insertContent('<video autobuffer controls><source src="uploads/gallery/' + medianame + '" /></video>');
		                            	$(textarea).html(tinymce.activeEditor.getContent());
		                            	return true;
		                        	}
		                        }
	                    	}

		                }else{
	                        alert('something went wrong');
	                        return false;
	                    }    

	                }

	            });
	        }
	    });

		// editor.on('NodeChange', function (e) {
	 //      console.log('Node changed');
	 //    });

    },

}); //init


//===========================================
	// summernote jq-editor-plugin
// ==========================================

// $('#post-content-area').summernote({
//   height: 250,                 // set editor height
//   minHeight: null,             // set minimum height of editor
//   maxHeight: null,             // set maximum height of editor
//   focus: false                  // set focus to editable area after initializing summernote
// });

//===========================================
	// niceScroll jq-plugin
// ==========================================
var isfirefox 		= navigator.userAgent.search(/firefox/gi); //firefox
var iswebkit 		= navigator.userAgent.search(/(applewebkit|khtml)/gi); //chrome
var detect_browser	= isfirefox >= 0 ? "body,.left-nav" : "html,body,.left-nav";

// if (window.location.search.search(/postcomment/gi) == -1) {

	$(detect_browser).niceScroll({
	  	autohidemode: false,
		cursorcolor: "#262626",
		cursorborder:"",
		background: "#808080",
		bouncescroll: true,
		// boxzoom: true,
		// dblclickzoom: true,
		horizrailenabled: false,
		// mousescrollstep : 10,
		// scrollspeed : 10,
		// touchbehavior : true,
		// grabcursorenabled: false,
		spacebarenabled: false,
	});

// }


//===========================================
	// cpanel dashboard svg totals cards
// ==========================================
function cards_svg(){

	var cards 	= $('.sts-cards'),
		list 	= $(cards).find('[class*="total"]');

	function loop(){
		$(list).each(function(index, el) {
			var svg 	= $(el).find('svg.crcls'),
				g 		= $(svg).find('g'),
				rect 	= $(g).find('rect'),
				counter = $(el).find('.counter'),
				i 		= 0;

				$(svg).css('opacity', '0');

			while(i < rect.length){
				$(svg).animate({'opacity':'1'},500);
				rect[i].classList.add("forwards"+[i+1]);
				i++
			}
			$(counter).each(function(index, el) {
				var counter_val = $(counter).html(),
				 	num 		= parseInt(counter_val),
					j 			= 0;

					var int 	= 	setInterval(function(){
									if(j <= num){
										$(counter).css('opacity', '1');
											$(counter).html(j++);
									}else{
										$(counter).css('opacity', '1');
										$(counter).html(counter_val);
										clearInterval(int);
									}
								},200);
				// console.log(counter,counter_val,num);
			});

		});
	}

window.onload = setTimeout(function(){loop();},1000);
	// g.addEventListener("mouseover",loop);
	// g.removeEventListener("mouseleave",loop);

}cards_svg();

//===========================================
	// panel plus trigger
// ==========================================
function plus_trigger() {
	var plus = $('.panel-heading .glyphicon-plus');
		$(plus).on('click', function() {
			$(this).toggleClass('closed').parent('.panel-heading').siblings($(this).data('target')).toggle("blind","easeOut",300);
			if ($(this).hasClass('closed')) {
				$(this).removeClass('glyphicon-plus').addClass('glyphicon-minus');
			}else{
				$(this).removeClass('glyphicon-minus').addClass('glyphicon-plus');
			}
		});
}plus_trigger();

//===========================================
	// prevent default for hashed links
// ==========================================
function prevent_hashed_link() {
	var a = $("[href='#']");
	$(a).on('click', function(event) {
		event.preventDefault();
	});
}prevent_hashed_link();


//===========================================
	// tag input function
// ==========================================
function tag_input_separator() {
	var tag_input 	= $(".tag-input");
	

	$(tag_input).on('keyup', function(e) {
		var tag_val = $(".tag-input").val();

		if (tag_val.indexOf(' ') > -1 && e.keyCode == 32) { 
			var op 	= tag_val.replace(' ',',').trim();
			$(tag_input).val(op);
		};

		var	reg = tag_val.match(/,,/gi);

		if (reg != null && e.keyCode == 32) {
			var oper = tag_val.replace(reg,',').trim();
			$(tag_input).val(oper);
		};

		var reg2 = tag_val.match(/^,*|,\s*|\s,*|,$/gi);

		if (reg2 != null) {
			var opera = tag_val.replace(reg2,'').trim();
			$(tag_input).val(opera);
		};
	});

		// var tagg_val 	= $(".tag-input").val();
		// var reg3 		= tagg_val.match(/^,*|,\s*|\s,*|,$/gi);

		// 	if (reg3 != null) {
		// 		var operat = tagg_val.replace(reg3,'').trim();
		// 		$(tag_input).val(operat);
		// 	}else{
		// 		$.trim(tagg_val);
		// 	}

}tag_input_separator();


//===========================================
	// jscolor-picker [theme-option]
// ==========================================

function update_left_nav_btns() {
    var l_nav_bg_btns 		= $('[name="left_nav_btns_bg_color"]');
    var l_nav_btns 			= $('[name="left_nav_btns_color"]');
    var left_nav_btns 		= $('#left-nav-list .list-group-item').not('.active');
    var option_form_jscolor = $(".option-form input.jscolor");


    $(l_nav_bg_btns).on('change',function(){
    	$(left_nav_btns).css('background-color', '#' + l_nav_bg_btns.val());
    });

    $(l_nav_btns).on('change',function(){
    	$(left_nav_btns).css('color', '#' + l_nav_btns.val());
    });

    // get inputs values dynamically on change for all hidden inputs
    $($(option_form_jscolor).not('[id*="hidden"]')).on('change', function() {
    	var val = $(this).val();
    	$('#'+$(this).attr('id') + '-hidden').val(val);
    });

    // on page ready get values to be self-bg
    var i = 0;
    for (i; i < option_form_jscolor.length; i++) {
    	var el = option_form_jscolor[i];

    	$(el).css({'background-color': '#' + $(el).val(),'color':'#ccc'});
    };


}update_left_nav_btns();

// ------------------------------------------
function default_values() {
	var default_btn 	= $('[name="default"]');
	var l_nav_color 	= $('[name="left_nav_color"]');
	var l_nav_bg_btns 	= $('[name="left_nav_btns_bg_color"]');
    var l_nav_btns 		= $('[name="left_nav_btns_color"]');
	var header_color 	= $('[name="header_color"]');
    var footer_color 	= $('[name="footer_color"]');

    var header_nav_bg	= $('#header-nav');
    var footer_bg 		= $('#footer');
    var left_nav 		= $('#left-nav');
    var left_nav_btns 	= $('#left-nav-list .list-group-item').not('.active');

	$(default_btn).on('click touchstart', function(event) {
		event.preventDefault();

		// reset inputs bg
		$(header_color).val('39576B').css('background-color', '#' + $(header_color).val());
		$(footer_color).val('39576B').css('background-color', '#' + $(footer_color).val());
		$(l_nav_color).val('39576B').css('background-color', '#' + $(l_nav_color).val());
		$(l_nav_bg_btns).val('ffffff').css('background-color', '#' + $(l_nav_bg_btns).val());
		$(l_nav_btns).val('555555').css('background-color', '#' + $(l_nav_btns).val());

		// reset elements
		$(header_nav_bg).css('background-color', '#' + $(header_color).val());
		$(footer_bg).css('background-color', '#' + $(footer_color).val());
		$(left_nav).css('background-color', '#' + $(l_nav_color).val());
		$(left_nav_btns).css({'background-color': '#' + $(l_nav_bg_btns).val(),'color': '#' + $(l_nav_btns).val()});

	});

}default_values();

// ==========================================





// ==========================================

}); // doc ready close.
