<header class="container-fluid p-0" data-aos="fade-up" data-aos-duration="2500">
    <div class="card bg-dark text-white rounded-0">
        <div class="card-header img-card-img-overlay card-header-blog-xxl p-0">
            <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>">
        </div>
        <div class="card-img-overlay-V3">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-7 col-xl-6 text-light" style="position: relative !important;z-index: 1020 !important">
                        <h1 class="fw-bolder text-uppercase" data-aos="fade-up" data-aos-duration="1500"><?= $nama_web ?></h1>
                        <h3 data-aos="fade-up" data-aos-duration="2500">- <?= $slogan ?></h3>
                        <h4 class="fw-bolder mt-4" data-aos="fade-up" data-aos-duration="1500">Show Your Luxury in a Simple Way</h4>
                        <h5 data-aos="fade-up" data-aos-duration="1500">Gives an Elegant and Beautiful Impression to Every Wearer #KlarasFashion</h5>
                        <div class="d-none d-lg-inline">
                            <a href="<?= $base_url ?>/#promo" title="Get Promo" class="btn btn-lg btn-outline-danger mt-3 text-uppercase" data-aos="fade-up" data-aos-duration="3500"><i class="fa-solid fa-tag"></i> Get Promo</a>
                        </div>
                        <div class="d-inline d-lg-none">
                            <a href="<?= $base_url ?>/#promo" title="Get Promo" class="btn btn-danger mt-3 text-uppercase" data-aos="fade-up" data-aos-duration="3500"><i class="fa-solid fa-tag"></i> Get Promo</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-6 mt-10 d-none d-lg-inline text-end" data-aos="fade-up" data-aos-duration="2000">
                        <img src="<?= $url_images; ?>/pages/<?= $seo['gambar']; ?>" title="<?= $seo['judul']; ?>" alt="Gambar <?= $seo['judul']; ?>" class="img-fluid rounded-5 shadow-lg">
                    </div>
                    <div class="col-lg-5 col-xl-6 mt--5 d-inline d-lg-none text-end" data-aos="fade-up" data-aos-duration="2000">
                        <img src="<?= $url_images; ?>/pages/<?= $seo['gambar']; ?>" title="<?= $seo['judul']; ?>" alt="Gambar <?= $seo['judul']; ?>" class="w-75 rounded-5 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="container-fluid mt--10">
    <div class="container rounded-5 px-0 px-sm-2">
        <section class="row category rounded-5 bg-white shadow p-1 p-lg-3">
            <?php
                try{
                    $stmtCategory = $pdo->prepare("
                            SELECT judul, gambar, slug
                            FROM kat_produk
                    ");

                    $stmtCategory->execute();
                    while($resultCategory = $stmtCategory->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="card bg-dark text-white rounded-5 m-1 m-lg-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card-header img-card-img-overlay card-header-blog-lg p-0 rounded-5">
                    <img src="<?= $url_images ?>/category/<?= $resultCategory['gambar'] ?>" class="card-img rounded-5 shadow" alt="Gambar <?= $resultCategory['judul'] ?>">
                </div>
                <div class="card-img-overlay text-center">
                    <a href="<?= $base_url ?>/category/<?= $resultCategory['slug'] ?>" class="text-decoration-none link-light">
                        <div class="container">
                            <span class="badge bg-danger"><i class="fas fa-tag"></i> <?= $resultCategory['judul'] ?></span>
                            <h1 class="fw-bolder mt-2"><?= $resultCategory['judul'] ?></h1>
                        </div>
                    </a>
                </div>
            </div>
            <?php
                    }
                }catch(Exception $e){
                    var_dump($e);
                }
            ?>
        </section>
    </div>
</section>

<section class="container-fluid my-5">
    <div class="container px-0 px-sm-2 mt-5">
        <div class="row justify-content-between mt-5">
            <div class="col-md-auto">
                <h3 class="fw-bolder text-danger" data-aos="fade-up" data-aos-duration="1500">New Arrivals</h3>
            </div>
            <div class="col-md-auto">
                <a href="<?= $base_url ?>/new-arrivals" title="Other Products" class="btn btn-sm btn-outline-danger" data-aos="fade-up" data-aos-duration="2500">Other Products <i class="fa-solid fa-angles-right"></i></a>
            </div>
        </div>

        <section class="row new-arrivals">
            <?php
                $queryNewArrivals = $pdo->query("
                        SELECT produk.judul, produk.status, stock, sub_harga, diskon, harga, produk.gambar, produk.slug AS slugProduk, kat_produk.slug AS slugKatProduk
                        FROM produk
                        INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                        ORDER BY id_produk DESC
                        LIMIT 8
                ");
                while($resultNewArrivals = $queryNewArrivals->fetch(PDO::FETCH_ASSOC)){
                    if ($resultNewArrivals['status']==="Sale") {
            ?>

            <div class="col-6 col-lg-4 col-xl-3 my-3 mx-2" data-aos="fade-up" data-aos-duration="2500">
                <a href="<?= $base_url ?>/product/<?= $resultNewArrivals['slugKatProduk'] ?>/<?= $resultNewArrivals['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <div class="ribbon ribbon-top-left"><span>Disc. <?= $resultNewArrivals['diskon'] ?>%</span></div>
                        <img src="<?= $url_images ?>/product/<?= $resultNewArrivals['gambar'] ?>" title="<?= $resultNewArrivals['judul'] ?>" alt="Gambar <?= $resultNewArrivals['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultNewArrivals['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultNewArrivals['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultNewArrivals['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultNewArrivals['harga']) ?></h4>
                        <?php if ($resultNewArrivals['stock']==="Tersedia"): ?>
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

            <div class="col-6 col-lg-4 col-xl-3 my-3 mx-2" data-aos="fade-up" data-aos-duration="1500">
                <a href="<?= $base_url ?>/product/<?= $resultNewArrivals['slugKatProduk'] ?>/<?= $resultNewArrivals['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <img src="<?= $url_images ?>/product/<?= $resultNewArrivals['gambar'] ?>" title="<?= $resultNewArrivals['judul'] ?>" alt="Gambar <?= $resultNewArrivals['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultNewArrivals['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultNewArrivals['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultNewArrivals['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultNewArrivals['harga']) ?></h4>
                        <?php if ($resultNewArrivals['stock']==="Tersedia"): ?>
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
            ?>
        </section>
    </div>
</section>

<section id="promo" class="container-fluid bg-danger mt-5 py-5" data-aos="fade-in" data-aos-duration="1500">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-between">
            <div class="col-md-auto">
                <h3 class="fw-bolder text-light" data-aos="fade-up" data-aos-duration="1500">Product Discount</h3>
            </div>
            <div class="col-md-auto">
                <a href="<?= $base_url ?>/sale" title="Other Products" class="btn btn-sm btn-outline-light" data-aos="fade-up" data-aos-duration="2500">Other Products <i class="fa-solid fa-angles-right"></i></a>
            </div>
        </div>

        <section class="row sale">
            <?php
                $queryBestSeller = $pdo->query("
                        SELECT produk.judul, produk.status, stock, sub_harga, diskon, harga, produk.gambar, produk.slug AS slugProduk, kat_produk.slug AS slugKatProduk
                        FROM produk
                        INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                        WHERE produk.status='Sale'
                        ORDER BY view DESC
                        LIMIT 8
                ");

                while($resultBestSeller = $queryBestSeller->fetch(PDO::FETCH_ASSOC)){
                    if ($resultBestSeller['status']==="Sale") {
            ?>

            <div class="col-6 col-lg-4 col-xl-3 my-3 mx-2" data-aos="fade-up" data-aos-duration="2500">
                <a href="<?= $base_url ?>/product/<?= $resultBestSeller['slugKatProduk'] ?>/<?= $resultBestSeller['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <div class="ribbon ribbon-top-left"><span>Disc. <?= $resultBestSeller['diskon'] ?>%</span></div>
                        <img src="<?= $url_images ?>/product/<?= $resultBestSeller['gambar'] ?>" title="<?= $resultBestSeller['judul'] ?>" alt="Gambar <?= $resultBestSeller['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultBestSeller['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultBestSeller['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultBestSeller['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultBestSeller['harga']) ?></h4>
                        <?php if ($resultBestSeller['stock']==="Tersedia"): ?>
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

            <div class="col-6 col-lg-4 col-xl-3 my-3 mx-2" data-aos="fade-up" data-aos-duration="1500">
                <a href="<?= $base_url ?>/product/<?= $resultBestSeller['slugKatProduk'] ?>/<?= $resultBestSeller['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <img src="<?= $url_images ?>/product/<?= $resultBestSeller['gambar'] ?>" title="<?= $resultBestSeller['judul'] ?>" alt="Gambar <?= $resultBestSeller['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultBestSeller['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultBestSeller['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultBestSeller['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultBestSeller['harga']) ?></h4>
                        <?php if ($resultBestSeller['stock']==="Tersedia"): ?>
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
            ?>
        </section>
    </div>
</section>

<section class="container-fluid bg-warning py-5" data-aos="fade-in" data-aos-duration="1500">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-between">
            <div class="col-md-auto">
                <h3 class="fw-bolder text-light" data-aos="fade-up" data-aos-duration="1500">Best Seller</h3>
            </div>
            <div class="col-md-auto">
                <a href="<?= $base_url ?>/best-seller" title="Other Products" class="btn btn-sm btn-outline-light" data-aos="fade-up" data-aos-duration="2500">Other Products <i class="fa-solid fa-angles-right"></i></a>
            </div>
        </div>

        <section class="row best-seller">
            <?php
                $queryBestSeller = $pdo->query("
                        SELECT produk.judul, produk.status, stock, sub_harga, diskon, harga, produk.gambar, produk.slug AS slugProduk, kat_produk.slug AS slugKatProduk
                        FROM produk
                        INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                        ORDER BY view DESC
                        LIMIT 8
                ");
                while($resultBestSeller = $queryBestSeller->fetch(PDO::FETCH_ASSOC)){
                    if ($resultBestSeller['status']==="Sale") {
            ?>

            <div class="col-6 col-lg-4 col-xl-3 my-3 mx-2" data-aos="fade-up" data-aos-duration="2500">
                <a href="<?= $base_url ?>/product/<?= $resultBestSeller['slugKatProduk'] ?>/<?= $resultBestSeller['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <div class="ribbon ribbon-top-left"><span>Disc. <?= $resultBestSeller['diskon'] ?>%</span></div>
                        <img src="<?= $url_images ?>/product/<?= $resultBestSeller['gambar'] ?>" title="<?= $resultBestSeller['judul'] ?>" alt="Gambar <?= $resultBestSeller['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultBestSeller['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultBestSeller['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultBestSeller['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultBestSeller['harga']) ?></h4>
                        <?php if ($resultBestSeller['stock']==="Tersedia"): ?>
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

            <div class="col-6 col-lg-4 col-xl-3 my-3 mx-2" data-aos="fade-up" data-aos-duration="1500">
                <a href="<?= $base_url ?>/product/<?= $resultBestSeller['slugKatProduk'] ?>/<?= $resultBestSeller['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <img src="<?= $url_images ?>/product/<?= $resultBestSeller['gambar'] ?>" title="<?= $resultBestSeller['judul'] ?>" alt="Gambar <?= $resultBestSeller['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultBestSeller['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultBestSeller['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultBestSeller['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultBestSeller['harga']) ?></h4>
                        <?php if ($resultBestSeller['stock']==="Tersedia"): ?>
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
            ?>
        </section>
    </div>
</section>

<section class="container-fluid bg-light py-4 py-md-5" data-aos="fade-in" data-aos-duration="1500">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center mb-2">
                <h3 class="fw-bolder text-danger" data-aos="fade-up" data-aos-duration="1500">All Products</h3>
            </div>
            <div class="col-md-12 mb-2">
                <form action="<?= $base_url ?>/search" method="POST" data-parsley-validate="" data-aos="fade-up" data-aos-duration="2500">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control bg-light border-danger text-danger" placeholder="Search product ..." name="query" aria-label="Search product ..." aria-describedby="basic-addon1">
                        <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-danger" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="load_data row">
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="load_data_message"></div>
            </div>
        </div>
    </div>
</section>