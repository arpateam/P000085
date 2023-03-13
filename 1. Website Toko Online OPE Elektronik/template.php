<?php
    error_reporting(0);
    require "appweb/Config/SetWebsite.php";
    require "appweb/Config/Db.php";
    require "appweb/Config/AssetsWebsite.php";
    require "appweb/Functions/others.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <?php require "appweb/Controllers/SEO_v6.php"; ?>

    <link rel="icon" type="image/x-icon" href="<?= $url_images; ?>/<?= $icon; ?>" />

    <link rel="stylesheet" href="<?= $base_url; ?>/assets/css/bootstrap.css">

    <!--Plugins -->
    <style>@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');</style>
    <link href="<?= $base_url; ?>/assets/plugins/fontawesome-6.0.0/css/all.css" rel="stylesheet">
    <link href="<?= $base_url; ?>/assets/plugins/aos/dist/aos.css" rel="stylesheet">
    <link href="<?= $base_url_admin ?>/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_url_admin ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_url_admin ?>/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= $base_url_admin ?>/assets/libs/validation-pass-arpateam/css/style.css">
    <!--End Plugins -->
    <base href="<?= $base_url; ?>/">
</head>
<body>

    <div class="container-fluid px-0">
        <?php require "appweb/Models/Header.php"; ?>
        <?php require "appweb/Controllers/Contents.php"; ?>
        <?php require "appweb/Models/Footer.php"; ?>
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
                    document.getElementById("navbar_top").classList.add("fixed-top");

                    document.getElementById("navbar_brand").classList.add("navbar-brand-50");
                    document.getElementById("navbar_brand").classList.remove("navbar-brand-75");

                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector(".navbar").offsetHeight;
                    document.body.style.paddingTop = navbar_height + "px";
                } else {
                    document.getElementById("navbar_top").classList.remove("fixed-top");

                    document.getElementById("navbar_brand").classList.remove("navbar-brand-50");
                    document.getElementById("navbar_brand").classList.add("navbar-brand-75");

                    // remove padding top from body
                    document.body.style.paddingTop = "0";
                } 
            });
        });

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
    </script>

    <!-- Plugins -->
        <script src="<?= $base_url ?>/assets/libs/parsleyjs/parsley.min.js"></script>
        <script src="<?= $base_url ?>/assets/js/pages/form-validation.init.js"></script>
        <script src="<?= $base_url_admin ?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?= $base_url; ?>/assets/plugins/clipboard/clipboard.min.js"></script>
        <script type="text/javascript">
            var clipboard = new ClipboardJS('#copyLink');

            clipboard.on('success', function(e) {
                Swal.fire(
                    'Disalin!',
                    'URL telah disalin!!',
                    'success'
                )
            });
        </script>

        <script src="<?= $base_url_admin; ?>/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?= $base_url_admin; ?>/assets/js/pages/gallery.init.js"></script>
    <!--End Plugins -->
</body>
</html>