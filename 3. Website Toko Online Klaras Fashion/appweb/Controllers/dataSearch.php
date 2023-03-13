<?php
    require "../Config/SetWebsite.php";
    require "../Config/Db.php";
    require "../../WP-Admin/KLS/appweb/Libraries/others.php";

    if(isset($_POST["limit"], $_POST["start"], $_POST["KeywordSearch"])){
        $KeywordSearch = "%".$_POST["KeywordSearch"]."%";
        try {
            $query = $pdo->prepare("
                    SELECT produk.judul, produk.status, stock, sub_harga, diskon, harga, produk.gambar, produk.slug AS slugProduk, kat_produk.slug AS slugKatProduk
                    FROM produk
                    INNER JOIN kat_produk
                    ON produk.id_kat_produk = kat_produk.id_kat_produk
                    WHERE produk.judul LIKE :KeywordSearch
                    ORDER BY id_produk DESC
                    LIMIT ".$_POST["start"].", ".$_POST["limit"]."
            ");

            $query->bindParam(':KeywordSearch', $KeywordSearch, PDO::PARAM_STR);
            $query->execute();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                if ($row['status']==="Sale") {
?>
                    <div class="col-6 col-xl-4 mb-4">
                        <a href="<?= $base_url ?>/product/<?= $row['slugKatProduk'] ?>/<?= $row['slugProduk'] ?>" class="card card-hover-shadow shadow text-decoration-none">
                            <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                                <div class="ribbon ribbon-top-left"><span>Disc. <?= $row['diskon'] ?>%</span></div>
                                <img src="<?= $url_images ?>/product/<?= $row['gambar'] ?>" title="<?= $row['judul'] ?>" alt="Gambar <?= $row['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                            </div>
                            <div class="card-body p-2">
                                <h5 class="fw-bolder text-muted"><?= $row['judul'] ?></h5>
                                <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($row['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $row['diskon'] ?>%</small></h6>
                                <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($row['harga']) ?></h4>
                                <?php if ($row['stock']==="Tersedia"): ?>
                                    <small class="badge bg-primary"><i class="fa-regular fa-circle-check"></i> Tersedia</small>
                                <?php else: ?>
                                    <small class="badge bg-warning"><i class="fa-solid fa-circle-xmark"></i> Habis</small>
                                <?php endif ?>
                            </div>
                        </a>
                    </div>
<?php
                }else{
?>
                    <div class="col-6 col-xl-4 mb-4">
                        <a href="<?= $base_url ?>/product/<?= $row['slugKatProduk'] ?>/<?= $row['slugProduk'] ?>" class="card card-hover-shadow shadow text-decoration-none">
                            <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                                <img src="<?= $url_images ?>/product/<?= $row['gambar'] ?>" title="<?= $row['judul'] ?>" alt="Gambar <?= $row['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                            </div>
                            <div class="card-body p-2">
                                <h5 class="fw-bolder text-muted"><?= $row['judul'] ?></h5>
                                <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($row['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $row['diskon'] ?>%</small></h6>
                                <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($row['harga']) ?></h4>
                                <?php if ($row['stock']==="Tersedia"): ?>
                                    <small class="badge bg-primary"><i class="fa-regular fa-circle-check"></i> Tersedia</small>
                                <?php else: ?>
                                    <small class="badge bg-warning"><i class="fa-solid fa-circle-xmark"></i> Habis</small>
                                <?php endif ?>
                            </div>
                        </a>
                    </div>
<?php
                }
            }
        } catch (Exception $e) {
            var_dump($e);
        }
    }
?>