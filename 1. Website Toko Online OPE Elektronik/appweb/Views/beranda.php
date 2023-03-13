<?php
    try {
        $stmt  = $pdo->prepare("
                    SELECT judul, gambar
                    FROM page
                    WHERE id_page = ?
                ");

        $stmt->bindValue(1, $_GET['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e) {
        var_dump($e);
        die();
        exit();
    }
?>

<section class="container-fluid px-0">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
            <?php
                $no             = 1;
                try {
                    $querySlider = $pdo->prepare("
                            SELECT produk.judul AS judulProduk, produk.gambar AS gambarproduk, produk.slug AS slugProduk, kat_produk.judul AS judulKatProduk, kat_produk.slug AS slugKatProduk
                            FROM produk
                            INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                            ORDER BY view DESC
                            LIMIT 5");

                    $querySlider->execute();
                    while($resultSlider = $querySlider->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="carousel-item <?php if ($no==1) { echo 'active'; } ?>">
                <div class="card bg-dark text-white rounded-0">
                    <div class="card-header img-card-img-overlay card-header-blog-xxxl p-0">
                        <img src="<?= $url_images ?>/produk/<?= $resultSlider['gambarproduk'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultSlider['judulProduk'] ?>">
                    </div>
                    <div class="card-img-overlay text-center">
                        <a href="<?= $base_url ?>/produk/<?= $resultSlider['slugKatProduk'] ?>/<?= $resultSlider['slugProduk'] ?>" class="text-decoration-none link-light">
                            <div class="container">
                                <span class="badge bg-success mb-2"><i class="fas fa-tag"></i> <?= $resultSlider['judulKatProduk'] ?></span>
                                <h1 class="fw-bolder"><?= $resultSlider['judulProduk'] ?></h1>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                        $no++;
                    }
                } catch (Exception $e) {
                    var_dump($e);
                }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section class="container px-md-0 my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="mb-0 fw-bold text-light">Produk Terbaru</h4>
                </div>
                <div class="card-body px-0">
                    <?php
                        try {
                            $queryProdukTerbaru = $pdo->prepare("
                                    SELECT produk.judul AS judulProduk, produk.gambar AS gambarproduk, deskripsi, produk.slug AS slugProduk, kat_produk.judul AS judulKatProduk, kat_produk.slug AS slugKatProduk
                                    FROM produk
                                    INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                                    ORDER BY id_produk DESC");

                            $queryProdukTerbaru->execute();
                            while($resultProdukTerbaru = $queryProdukTerbaru->fetch(PDO::FETCH_ASSOC)){
                                $deskripsi      = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$resultProdukTerbaru["deskripsi"])));
                                $myDeskripsi    = substr($deskripsi,0,strrpos(substr($deskripsi,0,100)," "))." ...";
                    ?>
                    <div class="card my-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-header card-header-blog-sm p-0">
                                    <img src="<?= $url_images ?>/produk/<?= $resultProdukTerbaru['gambarproduk'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultProdukTerbaru['judulProduk'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a href="<?= $base_url ?>/produk/<?= $resultProdukTerbaru['slugKatProduk'] ?>/<?= $resultProdukTerbaru['slugProduk'] ?>" class="text-decoration-none link-dark-card">
                                    <div class="container">
                                        <h5 class="fw-bolder"><?= $resultProdukTerbaru['judulProduk'] ?></h5>
                                        <div class="d-flex justify-content-between mb-3">
                                            <small class="badge bg-success fw-normal"><i class="fas fa-tag"></i> <?= $resultProdukTerbaru['judulKatProduk'] ?></small>
                                        </div>
                                        <p class="fw-normal"><?= $myDeskripsi ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        } catch (Exception $e) {
                            var_dump($e);
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sticky-top-sidebar">
                <div class="card-header bg-success">
                    <h4 class="mb-0 fw-bold text-light">Produk Populer</h4>
                </div>
                <div class="card-body">
                    
                    <?php
                        try {
                            $queryProdukPopuler = $pdo->prepare("
                                    SELECT produk.judul AS judulProduk, produk.gambar AS gambarproduk, deskripsi, produk.slug AS slugProduk, kat_produk.judul AS judulKatProduk, kat_produk.slug AS slugKatProduk
                                    FROM produk
                                    INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                                    ORDER BY view DESC
                                    LIMIT 5");

                            $queryProdukPopuler->execute();
                            while($resultProdukPopuler = $queryProdukPopuler->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="card my-3">
                        <div class="card-header card-header-blog-sm p-0 mb-3">
                            <img src="<?= $url_images ?>/produk/<?= $resultProdukPopuler['gambarproduk'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultProdukPopuler['judulProduk'] ?>">
                        </div>
                        <a href="<?= $base_url ?>/produk/<?= $resultProdukPopuler['slugKatProduk'] ?>/<?= $resultProdukPopuler['slugProduk'] ?>" class="text-decoration-none link-dark-card">
                            <h6 class="fw-bolder"><?= $resultProdukPopuler['judulProduk'] ?></h6>
                            <div class="d-flex justify-content-between mb-3">
                                <small class="badge bg-success fw-normal"><i class="fas fa-tag"></i> <?= $resultProdukPopuler['judulKatProduk'] ?></small>
                            </div>
                        </a>
                    </div>
                    <?php
                            }
                        } catch (Exception $e) {
                            var_dump($e);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>