<?php
// grab page filename
$title = basename( $_SERVER['SCRIPT_FILENAME'], '.php' );
// replace dashes with spaces
$title = str_replace( '-', ' ', $title );
// check if home page
if( $title == 'index' )
	// if home page, change name from index to home
	$title = 'home';
// capitilize
$title = ucwords( $title );
?>