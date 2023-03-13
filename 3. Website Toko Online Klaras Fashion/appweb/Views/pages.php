<?php
    switch ($_GET['view']) {
        case "how-to-order":
?>

<div class="container-fluid p-0">
    <div class="card bg-dark text-white rounded-0">
        <div class="card-header img-card-img-overlay card-header-blog-xl p-0">
            <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>" data-aos="fade-up" data-aos-duration="2000">
        </div>
        <div class="card-img-overlay-V2 text-center">
            <div class="container">
                <h1 class="fw-bolder" data-aos="fade-up" data-aos-duration="1500"><?= $seo['judul'] ?></h1>
                <h3 class="fw-bolder" data-aos="fade-up" data-aos-duration="3000">at <?= $nama_web ?></h3>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid mt--10 mb-5">
    <div class="container bg-white shadow-top rounded-5 p-2 p-lg-4" style="position: relative !important;z-index: 1000 !important;" data-aos="fade-up" data-aos-duration="2000">
        <div class="row justify-content-center p-3 p-lg-0">
            <div class="col-12 col-lg-10 py-3 text-muted" data-aos="fade-up" data-aos-duration="2000">
                <?= $seo["deskripsi"] ?>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "payment-method":
?>

<div class="container-fluid p-0">
    <div class="card bg-dark text-white rounded-0">
        <div class="card-header img-card-img-overlay card-header-blog-xl p-0">
            <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>" data-aos="fade-up" data-aos-duration="2000">
        </div>
        <div class="card-img-overlay-V2 text-center">
            <div class="container">
                <h1 class="fw-bolder" data-aos="fade-up" data-aos-duration="1500"><?= $seo['judul'] ?></h1>
                <h3 class="fw-bolder" data-aos="fade-up" data-aos-duration="3000">at <?= $nama_web ?></h3>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid mt--10 mb-5">
    <div class="container bg-white shadow-top rounded-5 p-2 p-lg-4" style="position: relative !important;z-index: 1000 !important;">
        <div class="row justify-content-center">
            <?php
                try{
                    $stmtMetodePembayaran = $pdo->prepare("
                            SELECT jenis_pembayaran, gambar, no_rekening, atas_nama
                            FROM metode_pembayaran
                            WHERE status = ?
                            ORDER BY no_urut ASC
                    ");

                    $stmtMetodePembayaran->bindValue(1, "Active");
                    $stmtMetodePembayaran->execute();
                    while($resultMetodePembayaran = $stmtMetodePembayaran->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="col-sm-6 col-lg-4 p-4 p-sm-3 p-lg-4" data-aos="fade-up" data-aos-duration="2000">
                <div class="card text-center card-hover-v2 border">
                    <img src="<?= $url_images ?>/payment-method/<?= $resultMetodePembayaran['gambar'] ?>" title="<?= $resultMetodePembayaran['jenis_pembayaran'] ?>" alt="Gambar <?= $resultMetodePembayaran['jenis_pembayaran'] ?>" class="card-img-hover-v2">
                    <div class="card-body text-muted py-5">
                        <img src="<?= $url_images ?>/payment-method/<?= $resultMetodePembayaran['gambar'] ?>" title="<?= $resultMetodePembayaran['jenis_pembayaran'] ?>" alt="Gambar <?= $resultMetodePembayaran['jenis_pembayaran'] ?>" class="w-50">
                        <h4 class="card-title fw-bolder mt-4 mb-2"><?= $resultMetodePembayaran['no_rekening'] ?></h4>
                        <h5><small class="fs-6">a/n</small> <?= $resultMetodePembayaran['atas_nama'] ?></h5>
                    </div>
                </div>
            </div>
            <?php
                    }
                }catch(Exception $e){
                    var_dump($e);
                }
            ?>
        </div>
    </div>
</section>

<?php
            break;
        case "about-us":
?>

<div class="container-fluid p-0">
    <div class="card bg-dark text-white rounded-0">
        <div class="card-header img-card-img-overlay card-header-blog-xl p-0">
            <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>" data-aos="fade-up" data-aos-duration="2000">
        </div>
        <div class="card-img-overlay-V2 text-center">
            <div class="container">
                <h1 class="fw-bolder" data-aos="fade-up" data-aos-duration="1500"><?= $seo['judul'] ?></h1>
                <h3 class="fw-bolder" data-aos="fade-up" data-aos-duration="3000">at <?= $nama_web ?></h3>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid mt--10">
    <div class="container bg-white shadow-top rounded-5 p-2 p-lg-4" style="position: relative !important;z-index: 1000 !important;">
        <div class="row justify-content-between py-0 py-lg-4">
            <div class="col-lg-5 col-xl-4 my-auto text-center" data-aos="fade-in" data-aos-duration="2000">
                <img src="<?= $url_images ?>/<?= $logoDesktop ?>" title="<?= $judulLogoDesktop; ?>" alt="Gambar <?= $judulLogoDesktop; ?>" class="w-100 p-2 p-sm-5 p-lg-0">
            </div>
            <div class="col-lg-7 my-auto text-muted text-center text-lg-end" data-aos="fade-in" data-aos-duration="2000">
                <h1 class="fw-bolder text-primary"><?= $nama_web; ?></h1>
                <h3 class="my-4"><?= $slogan; ?></h3>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid bg-danger py-5" data-aos="fade-up" data-aos-duration="3000">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center py-4">
            <div class="col-md-10" data-aos="fade-up" data-aos-duration="2000">
                <?= $seo["deskripsi"] ?>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        default:
    }
?>