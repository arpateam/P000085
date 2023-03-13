<?php
    require "../Config/SetWebsite.php";
    require "../Config/Db.php";
    require "../../WP-Admin/KLS/appweb/Libraries/others.php";

    if(isset($_POST["limit"], $_POST["start"])){
        try{
            $query = $pdo->prepare("
                    SELECT
                        judul, gambar, slug , views, tgl_terbit
                    FROM blog
                    ORDER BY id_blog DESC
                    LIMIT ".$_POST["start"].", ".$_POST["limit"]."
            ");

            $query->execute();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo '
                    <div class="col-md-6 col-lg-4 my-3">
                        <div class="card card-hover-shadow shadow">
                            <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                                <img src="'.$url_images.'/blog/'.$row['gambar'].'" alt="Gambar Blog '.$row['judul'].'" class="img-fluid image-zoom-on-hover rounded-top-5">
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <a href="'.$base_url.'/blog/'.$row['slug'].'" title="'.$row['judul'].'" class="link-dark-card fs-4">'.$row['judul'].'</a>
                                </div>
                                <div class="card-body p-0 mt-4">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">'.indoTgl($row['tgl_terbit']).'</small>
                                        <small class="text-muted"><i class="fa-solid fa-eye"></i> '.rp($row['views']).'x</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        } catch (Exception $e) {
            var_dump($e);
        }
    }