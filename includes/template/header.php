<?php
	include 'includes/functions/functions.php';
	include 'models/postsmodel.php';

	// ============================
	if (isset($_SESSION['id'])) {
		$se_id = $_SESSION['id'];

	    $theme = $pdo->prepare("SELECT * FROM admin_theme_option WHERE user_id = ?");
	    $theme->execute(array($se_id));
	    $throw = $theme->rowCount();

	    if ($throw > 0) {
	    	$op = $theme->fetch(PDO::FETCH_ASSOC);
	    	
	    }
	}
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8" /><!--<?php //bloginfo( 'charset' ); ?> -->
	<meta http-equiv="X-UA-Compatible" content="text/html,IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
	<meta name="HandheldFriendly" content="true">
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<title><?php if(function_exists(title())) title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php //if ( is_singular() && pings_open( get_queried_object() ) ): ?>
	<link rel="pingback" href="<?php //bloginfo('pingback_url'); ?>"/>
	<?php //endif; ?>
	<link rel="shortcut icon" href=""> <!-- 4wp <?php // = esc_attr( get_option('fav_icon') ); print ; ?> -->
 <!-- New iOS7 Sizes -->
<!--    <link rel="apple-touch-icon" href="<?php //echo esc_url( get_template_directory_uri() ); ?>/img/favicons/logo-icon-76x76.png" sizes="76x76">
 <link rel="apple-touch-icon" href="<?php //echo esc_url( get_template_directory_uri() ); ?>/img/favicons/logo-icon-120x120.png" sizes="120x120">
 <link rel="apple-touch-icon" href="<?php //echo esc_url( get_template_directory_uri() ); ?>/img/favicons/logo-icon-152x152.png" sizes="152x152">-->
 <!-- Metro Tiles -->
<!--    <meta name="msapplication-TileColor" content="#d25353">
 <meta name="msapplication-TileImage" content="<?php //echo esc_url( get_template_directory_uri() ); ?>/img/favicons/logo-icon-152x152.png">-->
 	<meta name="keywords" content="personal,design,web,web design,designs,site,website,slick,slick web design,new,unique,fun,fresh design," />
	<meta name="description" content="next generation of web design" />
	<meta name="author" content="AHMED SALAH" />

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" type="text/css" href="style/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/summernote.css">
	<link rel="stylesheet" type="text/css" href="style/css/admin.css">

	<!-- <script type="text/javascript" src="style/js/jquery-3.1.0.min.js"></script> -->


</head>
<body>
