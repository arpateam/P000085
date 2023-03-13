<?php
    switch ($_GET['view']) {
        case "list":
?>

<div class="container-fluid bg-container p-0">
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
    <div class="container bg-white shadow-top rounded-5 p-2 p-lg-4" style="position: relative !important;z-index: 1000 !important;" data-aos="fade-up" data-aos-duration="2500">
        <div class="row justify-content-center text-danger">
            <div class="col-auto my-auto">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb my-auto">
                        <li class="breadcrumb-item"><a href="<?= $base_url ?>" class="link-danger text-decoration-none"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid bg-light py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="load_data row mt-4">
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="load_data_message"></div>
            </div>
        </div>
    </div>
</section>

<?php
            break;
        case "detail":
            try{
                $stmtData = $pdo->prepare("
                        SELECT *
                        FROM blog
                        WHERE slug = ?
                ");

                $stmtData->bindValue(1, $_GET['slug']);
                $stmtData->execute();
                $rowsData   = $stmtData->rowCount();

                if ($rowsData>0) {
                    $resultData = $stmtData->fetch(PDO::FETCH_ASSOC);
                    $id_blog    = $resultData['id_blog'];
                    $views      = $resultData['views']+1;
                    try {
                        $sql = "UPDATE blog
                                SET views       = :views
                                WHERE id_blog   = :id_blog
                            ";
                                      
                        $statement = $pdo->prepare($sql);

                        $statement->bindParam(":id_blog", $id_blog, PDO::PARAM_INT);
                        $statement->bindParam(":views", $views, PDO::PARAM_INT);

                        $count = $statement->execute();
                    }catch(PDOException $e){
                        echo "<script>window.location.href = '$base_url/404';</script>";
                        die();
                        exit();
                    }
                }else{
                    echo "<script>window.location.href = '$base_url/404';</script>";
                    die();
                    exit();
                }
            } catch (Exception $e) {
                echo "<script>window.location.href = '$base_url/404';</script>";
                die();
                exit();
            }
?>

<div class="container-fluid bg-container p-0">
    <div class="card bg-dark text-white rounded-0">
        <div class="card-header img-card-img-overlay card-header-blog-xl p-0">
            <img src="<?= $url_images ?>/blog/<?= $resultData['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultData['judul'] ?>" data-aos="fade-up" data-aos-duration="2000">
        </div>
        <div class="card-img-overlay-V2 text-center">
            <div class="container">
                <h1 class="fw-bolder" data-aos="fade-up" data-aos-duration="1500"><?= $resultData['judul'] ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid mt--10">
    <div class="container bg-white shadow-top rounded-5 p-2 p-lg-4" style="position: relative !important;z-index: 1000 !important;" data-aos="fade-up" data-aos-duration="2500">
        <div class="row justify-content-center text-danger">
            <div class="col-auto my-auto">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb my-auto">
                        <li class="breadcrumb-item"><a href="<?= $base_url ?>" class="link-danger text-decoration-none"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= $base_url ?>/blog" class="link-danger text-decoration-none">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="d-inline d-sm-none"><?= substr($resultData['judul'], 0, 25) ?>...</span>
                            <span class="d-none d-sm-inline"><?= $resultData['judul'] ?></span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid bg-light py-4 py-md-5">
    <div class="container px-0 px-sm-2">
        <div class="row mt-4">
            <div class="col-lg-8 my-3">
                <div class="card">
                    <div class="card-header p-0 d-none d-lg-inline">
                        <img src="<?= $url_images.'/blog/'.$resultData['gambar'] ?>" alt="Gambar Blog <?= $resultData['judul'] ?>" class="w-100 image-zoom-on-hover rounded-top-5" data-aos="fade-down" data-aos-duration="2000">
                    </div>
                    <div class="card-body pb-0">
                        <div class="card-title d-none d-lg-inline">
                            <h1 class="fw-bolder text-danger" data-aos="fade-down" data-aos-duration="2000"><?= $resultData['judul'] ?></h1>
                        </div>
                        <div class="card-body p-0 my-4 text-muted" data-aos="fade-down" data-aos-duration="2000">
                            <div class="d-flex justify-content-between">
                                <small><i class="fa-solid fa-calendar-days"></i> <?= indoTgl($resultData['tgl_terbit']) ?></small>
                                <small><i class="fa-solid fa-eye"></i> <?= rp($views) ?>x</small>
                            </div>
                        </div>
                        <div class="card-body p-0 my-4 text-muted" data-aos="fade-down" data-aos-duration="2000">
                            <p>
                                Bagikan:
                                <a role="button" href="<?= $base_url ?>#" title="Instagram" class="btn btn-sm btn-outline-secondary"><i class="fa-brands fa-instagram"></i></a>
                                <a role="button" href="<?= $base_url ?>#" title="Facebook" class="btn btn-sm btn-outline-secondary"><i class="fa-brands fa-facebook-f"></i></a>
                                <a role="button" href="<?= $base_url ?>#" title="YouTube" class="btn btn-sm btn-outline-secondary"><i class="fa-brands fa-youtube"></i></a>
                                <a role="button" href="<?= $base_url ?>#" title="LinkedIn" class="btn btn-sm btn-outline-secondary"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a role="button" href="<?= $base_url ?>#" title="TikTok" class="btn btn-sm btn-outline-secondary"><i class="fa-brands fa-tiktok"></i></a>
                            </p>
                        </div>
                        <div class="card-body p-0 mt-3 text-muted" data-aos="fade-down" data-aos-duration="2000">
                            <?= $resultData['deskripsi'] ?>
                        </div>
                    </div>
                </div>

                <div class="card p-4 mt-5">
                    <h4 class="fw-bolder text-secondary" data-aos="fade-down" data-aos-duration="2000">Related Posts:</h4>

                    <div class="row">
                        <?php
                            try{
                                $stmtTerkait = $pdo->prepare("
                                        SELECT
                                            judul, gambar, slug
                                        FROM blog
                                        ORDER BY rand()
                                        LIMIT 3
                                ");

                                $stmtTerkait->execute();
                                while($resultTerkait = $stmtTerkait->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="col-6 col-md-4" data-aos="fade-down" data-aos-duration="2000">
                            <div class="card card-hover-shadow border mt-3">
                                <div class="card-header box card-header-blog-sm rounded-top-5 p-0">
                                    <img src="<?= $url_images ?>/blog/<?= $resultTerkait['gambar'] ?>" alt="Gambar Blog <?= $resultTerkait['judul'] ?>" class="img-fluid image-zoom-on-hover rounded-top-5">
                                </div>
                                <div class="card-body p-2">
                                    <div class="card-title">
                                        <a href="<?= $base_url ?>/blog/<?= $resultTerkait['slug'] ?>" title="<?= $resultTerkait['judul'] ?>" class="link-dark-card fs-6"><?= $resultTerkait['judul'] ?></a>
                                    </div>
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
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 ps-lg-3 ps-xl-5 my-3">
                <div class="card p-3 sticky-top-sidebar">
                    <h4 class="fw-bolder" data-aos="fade-down" data-aos-duration="2000">Recent Posts:</h4>

                    <?php
                        try{
                            $stmtTerbaru = $pdo->prepare("
                                    SELECT
                                        judul, gambar, slug, views, tgl_terbit
                                    FROM blog
                                    ORDER BY id_blog DESC
                                    LIMIT 2
                            ");

                            $stmtTerbaru->execute();
                            while($resultTerbaru = $stmtTerbaru->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="card card-hover-shadow mt-3 border-bottom" data-aos="fade-down" data-aos-duration="2000">
                        <div class="card-header box card-header-blog rounded-top-5 p-0">
                            <img src="<?= $url_images ?>/blog/<?= $resultTerbaru['gambar'] ?>" alt="Gambar Blog <?= $resultTerbaru['judul'] ?>" class="img-fluid image-zoom-on-hover rounded-top-5">
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <a href="<?= $base_url ?>/blog/<?= $resultTerbaru['slug'] ?>" title="<?= $resultTerbaru['judul'] ?>" class="link-dark-card fs-5"><?= $resultTerbaru['judul'] ?></a>
                            </div>
                            <div class="card-body p-0 mt-4">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted"><?= indoTgl($resultTerbaru['tgl_terbit']) ?></small>
                                    <small class="text-muted"><i class="fa-solid fa-eye"></i> <?= rp($resultTerbaru['views']) ?>x</small>
                                </div>
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
            <!-- Sidebar -->
        </div>
    </div>
</section>

<?php
            break;
        default:
    }
?>