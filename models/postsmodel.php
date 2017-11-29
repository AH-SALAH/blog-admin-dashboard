<?php include_once './db.php';

// =============================================
// db global fetch query
function fetchAll_query($stmt=""){
	global $pdo;
	$q 		= $pdo->prepare($stmt);
	$q->execute();
	$posts 	= $q->fetchAll();
	return $posts;
}

// =============================================
// db global crud query
function crud_query($stmt="",$val){
	global $pdo;
	$q 		= $pdo->prepare($stmt);
	$arg 	= $val;
	$posts 	= $q->execute($arg);
	return $posts;
}

// =============================================
// show posts query v1.0
function show_posts($stmt="*",$table="posts",$extra=""){
	global $pdo;
	$q 		= $pdo->prepare("SELECT " .$stmt. " FROM " .$table. " " .$extra);
	$q->execute();
	$posts 	= $q->fetchAll();
	return $posts;
}

// =============================================
// total posts query v1.0
function total_posts($single="",$plural="",$stmt="*",$table="posts",$extra=""){
	global $pdo;
	$q 		= $pdo->prepare("SELECT " .$stmt. " FROM " .$table. " " .$extra);
	$q->execute();
	$rows 	= $q->rowCount();
	if (isset($single) && isset($plural)){
		return $rows <= 1 ?  $rows.' '.$single : $rows.' '.$plural;
	}else{
		return $rows;
	}
}

// =============================================
// total comments query v1.0
function total_comments($stmt="*",$table="comments",$extra=""){
	global $pdo;
	$q 		= $pdo->prepare("SELECT " .$stmt. " FROM " .$table. " " .$extra);
	$q->execute();
	$rows 	= $q->rowCount();
	return $rows;
}
// =============================================
// total post comments query v1.0
function post_comments_rows($post_id="",$single="",$plural="",$sts="*",$table="comments"){
	global $pdo;
	$q = $pdo->prepare("SELECT ".$sts." FROM ".$table." WHERE post_id = ? ORDER BY comment_num ASC ");
	$q->bindValue(1,$post_id);
	$q->execute();
	$comm_rows = $q->rowCount();

	if (isset($single) && isset($plural)){
		return $comm_rows <= 1 ? $comm_rows.' '.$single : $comm_rows.' '.$plural;
	}else{
		return $comm_rows;
	}
}

// =============================================
// total user attachments query v1.1
// v1.1 added the $query part
function user_attachments($post_id="",$single="",$plural="",$sts="*",$table="attachments"){
	global $pdo;
	if (isset($_SESSION['id'])) {
		$id = $_SESSION['id'];
	}

	$query = '';
	if (isset($_SESSION['id']) && is_numeric($_SESSION['id']) && $_SESSION['group_id'] != 1) {
		$query = 'JOIN users ON attachments.`user_id` = users.`user_id` WHERE users.`user_id` = ? ';
	}

	$q 		= $pdo->prepare("SELECT $sts FROM $table $query");
	$q->bindValue(1,$id);
	$q->execute();
	$count 	= $q->rowCount();

	if (isset($single) && isset($plural)){
		return $count <= 1 ? $count.' '.$single : $count.' '.$plural;
	}else{
		return $count;
	}
}

// =============================================
// total counter query v1.0
function total_counter($select="*",$from="",$extra=""){
	global $pdo;
	$q 		= $pdo->prepare("SELECT $select FROM $from $extra");
	$q->execute();
	$rows 	= $q->rowCount();
	return $rows;
}
// =============================================
// insert posts query
// function insert_posts($table="posts",$cols="`post_title`,`post_content`,`post_img`,`post_created_at`",$prepare="",$val=array()){
// 	global $pdo;
// 	$q 		= $pdo->prepare("INSERT INTO " .$table. " (" .$cols. ") VALUES (" .$prepare. ")");
// 	$stmt 	= $val;
// 	$posts 	= $q->execute($stmt);
// 	return $posts;
// }

// =============================================
// delete posts query
// function delete_posts($table="posts",$condition="",$val=null){
// 	global $pdo;
// 	$q 		= $pdo->prepare("DELETE FROM " .$table. " WHERE " . $condition);
// 	$stmt 	= $q->bindValue(1,$val);
// 	$posts 	= $q->execute($stmt);
// 	return $posts;
// }

// =============================================
// update posts query
// function update_posts($table="posts",$prepare="",$val="",$condition="",$count=false){
// 	global $pdo;
// 	$q 		= $pdo->prepare("UPDATE " .$table. " SET " .$prepare. " WHERE " . $condition);
// 	$stmt 	= ($count == '' || $count == undefined) ? array($val) : $count == true ? $q->bindValue($val) : '';
// 	$posts 	= $q->execute($stmt);
// 	return $posts;
// }
