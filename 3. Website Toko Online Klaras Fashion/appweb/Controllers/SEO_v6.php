<?php

	if(($_GET['module']=='home') OR ($_GET['module']=='produk' AND $_GET['view']=="new-arrivals") OR ($_GET['module']=='produk' AND $_GET['view']=="best-seller") OR ($_GET['module']=='produk' AND $_GET['view']=="sale") OR ($_GET['module']=='produk' AND $_GET['view']=="all-products") OR ($_GET['module']=='produk' AND $_GET['view']=="list-category") OR ($_GET['module']=='pages' AND $_GET['view']=="how-to-order") OR ($_GET['module']=='pages' AND $_GET['view']=="payment-method") OR ($_GET['module']=='pages' AND $_GET['view']=="about-us") OR ($_GET['module']=='blog' AND $_GET['view']=="list")){
		$tseo 	= $pdo->query("SELECT judul, gambar, img_share, deskripsi, slug, title, keyword, description FROM page WHERE id_page='$_GET[id]'");
		$seo 	= $tseo->fetch(PDO::FETCH_ASSOC);
		
		$title 			= "$seo[title]";
		$keyword 		= "$seo[keyword]";
		$description	= "$seo[description]";
		
		$imageshare	= "$url_images/pages/$seo[img_share]";
		$urlshare 	= $base_url."/".$seo["slug"];
		$share_short_url	= $base_url."/".$seo["slug"];
	}elseif($_GET['module']=='produk' AND $_GET['view']=="detail-category"){
		try {
			$Detail = $pdo->prepare("
                SELECT
                    judul, gambar, slug, title, keyword, description
                FROM kat_produk
                WHERE slug = ?
	        ");

	        $Detail->bindValue(1, $_GET['slug']);
	        $Detail->execute();
	        $rowsDetail	= $Detail->rowCount();

	        if ($rowsDetail>0) {
	        	$tDetail = $Detail->fetch(PDO::FETCH_ASSOC);

	        	$title 			= "$tDetail[title]";
				$keyword 		= "$tDetail[keyword]";
				$description 	= "$tDetail[description]";
				
				$imageshare	= "$url_images/category/$tDetail[gambar]";
				$urlshare 	= "$base_url/category/$tDetail[slug]";
				$share_short_url	= $base_url."/category/$tDetail[slug]";
	        }else{
	            echo "<script>window.location.href = '$base_url/404';</script>";
	            die();
	            exit();
	        }
		} catch (Exception $e) {
			echo "<script>window.location.href = '$base_url/404';</script>";
	        die();
	        exit();
		}
	}elseif($_GET['module']=='produk' AND $_GET['view']=="search"){
		$tseo 	= $pdo->query("SELECT judul, gambar, img_share, deskripsi, slug, title, keyword, description FROM page WHERE id_page='1'");
		$seo 	= $tseo->fetch(PDO::FETCH_ASSOC);
		
		$title 			= "Cari Produk ".$_POST['query']." di ".$nama_web;
		$keyword 		= "Cari Produk ".$_POST['query']." di ".$nama_web." $seo[keyword]";
		$description	= "Cari Produk ".$_POST['query']." di ".$nama_web." $seo[description]";
		
		$imageshare			= "$url_images/pages/$seo[img_share]";
		$urlshare 			= $base_url."/".$seo["slug"];
		$share_short_url	= $base_url."/".$seo["slug"];
	}elseif($_GET['module']=='produk' AND $_GET['view']=="detail"){
		try {
			$Detail = $pdo->prepare("
                SELECT
                    judul, gambar, slug, title, keyword, description
                FROM produk
                WHERE slug = ?
	        ");

	        $Detail->bindValue(1, $_GET['slug']);
	        $Detail->execute();
	        $rowsDetail	= $Detail->rowCount();

	        if ($rowsDetail>0) {
	        	$tDetail = $Detail->fetch(PDO::FETCH_ASSOC);

	        	$title 			= "$tDetail[title]";
				$keyword 		= "$tDetail[keyword]";
				$description 	= "$tDetail[description]";
				
				$imageshare	= "$url_images/product/$tDetail[gambar]";
				$urlshare 	= "$base_url/product/$tDetail[slug]";
				$share_short_url	= $base_url."/product/$tDetail[slug]";
	        }else{
	            echo "<script>window.location.href = '$base_url/404';</script>";
	            die();
	            exit();
	        }
		} catch (Exception $e) {
			echo "<script>window.location.href = '$base_url/404';</script>";
	        die();
	        exit();
		}
	}elseif($_GET['module']=='blog' AND $_GET['view']=="detail"){
		try {
			$Detail = $pdo->prepare("
                SELECT
                    judul, gambar, slug, keyword, description
                FROM blog
                WHERE slug = ?
	        ");

	        $Detail->bindValue(1, $_GET['slug']);
	        $Detail->execute();
	        $rowsDetail	= $Detail->rowCount();

	        if ($rowsDetail>0) {
	        	$tDetail = $Detail->fetch(PDO::FETCH_ASSOC);

	        	$title 			= "$tDetail[judul]";
				$keyword 		= "$tDetail[keyword]";
				$description 	= "$tDetail[description]";
				
				$imageshare	= "$url_images/blog/small/$tDetail[gambar]";
				$urlshare 	= "$base_url/blog/$tDetail[slug]";
				$share_short_url	= $base_url."/blog/$tDetail[slug]";
	        }else{
	            echo "<script>window.location.href = '$base_url/404';</script>";
	            die();
	            exit();
	        }
		} catch (Exception $e) {
			echo "<script>window.location.href = '$base_url/404';</script>";
	        die();
	        exit();
		}
	}else{
		$tseo 	= $pdo->query("SELECT judul, gambar, img_share, deskripsi, slug, title, keyword, description FROM page WHERE id_page='1'");
		$seo 	= $tseo->fetch(PDO::FETCH_ASSOC);
		
		$title 			= "$seo[title]";
		$keyword 		= "$seo[keyword]";
		$description	= "$seo[description]";
		
		$imageshare			= "$url_images/pages/$seo[img_share]";
		$urlshare 			= $base_url."/".$seo["slug"];
		$share_short_url	= $base_url."/".$seo["slug"];
	}

?>

	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">

	<meta name="googlebot" content="index,follow">
	<meta name="googlebot-news" content="index,follow">
	<meta name="robots" content="index,follow">
	<meta name="Slurp" content="all">
	
	<!-- Google Analytics -->
    	<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135660008-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
        
            gtag('config', 'UA-135660008-1');
        </script>
	<!-- Google Analytics -->


	<!-- Tempat verivikasi search console -->
		<!-- index ke google, bing & yahoo saja -->
		<meta name="google-site-verification" content="DIxUpRUS0jSfrwtNJwzmtpiqewKFYCPq4_vG4AQ8irY" />
	<!-- Tempat verivikasi search console -->

	<!-- Primary Meta Tags -->
	<title><?= $title; ?></title>
	<meta name="title" content="<?= $title; ?>">
	<meta name="keywords" content="<?= $keyword; ?>">
	<meta name="description" content="<?= $description; ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="article">
	<meta property="og:image" content="<?= $imageshare; ?>">
	<meta property="og:title" content="<?= $title; ?>">
	<meta property="og:description" content="<?= $description; ?>">
	<meta property="og:url" content="<?= $urlshare; ?>">
	<meta property="og:site_name" content="<?= $nama_web; ?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:site" content="<?= $nama_web; ?>" />
	<meta property="twitter:url" content="<?= $urlshare; ?>">
	<meta property="twitter:title" content="<?= $title; ?>">
	<meta property="twitter:description" content="<?= $description; ?>">
	<meta property="twitter:image" content="<?= $imageshare; ?>">
		
	<link rel="canonical" href="<?= $urlshare; ?>">
	<link rel="shortlink" href="<?= $share_short_url; ?>">