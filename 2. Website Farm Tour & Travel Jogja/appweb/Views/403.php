<?php
    // error_reporting(0);
    require "../../appweb/Config/SetWebsite.php";
    require "../../appweb/Config/Db.php";
    require "../../appweb/Config/AssetsWebsite.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
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

    <!-- Primary Meta Tags -->
    <title>Ups, Anda Menemukan 404 - Niagahoster</title>
    <meta name="title" content="Ups, Anda Menemukan 404 - Niagahoster">
    <meta name="keywords" content="#ARPATEAM - Solusi Pendukung UMKM di Era Digital">
    <meta name="description" content="#ARPATEAM - Solusi Pendukung UMKM di Era Digital">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $short_url; ?>">
    <meta property="og:title" content="Ups, Anda Menemukan 404 - Niagahoster">
    <meta property="og:description" content="#ARPATEAM - Solusi Pendukung UMKM di Era Digital">
    <meta property="og:image" content="<?= $base_url; ?>/<?= $judulLogoDesktop; ?>">
    <meta property="og:image:alt" content="Gambar Ups, Anda Menemukan 404 - Niagahoster">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="<?= $nama_web; ?>" />
    <meta property="twitter:url" content="<?= $short_url; ?>">
    <meta property="twitter:title" content="Ups, Anda Menemukan 404 - Niagahoster">
    <meta property="twitter:description" content="#ARPATEAM - Solusi Pendukung UMKM di Era Digital">
    <meta property="twitter:image" content="<?= $base_url; ?>/<?= $judulLogoDesktop; ?>">
    <meta property="og:site_name" content="<?= $nama_web; ?>">
        
    <link rel="canonical" href="<?= $short_url; ?>">
    <link rel="shortlink" href="<?= $short_url; ?>">

    <link rel="icon" type="image/x-icon" href="<?= $url_images; ?>/<?= $icon; ?>" />

    <link rel="stylesheet" href="<?= $base_url; ?>/assets/css/bootstrap.css">

    <!--Plugins -->
    <style>@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');</style>
    <link href="<?= $base_url; ?>/assets/plugins/fontawesome-6.0.0/css/all.css" rel="stylesheet">
    <link href="<?= $base_url; ?>/assets/plugins/aos/dist/aos.css" rel="stylesheet">
    <!--End Plugins -->
    <base href="<?= $base_url; ?>/">
</head>
<body>

    <div class="container-fluid py-5 text-center">
    	<div class="row justify-content-center">
    		<div class="col-10 col-md-9 col-lg-6 col-xl-5">
        		<img src="https://niagaspace.sgp1.cdn.digitaloceanspaces.com/www/assets/images/2022/arunika/img-404-arunika-1644462240.svg" alt="Gambar Halaman 404 #ARPATEAM" class="img-fluid mb-5">
        		<h2 class="fw-bolder">Maaf, Website yang Anda Cari Tidak Tersedia</h2>
        		<p class="text-muted">Saat ini, Anda mengalami masalah teknis. Halaman yang Anda cari tidak dapat ditemukan. Anda dapat kembali ke halaman utama atau hubungi Customer Support kami untuk mendapatkan informasi lebih lanjut.</p>
        		<a href="<?= $base_url ?>" title="Halaman Utama #ARPATEAM" class="btn btn-warning rounded-pill">Kembali ke Halaman Utama</a>
    		</div>
    	</div>
    </div>


    <a href="javascript:" id="return-to-top"><i class="fa-solid fa-angle-up"></i></a>

    <script src="<?= $base_url; ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= $base_url; ?>/assets/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
        // Popover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        // Popover

        // ===== Scroll to Top ==== 
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200);    // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200);   // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function() {      // When arrow is clicked
            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        });
        // ===== Scroll to Top ====

        document.addEventListener("DOMContentLoaded", function(){
            // make it as accordion for smaller screens
            if (window.innerWidth > 992) {
                document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){
                    everyitem.addEventListener('mouseover', function(e){
                        let el_link = this.querySelector('a[data-bs-toggle]');
                        if(el_link != null){
                            let nextEl = el_link.nextElementSibling;
                            el_link.classList.add('show');
                            nextEl.classList.add('show');
                        }
                    });
                    everyitem.addEventListener('mouseleave', function(e){
                        let el_link = this.querySelector('a[data-bs-toggle]');
                        if(el_link != null){
                            let nextEl = el_link.nextElementSibling;
                            el_link.classList.remove('show');
                            nextEl.classList.remove('show');
                        }
                    })
                });
            }
            // end if innerWidth

            window.addEventListener("scroll", function() {
                if (window.scrollY > 100) {
                    document.getElementById("navbar_top").classList.add("fixed-top", "shadow-sm");
                    document.getElementById("navbar_top").classList.remove("sticky-top");

                    document.getElementById("navbar_brand").classList.add("navbar-brand-45");
                    document.getElementById("navbar_brand").classList.remove("navbar-brand-50");

                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector(".navbar").offsetHeight;
                    document.body.style.paddingTop = navbar_height + "px";
                } else {
                    document.getElementById("navbar_top").classList.remove("fixed-top", "shadow-sm");
                    document.getElementById("navbar_top").classList.add("sticky-top");

                    document.getElementById("navbar_brand").classList.remove("navbar-brand-45");
                    document.getElementById("navbar_brand").classList.add("navbar-brand-50");

                    // remove padding top from body
                    document.body.style.paddingTop = "0";
                } 
            });
        }); 
        // DOMContentLoaded  end
    </script>

    <!-- Plugins -->
        <!-- Data AOS -->
        <script src="<?= $base_url; ?>/assets/plugins/aos/dist/aos.js"></script>
        <script type="text/javascript">
            AOS.init({
                once: true
            });
        </script>
        <!-- Data AOS -->
    <!--End Plugins -->
</body>
</html>