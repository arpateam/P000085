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
    }elseif((isset($_POST['_submit_special_ARPATEAM_'])) OR ($_GET['act']==="aktifkan-pegawai") OR ($_GET['act']==="non-aktifkan-pegawai") OR ($_GET['act']==="reset-session")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-pegawai":

                // Data file
                $link               = $base_url_admin."/pegawai";
                // $penyimpananGambar  = "$base_url/assets/files/images/kat-pegawai";
                $penyimpananGambar  = "../../../../assets/files/images/avatar";
                $database           = "data_admin";
                // Data file

                // Cek username
                    $username   = preg_replace('/<[^<]+?>/', ' ', $_POST['___in_username_special_ARPATEAM']);

                    try{
                        $stmt   = $pdo->prepare("SELECT 
                                            username
                                            FROM $database
                                            WHERE username = ? LIMIT 1");

                        $stmt->bindValue(1, $username);
                        $stmt->execute();

                        $rowsCekUsername = $stmt->rowCount();

                        if ($rowsCekUsername>0) {
                            $_SESSION['_msg__'] = 'UsernameTerdaftar';
                            echo "<script>window.location(history.back(0))</script>";
                            exit();
                        }
                    }catch(Exception $e){
                        $_SESSION['_msg__'] = 'UsernameTerdaftar';
                        echo "<script>window.location(history.back(0))</script>";
                        exit();
                    }
                // End Cek username

                // Fungsi Password
                $password           = htmlspecialchars($_POST['___in_password_special_ARPATEAM']);
                $ulangi_password    = htmlspecialchars($_POST['___in_ulangi_password_special_ARPATEAM']);

                if ($password!=$ulangi_password) {
                    $_SESSION['_msg__'] = 'PasswordTidakSama';
                    echo "<script>window.location(history.back(0))</script>";
                    exit();
                }else{
                    $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);
                }
                // End Fungsi Password

                $nama           = htmlspecialchars($_POST['___in_nama_special_ARPATEAM']);
                $jenis_kelamin  = htmlspecialchars($_POST['___in_jenis_kelamin_special_ARPATEAM']);
                $nomor_whatsapp = htmlspecialchars($_POST['___in_nomor_whatsapp_special_ARPATEAM']);
                $email          = htmlspecialchars($_POST['___in_email_special_ARPATEAM']);
                $tentang_saya   = htmlspecialchars($_POST['___in_tentang_saya_special_ARPATEAM']);
                $level          = htmlspecialchars($_POST['___in_level_special_ARPATEAM']);
                $status         = htmlspecialchars($_POST['___in_status_pegawai_special_ARPATEAM']);

                $seo            = seo($nama." ".$level);

                if (empty($_POST['___in_slug_special_ARPATEAM']) || $_POST['___in_slug_special_ARPATEAM']===NULL || $_POST['___in_slug_special_ARPATEAM']===0) {
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }else{
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = seo($nama)."-".seo($level).".".$tipe_file2;

                    // Cek jenis file yang di upload
                    cekFile($tipe_file);
                    // Cek jenis file yang di upload

                    // Cek ukuran file yang di upload
                    cekUkuranFile2mb($ukuran);
                    // Cek ukuran file yang di upload

                    $avatar         = $nama_file_unik;
                // Gambar

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (username,password,nama,jenis_kelamin,nomor_whatsapp,email,tentang_saya,avatar,level,status,slug)
                                    VALUES(:username,:password,:nama,:jenis_kelamin,:nomor_whatsapp,:email,:tentang_saya,:avatar,:level,:status,:slug)" );
                            
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                    $stmt->bindParam(":nama", $nama, PDO::PARAM_STR);
                    $stmt->bindParam(":jenis_kelamin", $jenis_kelamin, PDO::PARAM_STR);
                    $stmt->bindParam(":nomor_whatsapp", $nomor_whatsapp, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":tentang_saya", $tentang_saya, PDO::PARAM_STR);
                    $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $stmt->bindParam(":level", $level, PDO::PARAM_STR);
                    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
                    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);

                    $count = $stmt->execute();

                    // Upload gambar
                    uploadGambarAsli($avatar, $tipe_file, $lokasi_file, $lokasi_upload);
                    // Upload gambar
                            
                    $insertId = $pdo->lastInsertId();

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

                break;

            case "edit-pegawai":

                $id_data_admin      = $_POST['___in_id_data_admin_special_ARPATEAM'];

                // Data file
                // $penyimpananGambar  = "$base_url/assets/files/images/kat-pegawai";
                $penyimpananGambar  = "../../../../assets/files/images/avatar";
                $database           = "data_admin";
                // Data file

                $nama           = htmlspecialchars($_POST['___in_nama_special_ARPATEAM']);
                $jenis_kelamin  = htmlspecialchars($_POST['___in_jenis_kelamin_special_ARPATEAM']);
                $nomor_whatsapp = htmlspecialchars($_POST['___in_nomor_whatsapp_special_ARPATEAM']);
                $email          = htmlspecialchars($_POST['___in_email_special_ARPATEAM']);
                $tentang_saya   = htmlspecialchars($_POST['___in_tentang_saya_special_ARPATEAM']);
                $level          = htmlspecialchars($_POST['___in_level_special_ARPATEAM']);
                $status         = htmlspecialchars($_POST['___in_status_pegawai_special_ARPATEAM']);
                $session        = NULL;

                $seo            = seo($nama." ".$level);

                if ($seo===$_POST['___in_slug_lama_special_ARPATEAM']) {
                    $slug   = $_POST['___in_slug_lama_special_ARPATEAM'];
                }else{
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }

                // Data file
                $link               = $base_url_admin."/pegawai/".$slug;
                // Data file

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = seo($nama)."-".seo($level).".".$tipe_file2;

                    $in_gambar_lama     = $_POST['___in_gambar_lama_special_ARPATEAM'];
                    $cariExtensiGambar  = explode(".", $in_gambar_lama);
                    $extensiGambarnya   = $cariExtensiGambar[1];

                    if (empty($nama_file)){
                        // Ubah nama gambar
                        rename("$penyimpananGambar/$in_gambar_lama", "$penyimpananGambar/$nama_file_unik$extensiGambarnya");
                        // Ubah nama gambar

                        $avatar = $nama_file_unik.$extensiGambarnya;
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

                        $avatar = $nama_file_unik;
                    }
                // Gambar

                try {
                    $sql = "UPDATE $database
                            SET nama            = :nama,
                                jenis_kelamin   = :jenis_kelamin,
                                nomor_whatsapp  = :nomor_whatsapp,
                                email           = :email,
                                tentang_saya    = :tentang_saya,
                                avatar          = :avatar,
                                level           = :level,
                                status          = :status,
                                slug          = :slug,
                                session         = :session
                            WHERE id_$database  = :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_INT);
                    $statement->bindParam(":nama", $nama, PDO::PARAM_STR);
                    $statement->bindParam(":jenis_kelamin", $jenis_kelamin, PDO::PARAM_STR);
                    $statement->bindParam(":nomor_whatsapp", $nomor_whatsapp, PDO::PARAM_STR);
                    $statement->bindParam(":email", $email, PDO::PARAM_STR);
                    $statement->bindParam(":tentang_saya", $tentang_saya, PDO::PARAM_STR);
                    $statement->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $statement->bindParam(":level", $level, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

                    $count = $statement->execute();

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

            case "aktifkan-pegawai":

                $id_data_admin  = $_GET['id'];

                // Data file
                $link       = $base_url_admin."/pegawai/".$id_data_admin;
                $database   = "data_admin";
                // Data file

                $status         = "Active";
                $session        = NULL;

                try {
                    $sql = "UPDATE $database
                            SET status          = :status,
                                session         = :session
                            WHERE id_data_admin = :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

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
            
            case "non-aktifkan-pegawai":

                $id_data_admin  = $_GET['id'];

                // Data file
                $link       = $base_url_admin."/pegawai/".$id_data_admin;
                $database   = "data_admin";
                // Data file

                $id_data_admin  = $_GET['id'];
                $status         = "Non-Active";
                $session        = NULL;

                try {
                    $sql = "UPDATE $database
                            SET status          = :status,
                                session         = :session
                            WHERE id_data_admin = :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

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
            
            case "edit-password":

                $id_data_admin      = $_POST['___in_id_data_admin_special_ARPATEAM'];

                // Data file
                $link               = $base_url_admin."/pegawai/".$id_data_admin;
                $database           = "data_admin";
                // Data file

                $password           = htmlspecialchars($_POST['___in_password_special_ARPATEAM']);
                $ulangi_password    = htmlspecialchars($_POST['___in_ulangi_password_special_ARPATEAM']);

                if ($password!=$ulangi_password) {
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    exit();
                }else{
                    $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);
                }

                $session    = NULL;

                try {
                    $sql = "UPDATE $database
                            SET password        = :password,
                                session         = :session
                            WHERE id_data_admin = :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_STR);
                    $statement->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

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

            case "edit-profil":

                $id_data_admin      = $_POST['___in_id_data_admin_special_ARPATEAM'];

                // Data file
                // $penyimpananGambar  = "$base_url/assets/files/images/kat-pegawai";
                $penyimpananGambar  = "../../../../assets/files/images/avatar";
                $database           = "data_admin";
                // Data file

                $nama           = htmlspecialchars($_POST['___in_nama_special_ARPATEAM']);
                $jenis_kelamin  = htmlspecialchars($_POST['___in_jenis_kelamin_special_ARPATEAM']);
                $nomor_whatsapp = htmlspecialchars($_POST['___in_nomor_whatsapp_special_ARPATEAM']);
                $email          = htmlspecialchars($_POST['___in_email_special_ARPATEAM']);
                $tentang_saya   = htmlspecialchars($_POST['___in_tentang_saya_special_ARPATEAM']);
                $level          = htmlspecialchars($_POST['___in_level_special_ARPATEAM']);
                $status         = htmlspecialchars($_POST['___in_status_pegawai_special_ARPATEAM']);
                $session        = NULL;

                $seo            = seo($nama." ".$level);

                if ($seo===$_POST['___in_slug_lama_special_ARPATEAM']) {
                    $slug   = $_POST['___in_slug_lama_special_ARPATEAM'];
                }else{
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }

                // Data file
                $link               = $base_url_admin."/pegawai/".$slug;
                // Data file

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = seo($nama)."-".seo($level).".".$tipe_file2;

                    $in_gambar_lama     = $_POST['___in_gambar_lama_special_ARPATEAM'];
                    $cariExtensiGambar  = explode(".", $in_gambar_lama);
                    $extensiGambarnya   = $cariExtensiGambar[1];

                    if (empty($nama_file)){
                        // Ubah nama gambar
                        rename("$penyimpananGambar/$in_gambar_lama", "$penyimpananGambar/$nama_file_unik$extensiGambarnya");
                        // Ubah nama gambar

                        $avatar = $nama_file_unik.$extensiGambarnya;
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

                        $avatar = $nama_file_unik;
                    }
                // Gambar

                try {
                    $sql = "UPDATE $database
                            SET nama            = :nama,
                                jenis_kelamin   = :jenis_kelamin,
                                nomor_whatsapp  = :nomor_whatsapp,
                                email           = :email,
                                tentang_saya    = :tentang_saya,
                                avatar          = :avatar,
                                level           = :level,
                                status          = :status,
                                session         = :session
                            WHERE id_$database  = :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_INT);
                    $statement->bindParam(":nama", $nama, PDO::PARAM_STR);
                    $statement->bindParam(":jenis_kelamin", $jenis_kelamin, PDO::PARAM_STR);
                    $statement->bindParam(":nomor_whatsapp", $nomor_whatsapp, PDO::PARAM_STR);
                    $statement->bindParam(":email", $email, PDO::PARAM_STR);
                    $statement->bindParam(":tentang_saya", $tentang_saya, PDO::PARAM_STR);
                    $statement->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $statement->bindParam(":level", $level, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        echo "<script>window.location = '$base_url_admin/keluar-edit'</script>";
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
            
            case "edit-password-profil":

                $id_data_admin      = $_POST['___in_id_data_admin_special_ARPATEAM'];

                // Data file
                $link               = $base_url_admin."/pegawai/".$id_data_admin;
                $database           = "data_admin";
                // Data file

                $password           = htmlspecialchars($_POST['___in_password_special_ARPATEAM']);
                $ulangi_password    = htmlspecialchars($_POST['___in_ulangi_password_special_ARPATEAM']);

                if ($password!=$ulangi_password) {
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    exit();
                }else{
                    $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);
                }

                $session    = NULL;

                try {
                    $sql = "UPDATE $database
                            SET password        = :password,
                                session         = :session
                            WHERE id_data_admin = :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_STR);
                    $statement->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        echo "<script>window.location = '$base_url_admin/keluar-edit'</script>";
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
            
            case "reset-session":
                // Data file
                $link       = $base_url_admin."/pegawai";
                $database   = "data_admin";
                // Data file

                $id_data_admin  = 1;
                $session        = NULL;

                try {
                    $sql = "UPDATE $database
                            SET session         = :session
                            WHERE id_data_admin != :id_data_admin
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_data_admin", $id_data_admin, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

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