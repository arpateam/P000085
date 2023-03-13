<?php

    session_start();
    // error_reporting(0);
    require "../../../../appweb/Config/Db.php";
    require "../../../../appweb/Config/AssetsWebsite.php";
    require "../../../../appweb/Config/SetWebsite.php";

    if (empty($_SESSION['_session__'])) {
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }elseif((isset($_POST['_submit_special_ARPATEAM_'])) OR ($_GET['act']==="delete-blog")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-blog":

                // Data file
                $link               = $base_url_admin."/blog";
                $penyimpananGambar  = "../../../../assets/files/images/blog";
                $database           = "blog";
                // Data file

                $judul      = $_POST['___in_judul_special_ARPATEAM'];

                $deskripsiE = explode('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', $_POST['___in_deskripsi_special_ARPATEAM']);
                $deskripsi  = $deskripsiE[0];
                $seo        = seo($judul);

                if (empty($_POST['___in_slug_special_ARPATEAM']) || $_POST['___in_slug_special_ARPATEAM']===NULL || $_POST['___in_slug_special_ARPATEAM']===0) {
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }else{
                    $slug   = seo($_POST['___in_slug_special_ARPATEAM']);
                    cekSlug($database, $slug);
                }

                seoKeyword($_POST['___in_keyword_special_ARPATEAM'], $deskripsi);
                seoDescription($_POST['___in_description_special_ARPATEAM'], $deskripsi);

                $views      = 0;

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = $seo.".".$tipe_file2;

                    // Cek jenis file yang di upload
                    cekFile($tipe_file);
                    // Cek jenis file yang di upload

                    // Cek ukuran file yang di upload
                    cekUkuranFile2mb($ukuran);
                    // Cek ukuran file yang di upload

                    $gambar = $nama_file_unik;
                // Gambar

                // SiteMap
                    $database_sitemap   = "sitemap";
                    $id_sub_sitemap     = 4;
                    $loc                = $base_url."/blog/".$slug;
                    $priority           = "0.80";
                // SiteMap

                tambahSitemap($database_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                $id_sitemap = $insertId;

                if ($count>0) {
                    try{
                        $stmt = $pdo->prepare("INSERT INTO $database
                                        (judul,gambar,deskripsi,slug,keyword,description,views,tgl_terbit,tgl_update,id_sitemap)
                                        VALUES(:judul,:gambar,:deskripsi,:slug,:keyword,:description,:views,NOW(),NOW(),:id_sitemap)" );
                                
                        $stmt->bindParam(":judul", $judul, PDO::PARAM_STR);
                        $stmt->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                        $stmt->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);
                        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                        $stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                        $stmt->bindParam(":views", $views, PDO::PARAM_INT);
                        $stmt->bindParam(":id_sitemap", $id_sitemap, PDO::PARAM_STR);
                            
                        $count      = $stmt->execute();
                        $insertId   = $pdo->lastInsertId();

                        // Upload gambar
                        uploadGambarAsli($gambar, $tipe_file, $lokasi_file, $lokasi_upload);
                        // Upload gambar

                        if ($count>0) {
                            $_SESSION['_msg__'] = 'Berhasil';
                            echo "<script>window.location = '$link'</script>";
                            die();
                            exit();
                        }     
                    }catch(PDOException $e){
                        $_SESSION['_msg__'] = 'Gagal';
                        echo "<script>window.location(history.back(0))</script>";
                        // var_dump($e);
                        die();
                        exit();
                    }
                }

                break;

            case "edit-blog":

                // Data file
                $database   = "blog";
                // Data file

                if ($_POST['___in_slug_special_ARPATEAM']===$_POST['___in_slug_lama_special_ARPATEAM']) {
                    $slug   = $_POST['___in_slug_special_ARPATEAM'];
                }else{
                    $slug   = seo($_POST['___in_slug_special_ARPATEAM']);
                    cekSlug($database, $slug);
                }

                // Data file
                $link               = $base_url_admin."/blog/".$slug;
                $penyimpananGambar  = "../../../../assets/files/images/blog";
                // Data file

                $id_sitemap = htmlspecialchars($_POST['___in_id_sitemap_special_ARPATEAM']);
                $id_blog    = htmlspecialchars($_POST['___in_id_blog_special_ARPATEAM']);
                $judul      = $_POST['___in_judul_special_ARPATEAM'];

                $deskripsiE = explode('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', $_POST['___in_deskripsi_special_ARPATEAM']);
                $deskripsi  = $deskripsiE[0];
                $seo        = seo($judul);

                seoKeyword($_POST['___in_keyword_special_ARPATEAM'], $deskripsi);
                seoDescription($_POST['___in_description_special_ARPATEAM'], $deskripsi);

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

                // SiteMap
                    $database_sitemap   = "sitemap";
                    $id_sub_sitemap     = 4;
                    $loc                = $base_url."/blog/".$slug;
                    $priority           = "0.80";
                // SiteMap

                try {
                    $sql = "UPDATE $database
                            SET judul           = :judul,
                                gambar          = :gambar,
                                deskripsi       = :deskripsi,
                                slug            = :slug,
                                keyword         = :keyword,
                                description     = :description,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_blog
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_blog", $id_blog, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $statement->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);
                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
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

            case "delete-blog":

                // Data file
                $link               = $base_url_admin."/blog";
                $penyimpananGambar  = "../../../../assets/files/images/blog";
                $database           = "blog";
                // Data file

                $Data           = $pdo->query("SELECT gambar, id_sitemap FROM $database WHERE id_$database ='$_GET[id]'");
                $resultData     = $Data->fetch(PDO::FETCH_ASSOC);
                $gambarHapus    = $resultData["gambar"];

                // SiteMap 1
                    $database_sitemap   = "sitemap";
                    $id_sitemap         = $resultData['id_sitemap'];
                // SiteMap 1

                try{
                    $del = $pdo->query("DELETE FROM $database WHERE id_$database='$_GET[id]'");
                    $del->execute();

                    // Hapus gambar
                    unlink("$penyimpananGambar/$gambarHapus");
                    // Hapus gambar

                    hapusSitemap($database_sitemap, $id_sitemap);
                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    $_SESSION['_msg__'] = 'Gagal';
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