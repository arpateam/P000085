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
    }elseif((isset($_POST['_submit_special_ARPATEAM_'])) OR ($_GET['act']==="aktifkan-metode-pembayaran") OR ($_GET['act']==="non-aktifkan-metode-pembayaran")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-metode-pembayaran":

                // Data file
                $link               = $base_url_admin."/metode-pembayaran";
                $penyimpananGambar  = "../../../../assets/files/images/payment-method";
                $database           = "metode_pembayaran";
                // Data file

                $no_urut            = htmlspecialchars($_POST['___in_no_urut_special_ARPATEAM']);
                $jenis_pembayaran   = htmlspecialchars($_POST['___in_jenis_pembayaran_special_ARPATEAM']);
                $no_rekening        = htmlspecialchars($_POST['___in_no_rekening_special_ARPATEAM']);
                $atas_nama          = htmlspecialchars($_POST['___in_atas_nama_special_ARPATEAM']);
                $status             = htmlspecialchars($_POST['___in_status_metode_pembayaran_special_ARPATEAM']);

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = seo($jenis_pembayaran)."-".seo($atas_nama).".".$tipe_file2;

                    // Cek jenis file yang di upload
                    cekFile($tipe_file);
                    // Cek jenis file yang di upload

                    // Cek ukuran file yang di upload
                    cekUkuranFile2mb($ukuran);
                    // Cek ukuran file yang di upload

                    $gambar = $nama_file_unik;
                // Gambar

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (no_urut,jenis_pembayaran,gambar,no_rekening,atas_nama,status)
                                    VALUES(:no_urut,:jenis_pembayaran,:gambar,:no_rekening,:atas_nama,:status)" );
                            
                    $stmt->bindParam(":no_urut", $no_urut, PDO::PARAM_STR);
                    $stmt->bindParam(":jenis_pembayaran", $jenis_pembayaran, PDO::PARAM_STR);
                    $stmt->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $stmt->bindParam(":no_rekening", $no_rekening, PDO::PARAM_STR);
                    $stmt->bindParam(":atas_nama", $atas_nama, PDO::PARAM_STR);
                    $stmt->bindParam(":status", $status, PDO::PARAM_STR);

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

                break;

            case "edit-metode-pembayaran":

                $id_metode_pembayaran   = $_POST['___in_id_metode_pembayaran_special_ARPATEAM'];

                // Data file
                $link               = $base_url_admin."/metode-pembayaran";
                $penyimpananGambar  = "../../../../assets/files/images/payment-method";
                $database           = "metode_pembayaran";
                // Data file

                $no_urut            = htmlspecialchars($_POST['___in_no_urut_special_ARPATEAM']);
                $jenis_pembayaran   = htmlspecialchars($_POST['___in_jenis_pembayaran_special_ARPATEAM']);
                $no_rekening        = htmlspecialchars($_POST['___in_no_rekening_special_ARPATEAM']);
                $atas_nama          = htmlspecialchars($_POST['___in_atas_nama_special_ARPATEAM']);
                $status             = htmlspecialchars($_POST['___in_status_metode_pembayaran_special_ARPATEAM']);

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                    $nama_file_unik = seo($jenis_pembayaran)."-".seo($atas_nama).".".$tipe_file2;

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

                try {
                    $sql = "UPDATE $database
                            SET no_urut             = :no_urut,
                                jenis_pembayaran    = :jenis_pembayaran,
                                gambar              = :gambar,
                                no_rekening         = :no_rekening,
                                atas_nama           = :atas_nama,
                                status              = :status
                            WHERE id_$database      = :id_metode_pembayaran
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_metode_pembayaran", $id_metode_pembayaran, PDO::PARAM_INT);
                    $statement->bindParam(":no_urut", $no_urut, PDO::PARAM_STR);
                    $statement->bindParam(":jenis_pembayaran", $jenis_pembayaran, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $statement->bindParam(":no_rekening", $no_rekening, PDO::PARAM_STR);
                    $statement->bindParam(":atas_nama", $atas_nama, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    var_dump($e);
                    exit();
                    $_SESSION['_msg__']  = "Gagal";
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            case "aktifkan-metode-pembayaran":

                $id_metode_pembayaran  = $_GET['id'];

                // Data file
                $link       = $base_url_admin."/metode-pembayaran";
                $database   = "metode_pembayaran";
                // Data file

                $status     = "Active";

                try {
                    $sql = "UPDATE $database
                            SET status  = :status
                            WHERE id_metode_pembayaran = :id_metode_pembayaran
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_metode_pembayaran", $id_metode_pembayaran, PDO::PARAM_STR);
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
            
            case "non-aktifkan-metode-pembayaran":

                $id_metode_pembayaran  = $_GET['id'];

                // Data file
                $link       = $base_url_admin."/metode-pembayaran";
                $database   = "metode_pembayaran";
                // Data file

                $status     = "Non-Active";

                try {
                    $sql = "UPDATE $database
                            SET status  = :status
                            WHERE id_metode_pembayaran = :id_metode_pembayaran
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_metode_pembayaran", $id_metode_pembayaran, PDO::PARAM_STR);
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

            case "reset-session":
                // Data file
                $link       = $base_url_admin."/metode-pembayaran";
                $database   = "metode_pembayaran";
                // Data file

                $id_metode_pembayaran  = 1;
                $session        = NULL;

                try {
                    $sql = "UPDATE $database
                            SET session         = :session
                            WHERE id_metode_pembayaran != :id_metode_pembayaran
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_metode_pembayaran", $id_metode_pembayaran, PDO::PARAM_STR);

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