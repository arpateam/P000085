<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="<?= $url_images ?>/avatar/<?= $_SESSION['_avatar__'] ?>" alt="<?= $_SESSION['_nama__'] ?>" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                <div class="dropdown">
                    <a href="<?= $base_url_admin ?>/#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"><?= $_SESSION['_nama__'] ?></a>
                </div>

            <p class="text-muted left-user-info"><?= $_SESSION['_level__'] ?></p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="<?= $base_url_admin ?>/profil-saya" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="<?= $base_url_admin ?>/keluar-admin">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <?php
            switch ($_SESSION['_level__']) {
                case 'Administrator':
        ?>

        <div id="sidebar-menu">
            <ul id="side-menu">
                <li>
                    <a href="<?= $base_url_admin ?>/dashboard" class="<?php if($_GET['module']=='dashboard'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title bg-body mt-2">MANAJEMEN PRODUK</li>
                <li>
                    <a href="<?= $base_url_admin ?>/produk" class="<?php if($_GET['module']=='produk'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-tag-multiple"></i>
                        <span> Daftar Produk </span>
                    </a>
                </li>

                <li class="menu-title bg-body mt-2">MANAJEMEN INFORMASI</li>
                <li>
                    <a href="<?= $base_url_admin ?>/metode-pembayaran" class="<?php if($_GET['module']=='metode-pembayaran'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-credit-card-check"></i>
                        <span> Metode Pembayaran </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/blog" class="<?php if($_GET['module']=='blog'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-newspaper"></i>
                        <span> Blog </span>
                    </a>
                </li>

                <li class="menu-title bg-body mt-2">FITUR WEBSITE</li>
                <li>
                    <a href="<?= $base_url_admin ?>/halaman" class="<?php if($_GET['module']=='halaman'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-file-document-multiple"></i>
                        <span> Halaman & SEO </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/pengaturan" class="<?php if($_GET['module']=='pengaturan'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-cogs"></i>
                        <span> Pengaturan Website </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/sitemap" class="<?php if($_GET['module']=='sitemap'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-sitemap"></i>
                        <span> Sitemap </span>
                    </a>
                </li>

                <li class="menu-title bg-body mt-2">MANAJEMEN PEGAWAI</li>
                <li>
                    <a href="<?= $base_url_admin ?>/pegawai" class="<?php if($_GET['module']=='pegawai'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-card-account-details-star"></i>
                        <span> Data Pegawai </span>
                    </a>
                </li>
            </ul>
        </div>

        <?php
                    break;
            }
        ?>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>