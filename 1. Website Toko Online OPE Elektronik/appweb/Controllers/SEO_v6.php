<?php

	if(($_GET['module']=='beranda') OR ($_GET['module']=='produk' AND $_GET['act']=='list') OR ($_GET['module']=='kontak-kami')){
		$tseo 	= $pdo->query("SELECT img_share, slug, title, keyword, description FROM page WHERE id_page='$_GET[id]'");
		$seo 	= $tseo->fetch(PDO::FETCH_ASSOC);
		
		$title 			= "$seo[title]";
		$keyword 		= "$seo[keyword]";
		$description 	= "$seo[description]";
		
		$imageshare	= "$url_images/pages/$seo[img_share]";
		$urlshare 	= $base_url."/".$seo["slug"];
	}elseif($_GET['module']=='produk' AND $_GET['act']=='kategori'){
		$Detail		= $pdo->query("SELECT judul, gambar, slug, keyword, description FROM kat_produk WHERE slug='$_GET[slug]'");
		$tDetail 	= $Detail->fetch(PDO::FETCH_ASSOC);

		$title 			= "$tDetail[judul]";
		$keyword 		= "$tDetail[keyword]";
		$description 	= "$tDetail[description]";
		
		$imageshare	= "$url_images/kat-produk/$tDetail[gambar]";
		$urlshare 	= "$base_url/kat-produk/$tDetail[slug]";
	}elseif($_GET['module']=='produk' AND $_GET['act']=='read'){
		$Detail		= $pdo->query("SELECT judul, gambar, slug, keyword, description FROM produk WHERE slug='$_GET[slug]'");
		$tDetail 	= $Detail->fetch(PDO::FETCH_ASSOC);

		$title 			= "$tDetail[judul]";
		$keyword 		= "$tDetail[keyword]";
		$description 	= "$tDetail[description]";
		
		$imageshare	= "$url_images/produk/$tDetail[gambar]";
		$urlshare 	= "$base_url/produk/$tDetail[slug]";
	}else{
		$tseo = $pdo->query("SELECT title, keyword, description FROM page WHERE id_page='0'");
		$seo = $tseo->fetch(PDO::FETCH_ASSOC);

		$title = "$seo[title]";
		$keyword = "$seo[keyword]";
		$description = "$seo[description]";
		
		$imageshare = "assets/images/default-share.jpg";
		$urlshare = $base_url;
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

	<!-- Tempat verivikasi search console -->
		<!-- index ke google, bing & yahoo saja -->
	<!-- Tempat verivikasi search console -->

	<!-- Primary Meta Tags -->
	<title><?= $title; ?></title>
	<meta name="title" content="<?= $title; ?>">
	<meta name="keywords" content="<?= $keyword; ?>">
	<meta name="description" content="<?= $description; ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $urlshare; ?>">
	<meta property="og:title" content="<?= $title; ?>">
	<meta property="og:description" content="<?= $description; ?>">
	<meta property="og:image" content="<?= $base_url; ?>/<?= $imageshare; ?>">
	<meta property="og:image:alt" content="Gambar <?= $title; ?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:site" content="<?= $nama_web; ?>" />
	<meta property="twitter:url" content="<?= $urlshare; ?>">
	<meta property="twitter:title" content="<?= $title; ?>">
	<meta property="twitter:description" content="<?= $description; ?>">
	<meta property="twitter:image" content="<?= $base_url; ?>/<?= $imageshare; ?>">
	<meta property="og:site_name" content="<?= $nama_web; ?>">
		
	<link rel="canonical" href="<?= $urlshare; ?>">
	<link rel="shortlink" href="<?= $short_url; ?>">