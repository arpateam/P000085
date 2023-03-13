<?php
    try {
        $stmt  = $pdo->prepare("
                SELECT judul, gambar, img_share, deskripsi, slug, tgl_update
                FROM page
                WHERE id_page = ?");

        $stmt->bindValue(1, $_GET['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e) {
        var_dump($e);
        die();
        exit();
    }
?>

<!-- <section class="container-fluid px-0">
    <div class="card bg-dark text-white rounded-0">
        <div class="card-header img-card-img-overlay card-header-blog p-0">
            <img src="<?= $url_images; ?>/pages/<?= $result['gambar'] ?>" class="card-img rounded-0" alt="Gambar <?= $result['judul'] ?>">
        </div>
        <div class="card-img-overlay text-center">
            <h1 class="text-light text-uppercase fw-bolder"><?= $result['judul'] ?></h1>
        </div>
    </div>
</section> -->

<section class="container-fluid mt-3">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center my-5">

            <div class="col-lg-12 mb-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-dark rounded p-3">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>" class="link-success fw-bold text-decoration-none"><i class="fa-solid fa-house"></i> Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $result['judul'] ?></li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-10 mb-5 text-center">
                <h1 class="mb-3 mb-lg-4 fw-bolder text-uppercase text-success">Kontak Kami</h1>
                <h4 class="text-muted">Hubungi kami melalui kontak dibawah ini atau dengan datang ke lokasi kantor kami.</h4>
            </div>
            <div class="col-10 col-sm-9 col-md-5 col-lg-4 my-auto">
                <div class="d-flex flex-nowrap bd-highlight">
                    <div class="order-1 p-2"><i class="fa-solid fa-location-dot fa-xl text-success"></i></div>
                    <div class="order-2 p-2">
                        <p class="text-uppercase fw-bolder mb-0">Alamat</p>
                        <span class="text-muted"><?= $alamat ?></span>
                    </div>
                </div>
                <div class="d-flex flex-nowrap bd-highlight">
                    <div class="order-1 p-2"><i class="fa-solid fa-phone fa-xl text-success"></i></div>
                    <div class="order-2 p-2">
                        <p class="text-uppercase fw-bolder mb-0">Hubungi Kami</p>
                        <span class="text-muted"><?= $nomorTelpSms ?></span>
                    </div>
                </div>
                <div class="d-flex flex-nowrap bd-highlight">
                    <div class="order-1 p-2"><i class="fa-solid fa-envelope fa-xl text-danger"></i></div>
                    <div class="order-2 p-2">
                        <p class="text-uppercase fw-bolder mb-0">Email</p>
                        <span class="text-muted"><?= $email ?></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>