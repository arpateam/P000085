<?php

	if($_GET['module']=='home') { 
		include("appweb/Views/homes.php");
	}elseif($_GET['module']=='produk') { 
		include("appweb/Views/produk.php");
	}elseif($_GET['module']=='pages') { 
		include("appweb/Views/pages.php");
	}elseif($_GET['module']=='blog') { 
		include("appweb/Views/blog.php");
	}else{
		echo "<script>window.location = '404';</script>";
	}

?>