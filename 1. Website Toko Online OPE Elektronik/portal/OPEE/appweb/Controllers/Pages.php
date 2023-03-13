<?php

    session_start();
    error_reporting(0);
    require "../../../../appweb/Config/Db.php";
    require "../../../../appweb/Config/AssetsWebsite.php";
    require "../../../../appweb/Config/SetWebsite.php";

    if (empty($_SESSION['_session__'])) {
        header("location: $base_url_admin/keluar-admin");
        die();
        exit();
    }elseif((isset($_POST['_submit_special_ARPATEAM_']))){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "edit":

                $slug   = $_POST['___in_slug_special_ARPATEAM'];

                // Data file
                $link               = $base_url_admin."/page/".$slug;
                $penyimpananGambar  = "../../../../assets/files/images/pages";
                $database           = "page";
                // Data file

                if (!empty($_POST['___in_deskripsi_special_ARPATEAM'])) {
                    $deskripsi  = $_POST['___in_deskripsi_special_ARPATEAM'];
                }else{
                    $deskripsi  = NULL;
                }

                $id_sitemap = htmlspecialchars($_POST['___in_id_sitemap_special_ARPATEAM']);
                $id_page    = htmlspecialchars($_POST['___in_id_page_special_ARPATEAM']);
                $judul      = $_POST['___in_judul_special_ARPATEAM'];
                $seo        = seo($judul);

                seoTitle($_POST['___in_title_special_ARPATEAM'], $judul);
                seoKeyword($_POST['___in_keyword_special_ARPATEAM'], $judul);
                seoDescription($_POST['___in_description_special_ARPATEAM'], $judul);

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = $seo.".".$tipe_file2;

                    $in_gambar_lama     = $_POST['___in_gambar_lama_special_ARPATEAM'];
                    $cariExtensiGambar  = explode(".", $in_gambar_lama);
                    $extensiGambarnya   = $cariExtensiGambar[1];

                    if (empty($nama_file)){
                        // Ubah nama gambar
                        rename("$penyimpananGambar/$in_gambar_lama", "$penyimpananGambar/$nama_file_unik$extensiGambarnya");
                        // Ubah nama gambar

                        $gambar = $nama_file_unik.$extensiGambarnya;
                    }else{
                        // Cek jenis file yang di upload
                        cekFile($tipe_file);
                        // Cek jenis file yang di upload

                        // Cek ukuran file yang di upload
                        cekUkuranFile2mb($ukuran);
                        // Cek ukuran file yang di upload

                        // Hapus gambar
                        unlink("$penyimpananGambar/$in_gambar_lama");
                        // Hapus gambar

                        // Upload gambar
                        uploadGambarAsli($nama_file_unik, $tipe_file, $lokasi_file, $lokasi_upload);
                        // Upload gambar

                        $gambar = $nama_file_unik;
                    }
                // Gambar

                // Img Share
                    $lokasi_file_img_share          = $_FILES['___in_img_share_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload_img_share        = "$penyimpananGambar/";
                    $nama_file_img_share            = $_FILES['___in_img_share_special_ARPATEAM']['name'];
                    $tipe_file_img_share            = strtolower($_FILES['___in_img_share_special_ARPATEAM']['type']);
                    $tipe_file2_img_share           = seo2($tipe_file_img_share); // ngedapetin png / jpg / jpeg
                    $ukuran_img_share               = $_FILES['___in_img_share_special_ARPATEAM']['size'];
                    $nama_file_unik_img_share       = $seo."-img-share.".$tipe_file2_img_share;

                    $in_gambar_lama_img_share       = $_POST['___in_img_share_lama_special_ARPATEAM'];
                    $cariExtensiGambar_img_share    = explode(".", $in_gambar_lama_img_share);
                    $extensiGambarnya_img_share     = $cariExtensiGambar_img_share[1];

                    if (empty($nama_file_img_share)){
                        // Ubah nama gambar
                        rename("$penyimpananGambar/$in_gambar_lama_img_share", "$penyimpananGambar/$nama_file_unik_img_share$extensiGambarnya_img_share");
                        // Ubah nama gambar

                        $img_share = $nama_file_unik_img_share.$extensiGambarnya_img_share;
                    }else{
                        // Cek jenis file yang di upload
                        cekFile($tipe_file_img_share);
                        // Cek jenis file yang di upload

                        // Cek ukuran file yang di upload
                        cekUkuranFile2mb($ukuran_img_share);
                        // Cek ukuran file yang di upload

                        // Hapus gambar
                        unlink("$penyimpananGambar/$in_gambar_lama_img_share");
                        // Hapus gambar

                        // Upload img_share
                        uploadGambarAsli($nama_file_unik_img_share, $tipe_file_img_share, $lokasi_file_img_share, $lokasi_upload_img_share);
                        // Upload img_share

                        $img_share = $nama_file_unik_img_share;
                    }
                // Img Share

                // SiteMap
                    $database_sitemap   = "sitemap";
                    $id_sub_sitemap     = 1;
                    $loc                = $base_url."/".$slug;
                    $priority           = "1.00";
                // SiteMap

                try {
                    $sql = "UPDATE $database
                            SET judul           = :judul,
                                gambar          = :gambar,
                                img_share       = :img_share,
                                deskripsi       = :deskripsi,
                                slug            = :slug,
                                title           = :title,
                                keyword         = :keyword,
                                description     = :description,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_page
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_page", $id_page, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $statement->bindParam(":img_share", $img_share, PDO::PARAM_STR);
                    $statement->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);
                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $statement->bindParam(":title", $title, PDO::PARAM_STR);
                    $statement->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                    $statement->bindParam(":description", $description, PDO::PARAM_STR);

                    $count = $statement->execute();

                    editSitemap($database_sitemap, $id_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    $_SESSION['_msg__']  = "Gagal";
                    echo "<script>window.location(history.back(0))</script>";
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