<?php
	// get param
	$file_name	= $_GET['file_nm'];

	// file route
	$fileRoute	= "../../../../assets/files/others/HandleByFroala/";
	unlink($fileRoute.$file_name);
?>