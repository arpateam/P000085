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
    }elseif((isset($_POST['_submit_'])) OR ($_GET['act']==="delete-produk")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-kat-produk":

                // Data file
                $link       = $base_url_admin."/produk";
                $penyimpananGambar  = "../../../../assets/files/images/kat-produk";
                $database   = "kat_produk";
                // Data file

                $urutan = htmlspecialchars($_POST['___in_urutan']);
                $judul  = htmlspecialchars($_POST['___in_judul']);
                $seo    = seo($judul);

                if (empty($_POST['___in_slug']) || $_POST['___in_slug']===NULL || $_POST['___in_slug']===0) {
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }else{
                    $slug   = seo($_POST['___in_slug']);
                    cekSlug($database, $slug);
                }

                seoKeyword($_POST['___in_keyword'], $judul);
                seoDescription($_POST['___in_description'], $judul);

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar']['size'];
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
                    $id_sub_sitemap     = 2;
                    $loc                = $base_url."/produk/".$slug;
                    $priority           = "0.80";
                // SiteMap

                tambahSitemap($database_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                $id_sitemap = $insertId;

                if ($count>0) {
                    try{
                        $stmt = $pdo->prepare("INSERT INTO $database
                                        (urutan,judul,gambar,slug,keyword,description,tgl_update,id_sitemap)
                                        VALUES(:urutan,:judul,:gambar,:slug,:keyword,:description,NOW(),:id_sitemap)" );
                                
                        $stmt->bindParam(":urutan", $urutan, PDO::PARAM_INT);
                        $stmt->bindParam(":judul", $judul, PDO::PARAM_STR);
                        $stmt->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                        $stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                        $stmt->bindParam(":id_sitemap", $id_sitemap, PDO::PARAM_INT);
                            
                        $count = $stmt->execute();
                                
                        $insertId = $pdo->lastInsertId();

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
                        var_dump($e);
                        exit();
                        $_SESSION['_msg__'] = 'Gagal';
                        echo "<script>window.location(history.back(0))</script>";
                        die();
                        exit();
                    }
                }

                break;

            case "edit-kat-produk":

                // Data file
                $link               = $base_url_admin."/produk";
                $penyimpananGambar  = "../../../../assets/files/images/kat-produk";
                $database           = "kat_produk";
                // Data file

                // Data file
                // Data file

                $id_sitemap     = htmlspecialchars($_POST['___in_id_sitemap']);
                $id_kat_produk  = htmlspecialchars($_POST['___in_id_kat_produk']);
                $urutan         = htmlspecialchars($_POST['___in_urutan']);
                $judul          = htmlspecialchars($_POST['___in_judul']);

                $seo            = seo($judul);

                if ($_POST['___in_slug']===$_POST['___in_slug_lama']) {
                    $slug   = $_POST['___in_slug'];
                }else{
                    $slug   = seo($_POST['___in_slug']);
                    cekSlug($database, $slug);
                }

                seoKeyword($_POST['___in_keyword'], $judul);
                seoDescription($_POST['___in_description'], $judul);

                // Gambar
                    $lokasi_file        = $_FILES['___in_gambar']['tmp_name'];
                    $lokasi_upload      = "$penyimpananGambar/";
                    $nama_file          = $_FILES['___in_gambar']['name'];
                    $tipe_file          = strtolower($_FILES['___in_gambar']['type']);
                    $tipe_file2         = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran             = $_FILES['___in_gambar']['size'];
                    $nama_file_unik     = $seo.".".$tipe_file2;

                    $in_gambar_lama     = $_POST['___in_gambar_lama'];
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
                    $id_sub_sitemap     = 2;
                    $loc                = $base_url."/produk/".$slug;
                    $priority           = "0.80";
                // SiteMap

                try {
                    $sql = "UPDATE $database
                            SET urutan      = :urutan,
                                judul       = :judul,
                                gambar      = :gambar,
                                slug        = :slug,
                                keyword     = :keyword,
                                description = :description,
                                tgl_update  = NOW()
                            WHERE id_$database  = :id_kat_produk
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_kat_produk", $id_kat_produk, PDO::PARAM_INT);
                    $statement->bindParam(":urutan", $urutan, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
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

            case "add-produk":
                // Data file
                $slug_kat           = htmlspecialchars($_POST['___in_slug_kat']);
                $link               = $base_url_admin."/produk/".$slug_kat;
                $penyimpananGambar  = "../../../../assets/files/images/produk";
                $database           = "produk";
                // Data file

                $id_kat_produk  = htmlspecialchars($_POST['___in_id_kat_produk']);
                $judul          = htmlspecialchars($_POST['___in_judul']);
                $harga          = htmlspecialchars($_POST['___in_harga']);
                $deskripsi      = $_POST['___in_deskripsi'];
                $seo            = seo($judul);
                $view           = "0";

                if (empty($_POST['___in_slug']) || $_POST['___in_slug']===NULL || $_POST['___in_slug']===0) {
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }else{
                    $slug   = seo($_POST['___in_slug']);
                    cekSlug($database, $slug);
                }

                seoKeyword($_POST['___in_keyword'], $deskripsi);
                seoDescription($_POST['___in_description'], $deskripsi);

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar']['size'];
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
                    $id_sub_sitemap     = 3;
                    $loc                = $base_url."/produk/".$slug_kat."/".$slug;
                    $priority           = "0.80";
                // SiteMap

                tambahSitemap($database_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                $id_sitemap = $insertId;

                if ($count>0) {
                    try{
                        $stmt = $pdo->prepare("INSERT INTO $database
                                        (id_kat_produk,judul,harga,gambar,deskripsi,slug,keyword,description,tgl_update,view,id_sitemap)
                                        VALUES(:id_kat_produk,:judul,:harga,:gambar,:deskripsi,:slug,:keyword,:description,NOW(),:view,:id_sitemap)" );
                                
                        $stmt->bindParam(":id_kat_produk", $id_kat_produk, PDO::PARAM_INT);
                        $stmt->bindParam(":judul", $judul, PDO::PARAM_STR);
                        $stmt->bindParam(":harga", $harga, PDO::PARAM_INT);
                        $stmt->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                        $stmt->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);
                        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                        $stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                        $stmt->bindParam(":view", $view, PDO::PARAM_INT);
                        $stmt->bindParam(":id_sitemap", $id_sitemap, PDO::PARAM_INT);
                            
                        $count = $stmt->execute();
                                
                        $insertId = $pdo->lastInsertId();

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
                        var_dump($e);
                        exit();
                        $_SESSION['_msg__'] = 'Gagal';
                        echo "<script>window.location(history.back(0))</script>";
                        die();
                        exit();
                    }
                }

                break;

            case "edit-produk":

                // Data file
                $database   = "produk";
                // Data file

                if ($_POST['___in_slug']===$_POST['___in_slug_lama']) {
                    $slug   = $_POST['___in_slug'];
                }else{
                    $slug   = seo($_POST['___in_slug']);
                    cekSlug($database, $slug);
                }

                // Data file
                $slug_kat           = htmlspecialchars($_POST['___in_slug_kat']);
                $link               = $base_url_admin."/produk/".$slug_kat."/".$slug;
                $penyimpananGambar  = "../../../../assets/files/images/produk";
                // Data file

                $id_sitemap = htmlspecialchars($_POST['___in_id_sitemap']);
                $id_produk  = htmlspecialchars($_POST['___in_id_produk']);
                $judul      = htmlspecialchars($_POST['___in_judul']);
                $harga      = htmlspecialchars($_POST['___in_harga']);
                $deskripsi  = $_POST['___in_deskripsi'];
                $seo        = seo($judul);

                seoKeyword($_POST['___in_keyword'], $deskripsi);
                seoDescription($_POST['___in_description'], $deskripsi);

                // Gambar
                    $lokasi_file        = $_FILES['___in_gambar']['tmp_name'];
                    $lokasi_upload      = "$penyimpananGambar/";
                    $nama_file          = $_FILES['___in_gambar']['name'];
                    $tipe_file          = strtolower($_FILES['___in_gambar']['type']);
                    $tipe_file2         = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran             = $_FILES['___in_gambar']['size'];
                    $nama_file_unik     = $seo.".".$tipe_file2;

                    $in_gambar_lama     = $_POST['___in_gambar_lama'];
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
                    $id_sub_sitemap     = 3;
                    $loc                = $base_url."/produk/".$slug_kat."/".$slug;
                    $priority           = "0.80";
                // SiteMap

                try {
                    $sql = "UPDATE $database
                            SET judul       = :judul,
                                harga       = :harga,
                                gambar      = :gambar,
                                deskripsi   = :deskripsi,
                                slug        = :slug,
                                keyword     = :keyword,
                                description = :description,
                                tgl_update  = NOW()
                            WHERE id_$database  = :id_produk
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_produk", $id_produk, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":harga", $harga, PDO::PARAM_INT);
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

            case "delete-produk":

                // Data file
                $link               = $base_url_admin."/produk/".$_GET['slug'];
                $penyimpananGambar  = "../../../../assets/files/images/produk";
                $database           = "produk";
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