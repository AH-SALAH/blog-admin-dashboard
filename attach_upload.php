<?php
	
	if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])){
    	$id = $_SESSION['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
                $file_check = check_input($_FILES['file']['name']);
                $upload_dir = dirname(__FILE__).'/uploads/gallery/';
                $extensions = array("jpeg","jpg","png","gif");
                $file_name 	= basename($file_check);
                $tmp        = $_FILES['file']['tmp_name'];
                $type       = $_FILES['file']['type'];
                $size       = $_FILES['file']['size'];
                $error      = $_FILES['file']['error'];
                $fullpath   = $upload_dir.$file_name;
                $check_img  = getimagesize($tmp);
                $mime       = $check_img['mime'];
                $file_ext   = pathinfo($fullpath, PATHINFO_EXTENSION);
                $date       = date('Y-m-d--H-i-s');
                // echo $file_name.'<br>'.$fullpath.'<br>'.$file_ext.'<br>'.$upload_dir.'<br> middle'.$error;
                // var_dump($size);

                
			    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $tmp)) { // Sanitize input
			        header("HTTP/1.0 500 Invalid file name.");
			        return;
			    }elseif (!in_array(strtolower($file_ext), $extensions)) { //check for allowed img extentions
                    $err[]  = '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><span style="color:#cd5c5c;"> sorry,images only allowed..!</span>';
                }elseif ($mime == false) { //check for type img
                    $err[]  = '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><span style="color:#cd5c5c;"> sorry,you can upload only images..!</span>';
                }elseif ($size > 1000000) { //check for allowed file size
                    $err[]  = '<span class="glyphicon glyphicon-warning-sign" style="color:#cd5c5c;"></span><span style="color:#cd5c5c;"> sorry,image size exceeds max file size upload..!</span>';
                }else{

                    if (file_exists($fullpath)) { //check if file already exists
                        $namae      = pathinfo($fullpath, PATHINFO_FILENAME); //get file name
                        $file_name  = $namae.'_'.$date.'.'.$file_ext; //rename with the same name + dateTime for uniqueness
                    }

                    if (mb_check_encoding($file_name,'UTF-8') == false){
                    	$file_name  = rename($file_name, 'file_'.$date.'.'.$file_ext);
                    }

                    $fullpath   = $upload_dir.$file_name;
                    $move       = move_uploaded_file($tmp, $fullpath); //move the file

                    if ($move) {

                        $q      = $pdo->prepare("INSERT INTO attachments(user_id,attach_name,attach_date) VALUES (?,?,now()) ");
                        $q->bindValue(1,$id);
                        // $q->bindValue(2,null);
                        $q->bindValue(2,$file_name);
                        // $q->bindValue(3,null);
                        $q->execute();

                        $success  = '<span class="glyphicon glyphicon-ok" style="color:green;"></span><span style="color:green;"> file uploaded successfully..</span>';
                        echo $success;


                    }

                }

            }

            $q = null;

        }else{
	        header('location:index.php');
	        exit;
		}

    }else{
	        header('location:index.php');
	        exit;
	}


?>

<!-- ====================================== -->
