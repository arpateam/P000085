<?php

    session_start();
    // error_reporting(0);
    require "../../../../appweb/Config/Db.php";
    require "../../../../appweb/Config/AssetsWebsite.php";
    require "../../../../appweb/Config/SetWebsite.php";

    if (empty($_SESSION['_session__'])) {
        header("location: $base_url_admin/keluar-admin");
        die();
        exit();
    }elseif((isset($_POST['_submit_special_ARPATEAM_']) OR ($_GET['act']==="delete-sitemap"))){
        require '../Libraries/others.php';
        // require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-sitemap":

                $id_sub_sitemap = $_POST['___in_id_sub_sitemap_special_ARPATEAM'];
                $slug           = $_POST['___in_slug_special_ARPATEAM'];

                // Data file
                $link       = "$base_url_admin/sitemap/$slug";
                $database   = "sitemap";
                // Data file

                $loc        = $_POST['___in_loc_special_ARPATEAM'];
                $priority   = $_POST['___in_priority_special_ARPATEAM'];

                tambahSitemap($database, $id_sub_sitemap, $loc, $priority, $link);

                if ($count>0) {
                    $_SESSION['_msg__'] = 'Berhasil';
                    header("Location: $link");
                    die();
                    exit();
                }

                break;

            case "edit-sitemap":

                $id_sub_sitemap = $_POST['___in_id_sub_sitemap_special_ARPATEAM'];
                $slug           = $_POST['___in_slug_special_ARPATEAM'];
                $id_sitemap     = $_POST['___in_id_sitemap_special_ARPATEAM'];

                // Data file
                $link       = "$base_url_admin/sitemap/$slug";
                // $penyimpananGambar  = "$base_url/assets/files/images/sitemap";
                // $penyimpananGambar  = "../../../../assets/files/images/sitemap";
                $database   = "sitemap";
                // Data file

                $loc        = $_POST['___in_loc_special_ARPATEAM'];
                $priority   = $_POST['___in_priority_special_ARPATEAM'];

                editSitemap($database, $id_sitemap, $id_sub_sitemap, $loc, $priority, $link);

                if ($count>0) {
                    $_SESSION['_msg__'] = 'Berhasil';
                    header("Location: $link");
                    die();
                    exit();
                }

                break;

            case "delete-sitemap":

                $id_sitemap = $_GET['id'];
                $slug       = $_GET['slug'];

                // Data file
                $link       = "$base_url_admin/sitemap/$slug";
                // $penyimpananGambar  = "$base_url/assets/files/images/sitemap";
                // $penyimpananGambar  = "../../../../assets/files/images/sitemap";
                $database   = "sitemap";
                // Data file

                hapusSitemap($database, $id_sitemap);

                if ($count>0) {
                    $_SESSION['_msg__'] = 'Berhasil';
                    header("Location: $link");
                    die();
                    exit();
                }

                break;

            default:
                header("location: $base_url_admin/keluar-edit");
                die();
                exit();
        }
    }else{
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }