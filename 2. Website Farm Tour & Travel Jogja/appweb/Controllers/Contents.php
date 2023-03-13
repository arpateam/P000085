<?php

	if($_GET['module']=='home') { 
		include("appweb/Views/homes.php");
	}
	else{
		echo "<script>window.location = '404';</script>";
	}

?>