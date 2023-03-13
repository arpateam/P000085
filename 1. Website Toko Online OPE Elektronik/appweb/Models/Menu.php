<header class="container-fluid">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center justify-content-lg-between py-3">
            <div class="col-auto d-none d-lg-inline-block">
                <a class="navbar-brand" href="<?= $base_url ?>">
                    <img src="<?= $url_images; ?>/<?= $logoDesktop ?>" title="<?= $judulLogoDesktop; ?>" alt="Gambar <?= $judulLogoDesktop; ?>" id="navbar_brand" class="navbar-brand-100">
                </a>
            </div>
            <div class="col-auto my-auto">
                <a target="_blank" href="<?= $linkInstagram ?>" title="Instagram Kami" class="link-danger text-decoration-none m-2"><i class="fa-brands fa-instagram fa-xl"></i></a>
                <a target="_blank" href="<?= $linkFacebook ?>" title="Facebook Kami" class="link-primary text-decoration-none m-2"><i class="fa-brands fa-facebook fa-xl"></i></a>
                <a target="_blank" href="<?= $linkTwitter ?>" title="Twitter Kami" class="link-info text-decoration-none m-2"><i class="fa-brands fa-twitter fa-xl"></i></a>
                <a target="_blank" href="<?= $linkYouTube ?>" title="Youtube Kami" class="link-danger text-decoration-none m-2"><i class="fa-brands fa-youtube fa-xl"></i></a>
                <a href="mailto:<?= $email ?>" title="Email Kami" class="link-danger text-decoration-none m-2"><i class="fa-solid fa-envelope fa-xl"></i></a>
            </div>
        </div>
    </div>
</header>

<nav id="navbar_top" class="container-fluid navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-top-3 border-success">
    <div class="container px-0 px-sm-2">
        <a class="navbar-brand d-inline-block d-lg-none" href="<?= $base_url ?>">
            <img src="<?= $url_images; ?>/<?= $logoDesktop ?>" title="<?= $judulLogoDesktop; ?>" alt="Gambar <?= $judulLogoDesktop; ?>" id="navbar_brand" class="navbar-brand-75">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <hr class="border border-success d-block d-lg-none">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase <?php if($_GET['module']=='beranda'){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>" title="Beranda">Beranda
                    </a>
                </li>
                <?php
                    try {
                        $queryMenu = $pdo->prepare("
                                SELECT judul, slug
                                FROM kat_produk
                                ORDER BY urutan ASC");

                        $queryMenu->execute();
                        while($resultMenu = $queryMenu->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li class="nav-item">
                    <a class="nav-link text-uppercase <?php if(($_GET['module']=='produk' AND $_GET['act']=='kategori' AND  $_GET['kat_slug']===$resultMenu['slug']) OR ($_GET['module']=='produk' AND $_GET['act']=='read' AND  $_GET['kat_slug']===$resultMenu['slug'])){ echo 'active'; } ?>" href="<?= $base_url ?>/produk/<?= $resultMenu['slug'] ?>" title="<?= $resultMenu['judul'] ?>"><?= $resultMenu['judul'] ?></a>
                </li>
                <?php
                        }   
                    } catch (Exception $e) {
                        var_dump($e);
                    }
                ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase btn btn-success text-light rounded-pill <?php if($_GET['module']=='kontak-kami'){ echo 'active'; } ?>" href="<?= $base_url ?>/kontak-kami" title="Kontak Kami">Kontak Kami</a>
                </li>
            </ul>
        </div>
    </div>
</nav>