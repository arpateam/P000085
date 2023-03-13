<?php
    // error_reporting(0);
    require "appweb/Config/SetWebsite.php";
    require "appweb/Config/AssetsWebsite.php";
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
    
    <!-- Google Analytics -->
        
    <!-- Google Analytics -->

    <!-- Tempat verivikasi search console -->
        
    <!-- Tempat verivikasi search console -->

    <!-- Primary Meta Tags -->
    <title><?= $nama_web; ?> - <?= $slogan; ?></title>
    <meta name="title" content="<?= $nama_web; ?> - <?= $slogan; ?>">
    <meta name="keywords" content="<?= $nama_web; ?> - <?= $slogan; ?>. <?= $description; ?>">
    <meta name="description" content="<?= $nama_web; ?> - <?= $slogan; ?>. <?= $description; ?>">

    <link rel="icon" type="image/x-icon" href="<?= $url_images; ?>/<?= $icon; ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?= $url_images; ?>/<?= $logoDesktop ?>">
    <meta property="og:title" content="<?= $nama_web; ?> - <?= $slogan; ?>">
    <meta property="og:description" content="<?= $nama_web; ?> - <?= $slogan; ?>. <?= $description; ?>">
    <meta property="og:url" content="<?= $base_url; ?>">
    <meta property="og:site_name" content="<?= $nama_web; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="<?= $nama_web; ?>" />
    <meta property="twitter:url" content="<?= $base_url; ?>">
    <meta property="twitter:title" content="<?= $nama_web; ?>">
    <meta property="twitter:description" content="<?= $nama_web; ?> - <?= $slogan; ?>. <?= $description; ?>">
    <meta property="twitter:image" content="<?= $url_images; ?>/<?= $logoDesktop ?>">
        
    <link rel="canonical" href="<?= $base_url; ?>">
    <link rel="shortlink" href="<?= $short_url; ?>">

    <link rel="stylesheet" href="<?= $base_url; ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $base_url; ?>/assets/css/style.css">

    <!--Plugins -->
        <style>@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');</style>
        <link href="<?= $base_url; ?>/assets/plugins/fontawesome-6.0.0/css/all.css" rel="stylesheet">
        <link href="<?= $base_url; ?>/assets/plugins/aos/dist/aos.css" rel="stylesheet">

        <link href="<?= $base_url; ?>/assets/plugins/slick/slick.min.css" rel="stylesheet">
        <link href="<?= $base_url; ?>/assets/plugins/slick/slick-theme.min.css" rel="stylesheet">
    <!--End Plugins -->
</head>
<body>

    <div class="container-fluid px-0">
        <?php require "appweb/Models/Menu.php"; ?>
        <?php require "appweb/Models/Header.php"; ?>
        <?php require "appweb/Controllers/Contents.php"; ?>
        <?php require "appweb/Models/Footer.php"; ?>
    </div>

    <a href="javascript:" id="return-to-top" class="link-warning"><i class="fa-solid fa-angle-up"></i></a>

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
                    document.getElementById("navbar_brand").classList.remove("navbar-brand-60");

                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector(".navbar").offsetHeight;
                    document.body.style.paddingTop = navbar_height + "px";
                } else {
                    document.getElementById("navbar_top").classList.remove("fixed-top", "shadow-sm");
                    document.getElementById("navbar_top").classList.add("sticky-top");

                    document.getElementById("navbar_brand").classList.remove("navbar-brand-45");
                    document.getElementById("navbar_brand").classList.add("navbar-brand-60");

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

        <!-- Slick JS Home -->
            <script src="<?= $base_url; ?>/assets/plugins/slick/slick.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    // klien kami
                        $('.klien-kami').slick({
                            dots: false ,
                            slidesToShow: 9,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            autoplay: true,
                            autoplaySpeed: 1000,
                            pauseOnHover: true,
                            responsive: [
                            {
                                breakpoint: 1100,
                                settings: {
                                    slidesToShow: 7,
                                }
                            },{
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 6,
                                }
                            },{
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 5,
                                }
                            },{
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 4,
                                }
                            }
                            ]
                        });
                    // klien kami
                    // portofolio kami
                        $('.portofolio-kami').slick({
                            dots: false ,
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            autoplay: true,
                            autoplaySpeed: 1000,
                            pauseOnHover: true,
                            responsive: [
                            {
                                breakpoint: 1100,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },{
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },{
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 2,
                                }
                            },{
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 2,
                                }
                            }
                            ]
                        });
                    // portofolio kami
                });
            </script>
        <!-- Slick JS Home -->
    <!--End Plugins -->
</body>
</html>