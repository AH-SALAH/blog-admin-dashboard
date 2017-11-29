<?php

// =================================
	// set time zone v1.0 //
// =================================
    date_default_timezone_set('Africa/Cairo');


// =================================
	// inputs check function v1.0 //
// =================================
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


// =================================
	// title function v1.0 //
// =================================

function title(){

	global $pagetitle;

	if (isset($pagetitle)) {
		echo $pagetitle;

		if (isset($_GET['page_id'])) {

			switch ($_GET['page_id']) :

			case 'postslist':
					echo ' | Posts List';
					break;
				case 'createposts':
					echo ' | Create Posts';
					break;
				case 'manageposts':
					echo ' | Manage Posts';
					break;
				case 'postdetails':
					echo ' | Post Details';
					break;
				case 'editposts':
					echo ' | Edit Posts';
					break;
				case 'profile':
					echo ' | Edit Profile';
					break;
				case 'attachments':
					echo ' | Media';
					break;
				case 'postcomment':
					echo ' | Comments';
					break;
				case 'options':
					echo ' | Options';
					break;
				case 'settings':
					echo ' | Settings';
					break;
				case 'manageusers':
					echo ' | Manage Users';
					break;
				case 'edituser':
					echo ' | Edit User';
					break;
				case 'adduser':
					echo ' | Add User';
					break;
				case 'updateuser':
					echo ' | update User';
					break;
				case 'posttags':
					echo ' | Tag Result';
					break;
				
				default:
					echo ' | Cpanel';
					break;
			endswitch;
		}
	}
}

// =================================
// Left nav walker class function v1.0 //
// =================================

function leftNav_activeClass($pages = array(''),$default = false) {
		$active = 'active';
	if (isset($_GET['page_id']) && in_array($_GET['page_id'], $pages)) {
		return $active;
	}else if(!isset($_GET['page_id']) && $default == true){
		return $active;
	}
}

// =================================
	// content heading function v1.0 //
// =================================

function content_panel_heading() {
	if (isset($_GET['page_id'])) {
		switch ($_GET['page_id']) :
			case 'postslist':
				echo 'posts List';
				break;
			case 'createposts':
				echo 'create post';
				break;
			case 'manageposts':
				echo 'manage posts';
				break;
			case 'postdetails':
				echo 'post details';
				break;
			case 'editposts':
				echo 'Edit post';
				break;
			case 'profile':
				echo 'Profile';
				break;
			case 'updateprofile':
				echo 'Update Profile';
				break;
			case 'attachments':
				echo 'Media';
				break;
			case 'postcomment':
				echo 'Comments';
				break;
			case 'options':
				echo 'Options';
				break;
			case 'settings':
				echo 'Settings';
				break;
			case 'manageusers':
				echo 'Manage Users';
				break;
			case 'edituser':
				echo 'Edit User';
				break;
			case 'adduser':
				echo 'Add User';
				break;
			case 'updateuser':
				echo 'update User';
				break;
			case 'posttags':
					echo 'Posts Result';
					break;

			default:
				echo 'Overview';
				break;
		endswitch;
	}else{
		echo 'Overview';
	}
}

// =================================
	// content-body-function v1.0 //
// =================================

function content_body() {
	global $pdo;
	if (isset($_GET['page_id']) && is_file($_GET['page_id'] . '.php')) {
		include $_GET['page_id'] . '.php';
	}elseif(!isset($_GET['page_id'])){
		include 'cpanel.php';
	}else{
		echo '<h4>Page can not be found..</h4>';
		die();
	}

}

// =================================
	// password hash function v1.0 //
// =================================

function password_hashing($pass=''){
	// $md5 	= md5($pass);
	// $sha 	= hash('sha512', $md5)/*.uniqid('\_/', true)*/;
	$option = array(
				'salt' 	=> 'ljjiiouy65675443ffuyttt76##@$#$$',
			);
	$hash 	= password_hash($pass, PASSWORD_DEFAULT,$option);
	return $hash;
}

// =================================
	// user greeting function v1.0 //
// =================================

