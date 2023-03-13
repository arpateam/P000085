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
    }elseif((isset($_POST['_submit_special_ARPATEAM_'])) OR ($_GET['act']==="aktifkan-kat-produk") OR ($_GET['act']==="non-aktifkan-kat-produk") OR ($_GET['act']==="delete-produk")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-kat-produk":

                // Data file
                $link               = "$base_url_admin/produk";
                $penyimpananGambar  = "../../../../assets/files/images/category";
                $database           = "kat_produk";
                // Data file

                $judul  = $_POST['___in_judul_special_ARPATEAM'];
                $status = htmlspecialchars($_POST['___in_status_kat_special_ARPATEAM']);
                $seo    = seo($judul);

                if (empty($_POST['___in_slug_special_ARPATEAM']) || $_POST['___in_slug_special_ARPATEAM']===NULL || $_POST['___in_slug_special_ARPATEAM']===0) {
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }else{
                    $slug   = seo($_POST['___in_slug_special_ARPATEAM']);
                    cekSlug($database, $slug);
                }

                $title          = "Jual Produk ".$judul." Original by ".$nama_web;
                $keyword        = "Jual produk ".$judul." original dari brand ".$nama_web.". Anda bisa belanja melalui website ini dengan memilih produk terbaik dan original dari Kami.";
                $description    = "Jual produk ".$judul." original dari brand ".$nama_web.". Anda bisa belanja melalui website ini dengan memilih produk terbaik dan original dari Kami.";

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

                    $gambar     = $nama_file_unik;
                // Gambar

                // Img Share
                    $lokasi_file_img_share      = $_FILES['___in_img_share_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload_img_share    = "$penyimpananGambar/";
                    $nama_file_img_share        = $_FILES['___in_img_share_special_ARPATEAM']['name'];
                    $tipe_file_img_share        = strtolower($_FILES['___in_img_share_special_ARPATEAM']['type']);
                    $tipe_file2_img_share       = seo2($tipe_file_img_share); // ngedapetin png / jpg / jpeg
                    $ukuran_img_share           = $_FILES['___in_img_share_special_ARPATEAM']['size'];
                    $nama_file_unik_img_share   = $seo."-img-share.".$tipe_file2_img_share;

                    // Cek jenis file yang di upload
                    cekFile($tipe_file_img_share);
                    // Cek jenis file yang di upload

                    // Cek ukuran file yang di upload
                    cekUkuranFile2mb($ukuran_img_share);
                    // Cek ukuran file yang di upload

                    $img_share  = $nama_file_unik_img_share;
                // Img Share

                // SiteMap
                    $database_sitemap   = "sitemap";
                    $id_sub_sitemap     = 2;
                    $loc                = $base_url."/product/".$slug;
                    $priority           = "1.00";
                // SiteMap

                tambahSitemap($database_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                $id_sitemap = $insertId;

                if ($count>0) {
                    try{
                        $stmt = $pdo->prepare("INSERT INTO $database
                                        (judul,gambar,img_share,status,slug,title,keyword,description,tgl_update,id_sitemap)
                                        VALUES(:judul,:gambar,:img_share,:status,:slug,:title,:keyword,:description,NOW(),:id_sitemap)" );
                                
                        $stmt->bindParam(":judul", $judul, PDO::PARAM_STR);
                        $stmt->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                        $stmt->bindParam(":img_share", $img_share, PDO::PARAM_STR);
                        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
                        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
                        $stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                        $stmt->bindParam(":id_sitemap", $id_sitemap, PDO::PARAM_STR);
                            
                        $count = $stmt->execute();

                        // Upload gambar
                        uploadGambarAsli($gambar, $tipe_file, $lokasi_file, $lokasi_upload);
                        // Upload gambar

                        // Upload img_share
                        uploadGambarAsli($img_share, $tipe_file_img_share, $lokasi_file_img_share, $lokasi_upload_img_share);
                        // Upload img_share
                                
                        $insertId = $pdo->lastInsertId();

                        if ($count>0) {
                            $_SESSION['_msg__'] = 'Berhasil';
                            header("Location: $link");
                            die();
                            exit();
                        }     
                    }catch(PDOException $e){
                        $_SESSION['_msg__'] = 'Gagal';
                        echo "<script>window.location(history.back(0))</script>";
                        die();
                        exit();
                    }
                }

                break;

            case "edit-kat-produk":

                // Data file
                $link               = "$base_url_admin/produk";
                $penyimpananGambar  = "../../../../assets/files/images/category";
                $database           = "kat_produk";
                // Data file

                $id_kat_produk      = htmlspecialchars($_POST['___in_id_kat_produk_special_ARPATEAM']);
                $id_sitemap         = htmlspecialchars($_POST['___in_id_sitemap_special_ARPATEAM']);
                $judul              = $_POST['___in_judul_special_ARPATEAM'];
                $status             = htmlspecialchars($_POST['___in_status_kat_special_ARPATEAM']);
                $seo                = seo($judul);

                if ($_POST['___in_slug_special_ARPATEAM']===$_POST['___in_slug_lama_special_ARPATEAM']) {
                    $slug   = $_POST['___in_slug_special_ARPATEAM'];
                }else{
                    $slug   = seo($_POST['___in_slug_special_ARPATEAM']);
                    cekSlug($database, $slug);
                }

                $title          = "Jual Produk ".$judul." Original by ".$nama_web;
                $keyword        = "Jual produk ".$judul." original dari brand ".$nama_web.". Anda bisa belanja melalui website ini dengan memilih produk terbaik dan original dari Kami.";
                $description    = "Jual produk ".$judul." original dari brand ".$nama_web.". Anda bisa belanja melalui website ini dengan memilih produk terbaik dan original dari Kami.";

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
                    $id_sub_sitemap     = 2;
                    $loc                = $base_url."/product/".$slug;
                    $priority           = "1.00";
                // SiteMap

                try {
                    $sql = "UPDATE $database
                            SET judul           = :judul,
                                gambar          = :gambar,
                                img_share       = :img_share,
                                status          = :status,
                                slug            = :slug,
                                title           = :title,
                                keyword         = :keyword,
                                description     = :description,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_kat_produk
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_kat_produk", $id_kat_produk, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $statement->bindParam(":img_share", $img_share, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $statement->bindParam(":title", $title, PDO::PARAM_STR);
                    $statement->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                    $statement->bindParam(":description", $description, PDO::PARAM_STR);

                    $count = $statement->execute();

                    editSitemap($database_sitemap, $id_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        header("Location: $link");
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

            case "aktifkan-kat-produk":

                // Data file
                $link       = "$base_url_admin/produk";
                $database   = "kat_produk";
                // Data file

                $slug       = $_GET['slug'];
                $status     = "Active";

                try {
                    $sql = "UPDATE $database
                            SET status      = :status,
                                tgl_update  = NOW()
                            WHERE slug      = :slug
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        header("Location: $link");
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
            
            case "non-aktifkan-kat-produk":

                // Data file
                $link       = "$base_url_admin/produk";
                $database   = "kat_produk";
                // Data file

                $slug       = $_GET['slug'];
                $status     = "Non-Active";

                try {
                    $sql = "UPDATE $database
                            SET status      = :status,
                                tgl_update  = NOW()
                            WHERE slug      = :slug
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        header("Location: $link");
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
                $link               = $base_url_admin."/produk/".$_POST['___in_slug_kat_produk_special_ARPATEAM'];
                $penyimpananGambar  = "../../../../assets/files/images/product";
                $database           = "produk";
                // Data file

                $id_kat_produk  = htmlspecialchars($_POST['___in_id_kat_produk_special_ARPATEAM']);
                $judul          = $_POST['___in_judul_special_ARPATEAM'];
                $status         = htmlspecialchars($_POST['___in_status_produk_special_ARPATEAM']);
                $stock          = htmlspecialchars($_POST['___in_stock_special_ARPATEAM']);
                $sub_harga      = str_replace(".", "", str_replace("Rp", "", $_POST['___in_sub_harga_special_ARPATEAM']));
                $diskon         = htmlspecialchars($_POST['___in_diskon_special_ARPATEAM']);
                $harga          = ceil(($sub_harga-($sub_harga*$diskon/100)));

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

                $deskripsiSEO      = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$deskripsi)));
                $myDeskripsiSEO    = substr($deskripsiSEO,0,strrpos(substr($deskripsiSEO,0,100)," "))." ...";

                $title          = "Jual ".$judul." Original by ".$nama_web;
                $keyword        = "Jual ".$judul." original dari brand ".$nama_web." cuma ".$_POST['___in_sub_harga_special_ARPATEAM'].". ".$deskripsiSEO;
                $description    = "Jual ".$judul." original dari brand ".$nama_web." cuma ".$_POST['___in_sub_harga_special_ARPATEAM'].". ".$deskripsiSEO;

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

                    $gambar     = $nama_file_unik;
                // Gambar

                // SiteMap
                    $database_sitemap   = "sitemap";
                    $id_sub_sitemap     = 3;
                    $loc                = $base_url."/product/".$_POST['___in_slug_kat_produk_special_ARPATEAM']."/".$slug;
                    $priority           = "0.80";
                // SiteMap

                tambahSitemap($database_sitemap, $id_sub_sitemap, $loc, $priority, $link);
                $id_sitemap = $insertId;

                if ($count>0) {
                    try{
                        $stmt = $pdo->prepare("INSERT INTO $database
                                (id_kat_produk,judul,status,stock,sub_harga,diskon,harga,gambar,deskripsi,slug,title,keyword,description,tgl_update,id_sitemap)
                                VALUES(:id_kat_produk,:judul,:status,:stock,:sub_harga,:diskon,:harga,:gambar,:deskripsi,:slug,:title,:keyword,:description,NOW(),:id_sitemap)" );
                                
                        $stmt->bindParam(":id_kat_produk", $id_kat_produk, PDO::PARAM_STR);
                        $stmt->bindParam(":judul", $judul, PDO::PARAM_STR);
                        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
                        $stmt->bindParam(":stock", $stock, PDO::PARAM_STR);
                        $stmt->bindParam(":sub_harga", $sub_harga, PDO::PARAM_STR);
                        $stmt->bindParam(":diskon", $diskon, PDO::PARAM_STR);
                        $stmt->bindParam(":harga", $harga, PDO::PARAM_STR);
                        $stmt->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                        $stmt->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);
                        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
                        $stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
                        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                        $stmt->bindParam(":id_sitemap", $id_sitemap, PDO::PARAM_STR);
                            
                        $count = $stmt->execute();

                        // Upload gambar
                        uploadGambarAsli($gambar, $tipe_file, $lokasi_file, $lokasi_upload);
                        // Upload gambar
                                
                        $insertId = $pdo->lastInsertId();

                        if ($count>0) {
                            $_SESSION['_msg__'] = 'Berhasil';
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
                }

                break;

            case "edit-produk":

                // Data file
                $link               = $base_url_admin."/produk/".$_POST['___in_slug_kat_produk_special_ARPATEAM'];
                $penyimpananGambar  = "../../../../assets/files/images/product";
                $database           = "produk";
                // Data file

                $id_sitemap = htmlspecialchars($_POST['___in_id_sitemap_special_ARPATEAM']);
                $id_produk  = htmlspecialchars($_POST['___in_id_produk_special_ARPATEAM']);
                $judul      = $_POST['___in_judul_special_ARPATEAM'];
                $status     = htmlspecialchars($_POST['___in_status_produk_special_ARPATEAM']);
                $stock      = htmlspecialchars($_POST['___in_stock_special_ARPATEAM']);

                $sub_harga  = str_replace(".", "", str_replace("Rp", "", $_POST['___in_sub_harga_special_ARPATEAM']));
                $diskon     = htmlspecialchars($_POST['___in_diskon_special_ARPATEAM']);
                $harga      = ($sub_harga-($sub_harga*$diskon/100));
                
                $deskripsiE = explode('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', $_POST['___in_deskripsi_special_ARPATEAM']);
                $deskripsi  = $deskripsiE[0];

                $seo        = seo($judul);

                if ($_POST['___in_slug_special_ARPATEAM']===$_POST['___in_slug_lama_special_ARPATEAM']) {
                    $slug   = $_POST['___in_slug_special_ARPATEAM'];
                }else{
                    $slug   = seo($_POST['___in_slug_special_ARPATEAM']);
                    cekSlug($database, $slug);
                }

                $deskripsiSEO      = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$deskripsi)));
                $myDeskripsiSEO    = substr($deskripsiSEO,0,strrpos(substr($deskripsiSEO,0,100)," "))." ...";

                $title          = "Jual ".$judul." Original by ".$nama_web;
                $keyword        = "Jual ".$judul." original dari brand ".$nama_web." cuma ".$_POST['___in_sub_harga_special_ARPATEAM'].". ".$deskripsiSEO;
                $description    = "Jual ".$judul." original dari brand ".$nama_web." cuma ".$_POST['___in_sub_harga_special_ARPATEAM'].". ".$deskripsiSEO;

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
                    $id_sub_sitemap     = 3;
                    $loc                = $base_url."/product/".$_POST['___in_slug_kat_produk_special_ARPATEAM']."/".$slug;
                    $priority           = "0.80";
                // SiteMap

                try {
                    $sql = "UPDATE $database
                            SET judul           = :judul,
                                status          = :status,
                                stock           = :stock,
                                sub_harga       = :sub_harga,
                                diskon          = :diskon,
                                harga           = :harga,
                                gambar          = :gambar,
                                deskripsi       = :deskripsi,
                                slug            = :slug,
                                title           = :title,
                                keyword         = :keyword,
                                description     = :description,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_produk
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_produk", $id_produk, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":stock", $stock, PDO::PARAM_STR);
                    $statement->bindParam(":sub_harga", $sub_harga, PDO::PARAM_STR);
                    $statement->bindParam(":diskon", $diskon, PDO::PARAM_STR);
                    $statement->bindParam(":harga", $harga, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
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

            case "delete-produk":

                // Data file
                $link               = $base_url_admin."/produk/".$_GET["slug"];
                $penyimpananGambar  = "../../../../assets/files/images/product";
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