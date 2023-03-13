<?php
    switch ($_GET['view']) {
        case "new-arrivals":
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-danger rounded-5" data-aos="fade-up" data-aos-duration="2500">
                    <div class="row">
                        <div class="col-5 col-md-4 col-xl-3 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card">
                                <div class="card-header card-header-blog rounded-start-5 p-0">
                                    <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-md-8 col-xl-9 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <h1 class="fw-bolder text-danger"><?= $seo['judul'] ?></h1>
                            <p class="text-muted"><?= $seo['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3 my-3 d-none d-lg-inline">
                <div class="card p-3 sticky-top-sidebar border border-danger rounded-5" data-aos="fade-up" data-aos-duration="1500">
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/new-arrivals" title="New Arrivals" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> New Arrivals</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/best-seller" title="Best Seller" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Best Seller</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/sale" title="Sale" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Sale</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/all-products" title="All Products" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> All Products</a>
                    </nav>
                    <h6 class="fw-bolder bg-danger p-2 text-light rounded-5" data-aos="fade-up" data-aos-duration="2000">Category</h6>
                    <nav class="nav flex-column" data-aos="fade-up" data-aos-duration="2000">
                        <?php
                            try{
                                $stmtKatProduk = $pdo->prepare("
                                        SELECT
                                            judul, slug
                                        FROM kat_produk
                                ");

                                $stmtKatProduk->execute();
                                while($resultKatProduk = $stmtKatProduk->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a class="nav-link border-bottom <?php if ($_GET['module']=='produk' AND $_GET['view']=="detail-category"){ if($resultKatProduk['slug']===$_GET['slug']){ echo 'link-danger'; }else{ echo 'link-secondary'; } } else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/category/<?= $resultKatProduk['slug'] ?>" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> <?= $resultKatProduk['judul'] ?></a>
                        <?php
                                }
                            }catch(Exception $e){
                                var_dump($e);
                            }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-lg-8 col-xl-9 ps-lg-3 ps-xl-4 my-3">
                <div class="card p-0">
                    <div class="load_data row">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="load_data_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "best-seller":
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-danger rounded-5" data-aos="fade-up" data-aos-duration="2500">
                    <div class="row">
                        <div class="col-5 col-md-4 col-xl-3 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card">
                                <div class="card-header card-header-blog rounded-start-5 p-0">
                                    <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-md-8 col-xl-9 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <h1 class="fw-bolder text-danger"><?= $seo['judul'] ?></h1>
                            <p class="text-muted"><?= $seo['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3 my-3 d-none d-lg-inline">
                <div class="card p-3 sticky-top-sidebar border border-danger rounded-5" data-aos="fade-up" data-aos-duration="1500">
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/new-arrivals" title="New Arrivals" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> New Arrivals</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/best-seller" title="Best Seller" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Best Seller</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/sale" title="Sale" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Sale</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/all-products" title="All Products" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> All Products</a>
                    </nav>
                    <h6 class="fw-bolder bg-danger p-2 text-light rounded-5" data-aos="fade-up" data-aos-duration="2000">Category</h6>
                    <nav class="nav flex-column" data-aos="fade-up" data-aos-duration="2000">
                        <?php
                            try{
                                $stmtKatProduk = $pdo->prepare("
                                        SELECT
                                            judul, slug
                                        FROM kat_produk
                                ");

                                $stmtKatProduk->execute();
                                while($resultKatProduk = $stmtKatProduk->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a class="nav-link border-bottom <?php if ($_GET['module']=='produk' AND $_GET['view']=="detail-category"){ if($resultKatProduk['slug']===$_GET['slug']){ echo 'link-danger'; }else{ echo 'link-secondary'; } } else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/category/<?= $resultKatProduk['slug'] ?>" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> <?= $resultKatProduk['judul'] ?></a>
                        <?php
                                }
                            }catch(Exception $e){
                                var_dump($e);
                            }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-lg-8 col-xl-9 ps-lg-3 ps-xl-4 my-3">
                <div class="card p-0">
                    <div class="load_data row">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="load_data_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "sale":
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-danger rounded-5" data-aos="fade-up" data-aos-duration="2500">
                    <div class="row">
                        <div class="col-5 col-md-4 col-xl-3 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card">
                                <div class="card-header card-header-blog rounded-start-5 p-0">
                                    <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-md-8 col-xl-9 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <h1 class="fw-bolder text-danger"><?= $seo['judul'] ?></h1>
                            <p class="text-muted"><?= $seo['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3 my-3 d-none d-lg-inline">
                <div class="card p-3 sticky-top-sidebar border border-danger rounded-5" data-aos="fade-up" data-aos-duration="1500">
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/new-arrivals" title="New Arrivals" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> New Arrivals</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/best-seller" title="Best Seller" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Best Seller</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/sale" title="Sale" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Sale</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/all-products" title="All Products" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> All Products</a>
                    </nav>
                    <h6 class="fw-bolder bg-danger p-2 text-light rounded-5" data-aos="fade-up" data-aos-duration="2000">Category</h6>
                    <nav class="nav flex-column" data-aos="fade-up" data-aos-duration="2000">
                        <?php
                            try{
                                $stmtKatProduk = $pdo->prepare("
                                        SELECT
                                            judul, slug
                                        FROM kat_produk
                                ");

                                $stmtKatProduk->execute();
                                while($resultKatProduk = $stmtKatProduk->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a class="nav-link border-bottom <?php if ($_GET['module']=='produk' AND $_GET['view']=="detail-category"){ if($resultKatProduk['slug']===$_GET['slug']){ echo 'link-danger'; }else{ echo 'link-secondary'; } } else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/category/<?= $resultKatProduk['slug'] ?>" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> <?= $resultKatProduk['judul'] ?></a>
                        <?php
                                }
                            }catch(Exception $e){
                                var_dump($e);
                            }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-lg-8 col-xl-9 ps-lg-3 ps-xl-4 my-3">
                <div class="card p-0">
                    <div class="load_data row">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="load_data_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "all-products":
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-danger rounded-5" data-aos="fade-up" data-aos-duration="2500">
                    <div class="row">
                        <div class="col-5 col-md-4 col-xl-3 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card">
                                <div class="card-header card-header-blog rounded-start-5 p-0">
                                    <img src="<?= $url_images ?>/pages/<?= $seo['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $seo['judul'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-md-8 col-xl-9 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <h1 class="fw-bolder text-danger"><?= $seo['judul'] ?></h1>
                            <p class="text-muted"><?= $seo['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3 my-3 d-none d-lg-inline">
                <div class="card p-3 sticky-top-sidebar border border-danger rounded-5" data-aos="fade-up" data-aos-duration="1500">
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/new-arrivals" title="New Arrivals" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> New Arrivals</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/best-seller" title="Best Seller" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Best Seller</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/sale" title="Sale" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Sale</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/all-products" title="All Products" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> All Products</a>
                    </nav>
                    <h6 class="fw-bolder bg-danger p-2 text-light rounded-5" data-aos="fade-up" data-aos-duration="2000">Category</h6>
                    <nav class="nav flex-column" data-aos="fade-up" data-aos-duration="2000">
                        <?php
                            try{
                                $stmtKatProduk = $pdo->prepare("
                                        SELECT
                                            judul, slug
                                        FROM kat_produk
                                ");

                                $stmtKatProduk->execute();
                                while($resultKatProduk = $stmtKatProduk->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a class="nav-link border-bottom <?php if ($_GET['module']=='produk' AND $_GET['view']=="detail-category"){ if($resultKatProduk['slug']===$_GET['slug']){ echo 'link-danger'; }else{ echo 'link-secondary'; } } else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/category/<?= $resultKatProduk['slug'] ?>" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> <?= $resultKatProduk['judul'] ?></a>
                        <?php
                                }
                            }catch(Exception $e){
                                var_dump($e);
                            }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-lg-8 col-xl-9 ps-lg-3 ps-xl-4 my-3">
                <div class="card p-0">
                    <div class="load_data row">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="load_data_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "list-category":
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <?php
                try{
                    $stmtCategory = $pdo->prepare("
                            SELECT judul, gambar, slug
                            FROM kat_produk
                    ");

                    $stmtCategory->execute();
                    while($resultCategory = $stmtCategory->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="col-md-4 my-3">
                <a href="<?= $base_url ?>/category/<?= $resultCategory['slug'] ?>" class="card card-cover card-hover-v2 h-100 overflow-hidden text-white text-decoration-none bg-dark rounded-5 shadow-lg" style="background-image: url('<?= $url_images ?>/category/<?= $resultCategory['gambar'] ?>');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold"><?= $resultCategory['judul'] ?></h2>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="<?= $url_images ?>/<?= $icon ?>" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <span class="badge bg-white text-dark"><i class="fas fa-tag"></i> <?= $resultCategory['judul'] ?></span>
                            </li>
                        </ul>
                    </div>
                </a>
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
        case "detail-category":
            $Slug = $_GET['slug'];
            try {
                $CekKat = $pdo->prepare("
                        SELECT id_kat_produk
                        FROM kat_produk
                        WHERE slug = :Slug
                        LIMIT 1
                ");

                $CekKat->bindParam(':Slug', $Slug, PDO::PARAM_STR);
                $CekKat->execute();
                $rowCekKat = $CekKat->rowCount();
                if ($rowCekKat>0) {
                    $resultCekKat   = $CekKat->fetch(PDO::FETCH_ASSOC);
                    $KeywordSearch  = $resultCekKat['id_kat_produk'];
                }else{
                    echo "<script>window.location = '$base_url/404'</script>";
                }
            } catch (Exception $e) {
                var_dump($e);
            }
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-danger rounded-5" data-aos="fade-up" data-aos-duration="2500">
                    <div class="row">
                        <div class="col-5 col-md-4 col-xl-3 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card">
                                <div class="card-header card-header-blog rounded-start-5 p-0">
                                    <img src="<?= $url_images ?>/category/<?= $tDetail['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $tDetail['judul'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-md-8 col-xl-9 my-auto" data-aos="fade-up" data-aos-duration="1500">
                            <h1 class="fw-bolder text-danger"><?= $tDetail['judul'] ?></h1>
                            <p class="text-muted"><?= $tDetail['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3 my-3 d-none d-lg-inline">
                <div class="card p-3 sticky-top-sidebar border border-danger rounded-5" data-aos="fade-up" data-aos-duration="1500">
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/new-arrivals" title="New Arrivals" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> New Arrivals</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/best-seller" title="Best Seller" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Best Seller</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/sale" title="Sale" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Sale</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/all-products" title="All Products" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> All Products</a>
                    </nav>
                    <h6 class="fw-bolder bg-danger p-2 text-light rounded-5" data-aos="fade-up" data-aos-duration="2000">Category</h6>
                    <nav class="nav flex-column" data-aos="fade-up" data-aos-duration="2000">
                        <?php
                            try{
                                $stmtKatProduk = $pdo->prepare("
                                        SELECT
                                            judul, slug
                                        FROM kat_produk
                                ");

                                $stmtKatProduk->execute();
                                while($resultKatProduk = $stmtKatProduk->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a class="nav-link border-bottom <?php if ($_GET['module']=='produk' AND $_GET['view']=="detail-category"){ if($resultKatProduk['slug']===$_GET['slug']){ echo 'link-danger'; }else{ echo 'link-secondary'; } } else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/category/<?= $resultKatProduk['slug'] ?>" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> <?= $resultKatProduk['judul'] ?></a>
                        <?php
                                }
                            }catch(Exception $e){
                                var_dump($e);
                            }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-lg-8 col-xl-9 ps-lg-3 ps-xl-4 my-3">
                <div class="card p-0">
                    <div class="row">
                        <?php
                            $queryDetailCategory = $pdo->query("
                                    SELECT produk.judul, produk.status, stock, sub_harga, diskon, harga, produk.gambar, produk.slug AS slugProduk, kat_produk.slug AS slugKatProduk
                                    FROM produk
                                    INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                                    WHERE produk.id_kat_produk='$KeywordSearch'
                                    ORDER BY view DESC
                                    LIMIT 8
                            ");
                            while($resultDetailCategory = $queryDetailCategory->fetch(PDO::FETCH_ASSOC)){
                                if ($resultDetailCategory['status']==="Sale") {
                        ?>

                        <div class="col-6 col-xl-4 mb-4" data-aos="fade-up" data-aos-duration="2500">
                            <a href="<?= $base_url ?>/product/<?= $resultDetailCategory['slugKatProduk'] ?>/<?= $resultDetailCategory['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                                <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                                    <div class="ribbon ribbon-top-left"><span>Disc. <?= $resultDetailCategory['diskon'] ?>%</span></div>
                                    <img src="<?= $url_images ?>/product/<?= $resultDetailCategory['gambar'] ?>" title="<?= $resultDetailCategory['judul'] ?>" alt="Gambar <?= $resultDetailCategory['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                                </div>
                                <div class="card-body p-2">
                                    <h5 class="fw-bolder text-muted"><?= $resultDetailCategory['judul'] ?></h5>
                                    <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultDetailCategory['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultDetailCategory['diskon'] ?>%</small></h6>
                                    <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultDetailCategory['harga']) ?></h4>
                                    <?php if ($resultDetailCategory['stock']==="Tersedia"): ?>
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

                        <div class="col-6 col-xl-4 mb-4" data-aos="fade-up" data-aos-duration="1500">
                            <a href="<?= $base_url ?>/product/<?= $resultDetailCategory['slugKatProduk'] ?>/<?= $resultDetailCategory['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                                <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                                    <img src="<?= $url_images ?>/product/<?= $resultDetailCategory['gambar'] ?>" title="<?= $resultDetailCategory['judul'] ?>" alt="Gambar <?= $resultDetailCategory['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                                </div>
                                <div class="card-body p-2">
                                    <h5 class="fw-bolder text-muted"><?= $resultDetailCategory['judul'] ?></h5>
                                    <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultDetailCategory['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultDetailCategory['diskon'] ?>%</small></h6>
                                    <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultDetailCategory['harga']) ?></h4>
                                    <?php if ($resultDetailCategory['stock']==="Tersedia"): ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "search":
            if (isset($_POST['_submit_special_ARPATEAM_'])) {
                $KeywordSearch = $_POST['query'];
                $KeywordSearch1 = "%".$KeywordSearch."%";
                try {
                    $CekData = $pdo->prepare("
                            SELECT id_produk
                            FROM produk
                            WHERE judul LIKE :KeywordSearch
                    ");

                    $CekData->bindParam(':KeywordSearch', $KeywordSearch1, PDO::PARAM_STR);
                    $CekData->execute();
                    $rowCekData = $CekData->rowCount();
                } catch (Exception $e) {
                    var_dump($e);
                }
            }else{
                echo "<script>window.location = '$base_url/404'</script>";
            }
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-danger rounded-5 p-3" data-aos="fade-up" data-aos-duration="2500">
                    <h3 class="fw-bolder text-danger mb-0">Result Product: <u><?= $KeywordSearch ?></u></h3>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3 my-3 d-none d-lg-inline">
                <div class="card p-3 sticky-top-sidebar border border-danger rounded-5" data-aos="fade-up" data-aos-duration="1500">
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/new-arrivals" title="New Arrivals" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> New Arrivals</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/best-seller" title="Best Seller" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Best Seller</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/sale" title="Sale" data-aos="fade-up" data-aos-duration="1500"><i class="fa-solid fa-arrow-right"></i> Sale</a>
                        <a class="nav-link border-bottom <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'link-danger'; }else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/all-products" title="All Products" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> All Products</a>
                    </nav>
                    <h6 class="fw-bolder bg-danger p-2 text-light rounded-5" data-aos="fade-up" data-aos-duration="2000">Category</h6>
                    <nav class="nav flex-column" data-aos="fade-up" data-aos-duration="2000">
                        <?php
                            try{
                                $stmtKatProduk = $pdo->prepare("
                                        SELECT
                                            judul, slug
                                        FROM kat_produk
                                ");

                                $stmtKatProduk->execute();
                                while($resultKatProduk = $stmtKatProduk->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a class="nav-link border-bottom <?php if ($_GET['module']=='produk' AND $_GET['view']=="detail-category"){ if($resultKatProduk['slug']===$_GET['slug']){ echo 'link-danger'; }else{ echo 'link-secondary'; } } else{ echo 'link-secondary'; } ?>" href="<?= $base_url ?>/category/<?= $resultKatProduk['slug'] ?>" data-aos="fade-up" data-aos-duration="2000"><i class="fa-solid fa-arrow-right"></i> <?= $resultKatProduk['judul'] ?></a>
                        <?php
                                }
                            }catch(Exception $e){
                                var_dump($e);
                            }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-lg-8 col-xl-9 ps-lg-3 ps-xl-4 my-3">
                <?php if ($rowCekData>0): ?>
                    <div class="card p-0">
                        <div class="load_data row">
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="load_data_message"></div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card p-0">
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert" data-aos="zoom-in" data-aos-duration="2500">
                                <i class="fa-solid fa-circle-exclamation"></i> Sorry, the product data for the <strong><?= $KeywordSearch ?></strong> is not yet available
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "detail":
            $Slug = $_GET['slug'];
            try {
                $stmtData = $pdo->prepare("
                        SELECT *
                        FROM produk
                        WHERE slug = :Slug
                        LIMIT 1
                ");

                $stmtData->bindParam(':Slug', $Slug, PDO::PARAM_STR);
                $stmtData->execute();
                $rowData = $stmtData->rowCount();
                if ($rowData>0) {
                    $resultData = $stmtData->fetch(PDO::FETCH_ASSOC);
                    $id_produk  = $resultData["id_produk"];
                    $view       = $resultData['view']+1;
                    try {
                        $sql = "UPDATE produk
                                SET view        = :view
                                WHERE id_produk = :id_produk
                            ";
                                      
                        $statement = $pdo->prepare($sql);

                        $statement->bindParam(":id_produk", $id_produk, PDO::PARAM_INT);
                        $statement->bindParam(":view", $view, PDO::PARAM_INT);

                        $statement->execute();
                    }catch(PDOException $e){
                        var_dump($e);
                    }
                }else{
                    echo "<script>window.location = '$base_url/404'</script>";
                }
            } catch (Exception $e) {
                var_dump($e);
            }
?>

<section class="container-fluid py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-5 col-lg-6 col-xl-5 my-3">
                <div class="card sticky-top-sidebar" data-aos="fade-up" data-aos-duration="1500">
                    <img src="<?= $url_images ?>/product/<?= $resultData['gambar'] ?>" alt="<?= $resultData['judul'] ?>" class="img-fluid rounded-5 shadow">
                </div>
            </div>
            <!-- Sidebar -->

            <div class="col-md-7 col-lg-6 col-xl-7 ps-0 ps-lg-3 ps-xl-4">
                <div class="card p-0">
                    <div class="card-body" data-aos="zoom-out" data-aos-duration="3500">
                        <?php if ($resultData['stock']==="Tersedia"): ?>
                            <small class="badge bg-primary"><i class="fa-regular fa-circle-check" data-aos="fade-up" data-aos-duration="1500"></i> Tersedia</small>
                        <?php else: ?>
                            <small class="badge bg-warning"><i class="fa-solid fa-circle-xmark" data-aos="fade-up" data-aos-duration="1500"></i> Habis</small>
                        <?php endif ?>
                        <h1 class="fw-bolder text-muted mt-3"><?= $resultData['judul'] ?></h1>

                        <?php if ($resultData['status']==="Sale"): ?>
                            <h6 class="fw-bolder text-danger" data-aos="fade-up" data-aos-duration="2500"><span class="text-decoration-line-through">Rp<?= rp($resultData['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultData['diskon'] ?>%</small></h6>
                            <h3 class="fw-bolder text-primary" data-aos="fade-up" data-aos-duration="1500"><small class="fs-5">Rp</small><?= rp($resultData['harga']) ?></h3>
                        <?php else: ?>
                            <h3 class="fw-bolder text-primary" data-aos="fade-up" data-aos-duration="2500"><small class="fs-5">Rp</small><?= rp($resultData['harga']) ?></h3>
                        <?php endif ?>

                        <div class="d-grid gap-2 my-3">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= whatsApp($nomorWhatsApp); ?>&text=Hallo%20<?= urlencode($nama_web); ?>...%0A%0ASaya%20tertarik%20dengan%20produk%3A%20*<?= urlencode($resultData['judul']); ?>*%0A%0ALink%20produk%20<?= $base_url.'/product/'.$_GET['slug-kat'].'/'.$_GET['slug']; ?>" title="Buy Now" class="btn btn-success text-uppercase fw-bolder" data-aos="fade-up" data-aos-duration="2500"><i class="fa-brands fa-whatsapp"></i> Buy Now</a>
                        </div>

                        <p data-aos="fade-up" data-aos-duration="3500"><?= $resultData['deskripsi'] ?></p>

                        <div class="d-grid gap-2 my-3">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= whatsApp($nomorWhatsApp); ?>&text=Hallo%20<?= urlencode($nama_web); ?>...%0A%0ASaya%20tertarik%20dengan%20produk%3A%20*<?= urlencode($resultData['judul']); ?>*%0A%0ALink%20produk%20<?= $base_url.'/product/'.$_GET['slug-kat'].'/'.$_GET['slug']; ?>" title="Buy Now" class="btn btn-outline-success text-uppercase fw-bolder" data-aos="fade-up" data-aos-duration="2500"><i class="fa-brands fa-whatsapp"></i> Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-5">
            <div class="col-md-auto">
                <h4 class="fw-bolder text-danger" data-aos="fade-up" data-aos-duration="1500">You may also like</h4>
            </div>
        </div>

        <section class="row">
            <?php
                $queryRelevan = $pdo->query("
                        SELECT produk.judul, produk.status, stock, sub_harga, diskon, harga, produk.gambar, produk.slug AS slugProduk, kat_produk.slug AS slugKatProduk
                        FROM produk
                        INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                        WHERE produk.id_kat_produk='$resultData[id_kat_produk]'
                        AND id_produk != '$resultData[id_produk]'
                        ORDER BY rand()
                        LIMIT 4
                ");

                while($resultRelevan = $queryRelevan->fetch(PDO::FETCH_ASSOC)){
                    if ($resultRelevan['status']==="Sale") {
            ?>

            <div class="col-6 col-md-4 col-xl-3 my-3" data-aos="fade-up" data-aos-duration="2500">
                <a href="<?= $base_url ?>/product/<?= $resultRelevan['slugKatProduk'] ?>/<?= $resultRelevan['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <div class="ribbon ribbon-top-left"><span>Disc. <?= $resultRelevan['diskon'] ?>%</span></div>
                        <img src="<?= $url_images ?>/product/<?= $resultRelevan['gambar'] ?>" title="<?= $resultRelevan['judul'] ?>" alt="Gambar <?= $resultRelevan['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultRelevan['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultRelevan['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultRelevan['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultRelevan['harga']) ?></h4>
                        <?php if ($resultRelevan['stock']==="Tersedia"): ?>
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

            <div class="col-6 col-md-4 col-xl-3 my-3" data-aos="fade-up" data-aos-duration="1500">
                <a href="<?= $base_url ?>/product/<?= $resultRelevan['slugKatProduk'] ?>/<?= $resultRelevan['slugProduk'] ?>" class="card card-hover-shadow-lg shadow-sm text-decoration-none">
                    <div class="card-header box card-header-blog-lg rounded-top-5 p-0">
                        <img src="<?= $url_images ?>/product/<?= $resultRelevan['gambar'] ?>" title="<?= $resultRelevan['judul'] ?>" alt="Gambar <?= $resultRelevan['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <h5 class="fw-bolder text-muted"><?= $resultRelevan['judul'] ?></h5>
                        <h6 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultRelevan['sub_harga']) ?></span> <small class="badge bg-danger small">Diskon <?= $resultRelevan['diskon'] ?>%</small></h6>
                        <h4 class="fw-bolder text-primary"><small class="fs-5">Rp</small><?= rp($resultRelevan['harga']) ?></h4>
                        <?php if ($resultRelevan['stock']==="Tersedia"): ?>
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

<?php
            break;
        default:
            echo "<script>window.location = '$base_url/404'</script>";
    }
?>