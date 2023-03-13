<?php

	if($_GET['module']=='beranda') { 
		include("appweb/Views/beranda.php");
	}elseif($_GET['module']=='produk') { 
		include("appweb/Views/produk.php");
	}elseif($_GET['module']=='kontak-kami') { 
		include("appweb/Views/kontak-kami.php");
	}else{
		echo "<script>window.location = '404';</script>";
	}

?>