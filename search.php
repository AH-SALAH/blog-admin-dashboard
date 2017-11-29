<?php //ob_start();
	// if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
		// $id = $_SESSION['id'];
        include_once 'db.php';
        include_once 'includes/functions/functions.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['sq']) && preg_match('/[a-z-A-Z]/i', $_POST['sq'])) {
                $sq     = filter_var($_POST['sq'],FILTER_SANITIZE_STRING);
                $sq     = check_input($_POST['sq']);

        		$q 	    = $pdo->prepare("SELECT post_id,post_title,post_content FROM posts WHERE post_title LIKE '%$sq%' ");
                $q->execute();
                $rows   = $q->rowCount();
                $posts 	= $q->fetchAll(PDO::FETCH_ASSOC);

                if ($rows > 0) {
                    foreach ($posts as $key => $title) {
                        echo '<a href="dashboard.php?page_id=postdetails&post_id='.$title['post_id'].'" class="list-group-item no-border-rad">'.html_entity_decode($title['post_title']).'</a>';
                    }
                }else{
                    echo '<li class="list-group-item no-border-rad text-center text-muted">No result found.. :( </li>';
                    exit;
                }
            }
        }
	// }

    //ob_end_flush();
?>
