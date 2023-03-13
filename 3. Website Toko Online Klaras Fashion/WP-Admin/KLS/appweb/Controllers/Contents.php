<?php

	switch ($_SESSION['_level__']) {
		case 'Administrator':

			if($_GET['module']=='dashboard') { 
				include("appweb/Views/dashboard.php");
			}

			elseif($_GET['module']=='produk') { 
				include("appweb/Views/produk.php");
			}

			elseif($_GET['module']=='metode-pembayaran') { 
				include("appweb/Views/paymentmethod.php");
			}elseif($_GET['module']=='blog') { 
				include("appweb/Views/blog.php");
			}

			elseif($_GET['module']=='halaman') { 
				include("appweb/Views/pages.php");
			}elseif($_GET['module']=='pengaturan') { 
				include("appweb/Views/settings.php");
			}elseif($_GET['module']=='sitemap') { 
				include("appweb/Views/sitemap.php");
			}elseif($_GET['module']=='pegawai') { 
				include("appweb/Views/employee.php");
			}else{
				echo "<script>window.location = '404';</script>";
			}

			break;
	}

?>