<?php 
	header('Access-Control-Allow-Origin: *');
	date_default_timezone_set('Africa/Cairo');
	$date 		= date('d/m/Y').' <span class="glyphicon glyphicon-time" style="color:#ead920;"></span> '.date('h:i:s A');
	$calendar 	= file_get_contents('../../style/fonts/svg/calendar_time.svg');
	echo $calendar.' '.'<span style="color:#00fa9a;">'.$date.'</span>';

?>