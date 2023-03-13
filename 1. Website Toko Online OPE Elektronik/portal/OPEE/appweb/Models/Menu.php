<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="<?= $base_url ?>/assets/files/images/avatar/<?= $_SESSION['_avatar__'] ?>" alt="<?= $_SESSION['_nama__'] ?>" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                <div class="dropdown">
                    <a href="<?= $base_url_admin ?>/#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"><?= $_SESSION['_nama__'] ?></a>
                </div>

            <p class="text-muted left-user-info"><?= $_SESSION['_level__'] ?></p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="<?= $base_url_admin ?>/pegawai/profil" class="text-muted left-user-info">
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
        <div id="sidebar-menu">
            <?php if ($_SESSION['_level__']==="Administrator"): ?>
                <ul id="side-menu">
                    <li>
                        <a href="<?= $base_url_admin ?>/dashboard" class="<?php if($_GET['module']=='dashboard'){ echo 'text-light'; } ?>">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li class="menu-title bg-body mt-2">MANAJEMEN KONTEN</li>
                    <li>
                        <a href="<?= $base_url_admin ?>/page/beranda" class="<?php if($_GET['module']=='halaman' AND $_GET['id']=='1'){ echo 'text-light'; } ?>">
                            <i class="mdi mdi-home-edit"></i>
                            <span> Beranda </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= $base_url_admin ?>/#Produk" data-bs-toggle="collapse" class="<?php if(($_GET['module']=='produk') OR ($_GET['module']=='halaman' AND $_GET['id']=='2')){ echo 'text-light'; } ?>">
                            <i class="mdi mdi-newspaper-variant-multiple-outline"></i>
                            <span> Produk </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="Produk">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="<?= $base_url_admin ?>/produk" class="<?php if($_GET['module']=='produk'){ echo 'text-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Daftar Produk </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url_admin ?>/page/produk" class="<?php if($_GET['module']=='halaman' AND $_GET['id']=='2'){ echo 'text-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Pengaturan SEO </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="<?= $base_url_admin ?>/page/kontak-kami" class="<?php if($_GET['module']=='halaman' AND $_GET['id']=='3'){ echo 'text-light'; } ?>">
                            <i class="mdi mdi-card-account-phone"></i>
                            <span> Kontak Kami </span>
                        </a>
                    </li>

                    <li class="menu-title bg-body mt-2">FITUR WEBSITE</li>
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
            <?php endif ?>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>