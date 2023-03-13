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
    }elseif((isset($_POST['_submit_special_ARPATEAM_']))){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "edit-pengaturan":

                // Data file
                $link               = $base_url_admin."/pengaturan";
                $penyimpananGambar  = "../../../../assets/files/images";
                $database           = "pengaturan";
                // Data file

                $id_pengaturan      = htmlspecialchars($_POST['___in_id_pengaturan_special_ARPATEAM']);
                $judul              = $_POST['___in_judul_special_ARPATEAM'];
                $jenis_pengaturan   = $_POST['___in_jenis_pengaturan_special_ARPATEAM'];

                if ($jenis_pengaturan==="Gambar") {
                    // Gambar
                        $lokasi_file    = $_FILES['___in_gambar_special_ARPATEAM']['tmp_name'];
                        $lokasi_upload  = "$penyimpananGambar/";
                        $nama_file      = $_FILES['___in_gambar_special_ARPATEAM']['name'];
                        $tipe_file      = strtolower($_FILES['___in_gambar_special_ARPATEAM']['type']);
                        $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                        $ukuran         = $_FILES['___in_gambar_special_ARPATEAM']['size'];
                        $nama_file_unik = seo($judul).".".$tipe_file2;

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
                    $deskripsi  = NULL;
                }else{
                    $deskripsi  = $_POST['___in_deskripsi_special_ARPATEAM'];
                    $gambar     = NULL;
                }

                try {
                    $sql = "UPDATE $database
                            SET judul           = :judul,
                                gambar          = :gambar,
                                deskripsi       = :deskripsi,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_pengaturan
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_pengaturan", $id_pengaturan, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $statement->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);

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