function greet_user(){

	// check for the name
	if (isset($_SESSION['name'])) {
		date_default_timezone_set('Africa/Cairo');
		$uname		= ucwords($_SESSION['name'],'he');
		$date 		= date('m-d');
		$time 		= date('H:i');
		$lang_li	= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$lang 		= substr($lang_li, 0, 2);
		$daily 		= array($time,$lang);
		$annual 	= array($date,$lang);
		$morning 	= file_get_contents('style/fonts/svg/morning.svg');
		$afternoon 	= file_get_contents('style/fonts/svg/afternoon.svg');
		$night 		= file_get_contents('style/fonts/svg/night.svg');

		// greet on the daily time
		switch ($daily) {
			// morning
			case ($daily[0] >= '00:00' && $daily[0] < '12:00' && $daily[1] == 'en'):
				$msg[] 	= $morning.'<span class="greet"> Good Morning, '.$uname.'</span>';
				break;
			case ($daily[0] >= '00:00' && $daily[0] < '12:00' && $daily[1] == 'ja'):
				$msg[] 	= $morning.'<span class="greet"> おはようございます, '.$uname.' さん</span>';
				break;
			case ($daily[0] >= '00:00' && $daily[0] < '12:00' && $daily[1] == 'he'):
				$msg[] 	= $morning.'<span class="greet"> בוקר טוב, '.$uname.'</span>';
				break;
			// afternoon
			case ($daily[0] >= '12:00' && $daily[0] < '18:00' && $daily[1] == 'en'):
				$msg[] 	= $afternoon.'<span class="greet"> Good Afternoon, '.$uname.'</span>';
				break;
			case ($daily[0] >= '12:00' && $daily[0] < '18:00' && $daily[1] == 'ja'):
				$msg[] 	= $afternoon.'<span class="greet"> こんにちは, '.$uname.' さん</span>';
				break;
			case ($daily[0] >= '12:00' && $daily[0] < '18:00' && $daily[1] == 'he'):
				$msg[] 	= $afternoon.'<span class="greet"> ערב טוב, '.$uname.'</span>';
				break;
			// evening
			case ($daily[0] >= '18:00' && $daily[0] < '23:59' && $daily[1] == 'en'):
				$msg[] 	= $night.'<span class="greet"> Good Night, '.$uname.'</span>';
				break;
			case ($daily[0] >= '18:00' && $daily[0] < '23:59' && $daily[1] == 'ja'):
				$msg[] 	= $night.'<span class="greet"> お休みなさい, '.$uname.' さん</span>';
				break;
			case ($daily[0] >= '18:00' && $daily[0] < '23:59' && $daily[1] == 'he'):
				$msg[] 	= $night.'<span class="greet"> לילה טובה, '.$uname.'</span>';
				break;

			default:
				$msg[] 	= 'Welcome, '.$uname.' ';
				break;
		}

		// greet annualy
		if ($annual[0] == '12-31') {

			switch ($annual) {
				case ($annual[0] >= '12-31' && $annual[0] < '01-03' && $annual[1] == 'en'):
					$msg[] 	= 'Happy New Year, '.$uname.' ';
					break;
				case ($annual[0] >= '12-31' && $annual[0] < '01-03' && $annual[1] == 'ja'):
					$msg[] 	= '新年明けおめでとうございます, '.$uname.' さん';
					break;
				case ($annual[0] >= '12-31' && $annual[0] < '01-03' && $annual[1] == 'he'):
					$msg[] 	= 'שנה טובה, '.$uname.' ';
					break;
				// default:
				// 	$msg[] 	= 'Welcome, '.$uname.' ';
				// 	break;
			}

		}

		foreach ($msg as $greet) {
			return $greet;
		}

	}else{
		$msg[] 	= 'Welcome, Admin';
	}

}

// =================================
	//  get attachments file function v1.0 //
// =================================
function get_attachments() {
	global $pdo;
	include_once 'attachments.php';
}
// =================================
	// get the custom user_type when admin creating new user account by group_id v1.0 //
// =================================
function handle_group_id() {
	if(isset($_POST['group_id']) && $_POST['group_id'] == 1) {
		$do = 'admin';
	}elseif (isset($_POST['group_id']) && $_POST['group_id'] == 2) {
		$do = 'publisher';
	}else {
		$do = 'user';
	}

	return $do;
}
// =================================
	// units format function v1.0 //
// =================================

function format_size($size) {
    $mod = 1024;
    $units = explode(' ','B KB MB GB TB PB');
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }
    return round($size, 2) . ' ' . $units[$i];
}
// =================================
	// post views function v1.0 //
// =================================
function post_views($views) {

	$counter = isset($views) && $views > 0 ? $views : 'No Views Yet';

	return $counter;
}

// =================================
//  post likes function v1.0 //
// =================================
function post_likes($likes='') {

	$action = isset($likes) && !empty($likes) && $likes > 0 ? $likes : 'No likes action';

	return $action;
}

// =================================
//  dislikes function v1.0 //
// =================================
function post_dislikes($dislikes='') {

	$action = isset($dislikes) && !empty($dislikes) && $dislikes > 0 ? $dislikes : 'No dislikes action';

	return $action;
}
