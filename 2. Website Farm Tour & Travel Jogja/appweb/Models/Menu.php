<header class="container-fluid bg-warning">
    <div class="container px-0 px-sm-2" data-aos="fade-in" data-aos-duration="2000">
        <div class="row justify-content-center text-center text-white">
            <div class="col-auto fw-bold py-1">
                <small>SELAMAT DATANG DI FARM TOUR JOGJA</small>
            </div>
        </div>
    </div>
</header>

<nav id="navbar_top" class="container-fluid sticky-top navbar navbar-expand-lg bg-light navbar-light">
    <div class="container px-0 px-sm-2" data-aos="fade-in" data-aos-duration="2000">
        <a class="navbar-brand" href="<?= $base_url; ?>">
            <img src="<?= $url_images; ?>/<?= $logoMobile ?>" title="<?= $judulLogoMobile; ?>" alt="Gambar <?= $judulLogoMobile; ?>" id="navbar_brand" class="navbar-brand-60">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <hr class="border border-white d-block d-lg-none">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#Beranda" class="nav-link text-dark text-uppercase" title="Beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="#TentangKami" class="nav-link text-dark text-uppercase" title="Tentang Kami">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a href="#ArmadaKami" class="nav-link text-dark text-uppercase" title="Armada Kami">Armada Kami</a>
                </li>
                <li class="nav-item">
                    <a href="#HubungiKami" class="nav-link text-dark text-uppercase" title="Hubungi Kami">Hubungi Kami</a>
                </li>
                <li class="nav-item">
                    <div class="vl pe-2"></div>
                </li>
            </ul>
        </div>
        <div class="justify-content-end d-none d-lg-block">
            <div class="nav-item">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $nomorWhatsApp ?>&text=Halo%20Farm%20Tour%20Jogja..." class="btn btn-outline-success btn-sm fw-bolder text-uppercase shadow-sm" aria-current="page" title="Hubungi Kami di WhatsApp">Hubungi Kami di WhatsApp</a>
            </div>
        </div>
    </div>
</nav>