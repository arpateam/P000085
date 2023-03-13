<?php
    switch ($_GET['act']) {
        case 'kategori':

            try {
                $stmtData  = $pdo->prepare("
                        SELECT id_kat_produk, judul
                        FROM kat_produk
                        WHERE slug = ?");

                $stmtData->bindValue(1, $_GET['kat_slug']);
                $stmtData->execute();

                if ($stmtData->rowCount()>0) {
                    $resultData = $stmtData->fetch(PDO::FETCH_ASSOC);
                }else{
                    echo "<script>window.location = '404';</script>";
                }
            }catch(Exception $e) {
                var_dump($e);
            }
?>

<section class="container px-md-0 my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="mb-0 fw-bold text-light text-uppercase"><?= $resultData['judul'] ?> Terbaru</h4>
                </div>
                <div class="card-body px-0">
                    <?php
                        try {
                            $queryProdukTerbaru = $pdo->prepare("
                                    SELECT produk.judul AS judulProduk, produk.gambar AS gambarProduk, deskripsi, produk.slug AS slugProduk, kat_produk.judul AS judulKatProduk, kat_produk.slug AS slugKatProduk
                                    FROM produk
                                    INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                                    WHERE produk.id_kat_produk = ?
                                    ORDER BY id_produk DESC");

                            $queryProdukTerbaru->bindValue(1, $resultData['id_kat_produk']);
                            $queryProdukTerbaru->execute();
                            while($resultProdukTerbaru = $queryProdukTerbaru->fetch(PDO::FETCH_ASSOC)){
                                $deskripsi      = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$resultProdukTerbaru["deskripsi"])));
                                $myDeskripsi    = substr($deskripsi,0,strrpos(substr($deskripsi,0,100)," "))." ...";
                    ?>
                    <div class="card my-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-header card-header-blog-sm p-0">
                                    <img src="<?= $url_images ?>/produk/<?= $resultProdukTerbaru['gambarProduk'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultProdukTerbaru['judulProduk'] ?>">
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
                    <h4 class="mb-0 fw-bold text-light text-uppercase"><?= $resultData['judul'] ?> Populer</h4>
                </div>
                <div class="card-body">
                    
                    <?php
                        try {
                            $queryProdukPopuler = $pdo->prepare("
                                    SELECT produk.judul AS judulProduk, produk.gambar AS gambarProduk, deskripsi, produk.slug AS slugProduk, kat_produk.judul AS judulKatProduk, kat_produk.slug AS slugKatProduk
                                    FROM produk
                                    INNER JOIN kat_produk ON produk.id_kat_produk = kat_produk.id_kat_produk
                                    WHERE produk.id_kat_produk = ?
                                    ORDER BY view DESC
                                    LIMIT 5");

                            $queryProdukPopuler->bindValue(1, $resultData['id_kat_produk']);
                            $queryProdukPopuler->execute();
                            while($resultProdukPopuler = $queryProdukPopuler->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="card my-3">
                        <div class="card-header card-header-blog-sm p-0 mb-3">
                            <img src="<?= $url_images ?>/produk/<?= $resultProdukPopuler['gambarProduk'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultProdukPopuler['judulProduk'] ?>">
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

<?php
            break;
        case 'read':

            try {
                $stmtData  = $pdo->prepare("
                        SELECT id_kat_produk, judul
                        FROM kat_produk
                        WHERE slug = ?");

                $stmtData->bindValue(1, $_GET['kat_slug']);
                $stmtData->execute();

                if ($stmtData->rowCount()>0) {
                    $resultData = $stmtData->fetch(PDO::FETCH_ASSOC);
                    try {
                        $stmtDataProduk  = $pdo->prepare("
                                SELECT *
                                FROM produk
                                WHERE slug = ?");

                        $stmtDataProduk->bindValue(1, $_GET['slug']);
                        $stmtDataProduk->execute();

                        if ($stmtDataProduk->rowCount()>0) {
                            $resultDataProduk = $stmtDataProduk->fetch(PDO::FETCH_ASSOC);
                            $id_produk  = $resultDataProduk["id_produk"];
                            $view       = $resultDataProduk['view']+1;
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
                            echo "<script>window.location = '404';</script>";
                        }
                    }catch(Exception $e) {
                        var_dump($e);
                    }
                }else{
                    echo "<script>window.location = '404';</script>";
                }
            }catch(Exception $e) {
                var_dump($e);
            }
?>

<section class="container-fluid mt-5">
    <div class="container px-0 px-sm-2">

        <div class="row justify-content-center my-5">
            <div class="col-12 mb-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-dark rounded p-3">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>" class="link-success fw-bold text-decoration-none"><i class="fa-solid fa-house"></i> Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>/produk/<?= $_GET['kat_slug']; ?>" class="link-success fw-bold text-decoration-none"><?= $resultData['judul']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $resultDataProduk['judul'] ?></li>
                    </ol>
                </nav>
            </div>

            <div class="col-12">
                <div class="card-body p-0">
                    <div class="card-title text-center">
                        <h1 class="fw-bold text-success text-uppercase"><?= $resultDataProduk['judul'] ?></h1>
                    </div>

                    <div class="d-flex justify-content-between py-4 border-top">
                        <div>
                            <span class="fw-bold text-muted">Bagikan ke: </span>
                            <ul class="list-unstyled d-inline-flex">
                                <li><a target="_blank" href="https://wa.me/?text=<?= $resultDataProduk['judul']; ?>%0A%0ASelengkapnya%20di%3A%20<?= $base_url.'/'.$_GET['kat_slug'].'/'.$resultDataProduk['slug']; ?>" title="Bagikan ke Whatsapp" class="btn btn-sm btn-dark rounded-pill ms-1"><i class="fa-brands fa-whatsapp"></i></a></li>
                                <li>
                                    <button id="copyLink" class="btn btn-sm btn-secondary rounded-pill ms-1" data-clipboard-text="<?= $base_url.'/'.$_GET['kat_slug'].'/'.$resultDataProduk['slug']; ?>">
                                        <i class="fa-solid fa-copy"></i> Salin URL
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <small class="text-muted me-3"><i class="fas fa-eye"></i> <?= rp($view) ?>x</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-none d-md-inline">
                <div class="card sticky-top-sidebar">
                    <div class="card-header p-0">
                        <img src="<?= $url_images; ?>/produk/<?= $resultDataProduk['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $resultDataProduk['judul'] ?>">
                    </div>
                    <div class="card-body">
                        <small class="text-muted"><em>Gambar <?= $resultDataProduk['judul'] ?></em></small>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body p-0">
                        <?= $resultDataProduk['deskripsi'] ?>
                    </div>
                    <div class="card-footer">
                        <a target="_blank" href="https://wa.me/?text=<?= $resultDataProduk['judul']; ?>%0A%Saya%20tertarik%20dengan%3A%20<?= $base_url.'/'.$_GET['kat_slug'].'/'.$resultDataProduk['slug']; ?>" title="Pesan Lewat Whatsapp" class="btn btn-lg btn-success rounded-pill ms-1"><i class="fa-brands fa-whatsapp"></i> Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-footer">
                        <?php $uri = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>
                        <div class="fb-comments" data-href="<?php echo $uri; ?>" data-width="100%" data-numposts="100">
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </div>
</section>

<?php
            break;
    }
?>