<?php
    switch ($_GET['act']) {
        case "daftar-produk":
            $hal                = "Produk";
            $hal2               = "Kategori Produk";
            $penyimpananGambar  = "$url_images/product";
            $database           = "produk";
            $database2          = "kat_produk";
            $link               = "produk";

            $query  = $pdo->query("
                    SELECT id_kat_produk, judul, slug
                    FROM $database2
                    WHERE slug='$_GET[slug]'");
            $rows   = $query->rowCount();

            if ($rows>0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
            }else{
                echo "<script>window.location.href = '$base_url_admin/$link';</script>";
                die();
                exit();
            }
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3><?= $result['judul'] ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $hal2 ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $result['judul'] ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#TambahProduk"><i class="fas fa-plus"></i> Tambah <?= $hal ?></button>

                    <div id="TambahProduk" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-xl">
                            <form action="<?= $base_url_admin ?>/addProduk" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah <?= $hal." ".$result['judul'] ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <h4 class="alert-heading">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg> PERHATIAN!
                                            </h4>
                                            <hr class="my-2">
                                            <ul class="mb-1">
                                                <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                                <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                                <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-8 my-auto">
                                        <div class="row">
                                            <div class="col-md-12 my-1">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Landing Page" required="">
                                                    <label for="judul">Judul Produk</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 my-1">
                                                <div class="form-floating">
                                                    <select class="form-select" id="status_produk" name="___in_status_produk_special_ARPATEAM" required="">
                                                        <option value="None">None</option>
                                                        <option value="Sale">Sale</option>
                                                    </select>
                                                    <label for="status_produk">Status?</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 my-1">
                                                <div class="form-floating">
                                                    <select class="form-select" id="stock" name="___in_stock_special_ARPATEAM" required="">
                                                        <option value="Tersedia">Tersedia</option>
                                                        <option value="Habis">Habis</option>
                                                    </select>
                                                    <label for="stock">Stock Produk</label>
                                                </div>
                                            </div>

                                            <div class="col-md-8 my-1">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control sub_harga" data-a-sign="Rp" name="___in_sub_harga_special_ARPATEAM" placeholder="Masukkan Sub Harga disini..." required="">
                                                    <label for="sub_harga">Sub Harga</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-1">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="diskon" name="___in_diskon_special_ARPATEAM" placeholder="Masukkan Diskon disini..." min="0" max="100" required="">
                                                    <label for="diskon">Diskon (%)</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 my-1">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control harga" data-a-sign="Rp" value="(*) Harga akan muncul setelah menginputkan data ini" readonly disabled>
                                                    <label for="harga">Harga</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="row">
                                            <!-- file preview template -->
                                            <div class="col-12 my-1">
                                                <div class="form-floating">
                                                    <input type="file" data-plugins="dropify" data-height="255" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM" required="">
                                                    <label for="gambar">Gambar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 my-3">
                                        <textarea name="___in_deskripsi_special_ARPATEAM" id="myEditorFroala" value="Test"></textarea>
                                    </div><!-- end col -->

                                    <div class="col-12 my-1">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="slug-tab" data-bs-toggle="tab" data-bs-target="#slug" type="button" role="tab" aria-controls="slug" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="title-tab" data-bs-toggle="tab" data-bs-target="#title" type="button" role="tab" aria-controls="title" aria-selected="false">Title <span data-bs-toggle="tooltip" data-bs-placement="top" title="Title adalah judul atau nama sebuah konten website. Biasanya tertera di header atau bagian atas header."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="keywords-tab" data-bs-toggle="tab" data-bs-target="#keywords" type="button" role="tab" aria-controls="keywords" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="slug" role="tabpanel" aria-labelledby="slug-tab">
                                                <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                            </div>
                                            <div class="tab-pane fade" id="title" role="tabpanel" aria-labelledby="title-tab">
                                                <input type="text" class="form-control" name="___in_title_special_ARPATEAM" placeholder="Cth: Jasa Pembuatan Website Toko Online Murah">
                                            </div>
                                            <div class="tab-pane fade" id="keywords" role="tabpanel" aria-labelledby="keywords-tab">
                                                <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"></textarea>
                                            </div>
                                            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                                                <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memberikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                    <input type="hidden" name="___in_id_kat_produk_special_ARPATEAM" value="<?= $result['id_kat_produk'] ?>">
                                    <input type="hidden" name="___in_slug_kat_produk_special_ARPATEAM" value="<?= $result['slug'] ?>">
                                    <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!--Pricing Column-->
            <?php
                $queryData = $pdo->query("
                        SELECT *
                        FROM $database
                        WHERE id_kat_produk='$result[id_kat_produk]'
                        ORDER BY id_produk DESC
                ");
                while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                    if ($resultData['status']==="Sale") {
                    
            ?>

            <article class="pricing-column col-xl-3 col-md-6 my-3">
                <div class="ribbon"><span class="bg-danger">Diskon <?= $resultData['diskon'] ?>%</span></div>
                <div class="card shadow">
                    <div class="card-header card-header-blog-lg border border-dark p-0">
                        <img src="<?= $penyimpananGambar ?>/<?= $resultData['gambar'] ?>" title="<?= $resultData['judul'] ?>" alt="Gambar <?= $resultData['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <div class="dropdown float-end mt-2">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahProduk<?= $resultData['id_produk'] ?>" class="dropdown-item"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= $base_url ?>/<?= $result['slug'] ?>/<?= $resultData['slug'] ?>" target="_blank" class="dropdown-item"><i class="far fa-paper-plane"></i> Detail Produk</a>
                                <a onclick="confirmHapusProduk('<?= $resultData['id_produk']; ?>')" class="dropdown-item bg-danger text-light"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </div>
                        </div>
                        <div class="plan-header">
                            <h4 class="plan-title fw-bolder text-light"><?= $resultData['judul'] ?></h4>
                            <h5 class="fw-bolder text-danger"><span class="text-decoration-line-through">Rp<?= rp($resultData['sub_harga']) ?></span> <span class="badge bg-danger">Diskon <?= $resultData['diskon'] ?>%</span></h5>
                            <h2 class="plan-price fw-bolder text-pink"><small class="fs-5">Rp</small><?= rp($resultData['harga']) ?></h2>
                            <?php if ($resultData['stock']==="Tersedia"): ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif ?>
                            <small class="badge bg-primary"><i class="fas fa-eye"></i> <?= rp($resultData['view']) ?>x</small>
                        </div>
                    </div>
                </div>
            </article>

            <div id="UbahProduk<?= $resultData['id_produk'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl">
                    <form action="<?= $base_url_admin ?>/editProduk" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <h4 class="alert-heading">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg> PERHATIAN!
                                    </h4>
                                    <hr class="my-2">
                                    <ul class="mb-1">
                                        <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                        <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                        <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="col-md-8 my-auto">
                                <div class="row">
                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Landing Page" value="<?= $resultData['judul']; ?>" required="">
                                            <label for="judul">Judul Produk</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="status_kat" name="___in_status_produk_special_ARPATEAM" required="">
                                                <option value="None" <?php if ($resultData['status']==="None") { echo "selected"; } ?>>None</option>
                                                <option value="Sale" <?php if ($resultData['status']==="Sale") { echo "selected"; } ?>>Sale</option>
                                            </select>
                                            <label for="status_kat">Status?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="stock" name="___in_stock_special_ARPATEAM" required="">
                                                <option value="Tersedia" <?php if ($resultData['stock']==="Tersedia") { echo "selected"; } ?>>Tersedia</option>
                                                <option value="Habis" <?php if ($resultData['stock']==="Habis") { echo "selected"; } ?>>Habis</option>
                                            </select>
                                            <label for="stock">Stock Produk</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control sub_harga" data-a-sign="Rp" name="___in_sub_harga_special_ARPATEAM" placeholder="Masukkan Sub Harga disini..." value="<?= $resultData['sub_harga'] ?>" required="">
                                            <label for="sub_harga">Sub Harga</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="diskon" name="___in_diskon_special_ARPATEAM" value="<?= $resultData['diskon'] ?>" placeholder="Masukkan Diskon disini..." min="0" required="">
                                            <label for="diskon">Diskon (%)</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control harga" data-a-sign="Rp" value="<?= $resultData['harga'] ?>" readonly>
                                            <label for="harga">Harga</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 my-auto">
                                <!-- file preview template -->
                                    <div class="col-12 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $resultData['gambar'] ?>" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM">
                                            <label for="gambar">Gambar</label>
                                        </div>
                                    </div>
                                <!-- file preview template -->
                            </div>

                            <div class="col-12 my-3">
                                <textarea name="___in_deskripsi_special_ARPATEAM" id="myEditorFroala" value="Test"><?= $resultData['deskripsi'] ?></textarea>
                            </div><!-- end col -->

                            <div class="col-12 my-1">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="slug-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#slug-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="slug-<?= $resultData['slug']; ?>" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="title-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#title-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="title-<?= $resultData['slug']; ?>" aria-selected="false">Title <span data-bs-toggle="tooltip" data-bs-placement="top" title="Title adalah judul atau nama sebuah konten website. Biasanya tertera di header atau bagian atas header."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="keywords-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#keywords-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="keywords-<?= $resultData['slug']; ?>" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="description-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#description-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="description-<?= $resultData['slug']; ?>" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="slug-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="slug-<?= $resultData['slug']; ?>-tab">
                                        <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" value="<?= $resultData['slug']; ?>" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                    </div>
                                    <div class="tab-pane fade" id="title-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="title-<?= $resultData['slug']; ?>-tab">
                                        <input type="text" class="form-control" name="___in_title_special_ARPATEAM" value="<?= $resultData['title']; ?>" placeholder="Cth: Jasa Pembuatan Website Toko Online Murah">
                                    </div>
                                    <div class="tab-pane fade" id="keywords-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="keywords-<?= $resultData['slug']; ?>-tab">
                                        <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"><?= $resultData['keyword']; ?></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="description-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="description-<?= $resultData['slug']; ?>-tab">
                                        <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memberikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"><?= $resultData['description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="___in_id_produk_special_ARPATEAM" value="<?= $resultData['id_produk']; ?>">
                            <input type="hidden" name="___in_id_kat_produk_special_ARPATEAM" value="<?= $resultData['id_kat_produk']; ?>">
                            <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $resultData['id_sitemap']; ?>">
                            <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $resultData['gambar']; ?>">
                            <input type="hidden" name="___in_img_share_lama_special_ARPATEAM" value="<?= $resultData['img_share']; ?>">
                            <input type="hidden" name="___in_slug_kat_produk_special_ARPATEAM" value="<?= $result['slug'] ?>">
                            <input type="hidden" name="___in_slug_lama_special_ARPATEAM" value="<?= $resultData['slug']; ?>">
                            <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal -->

            <?php
                    }else{
            ?>

            <div class="col-md-6 col-lg-4 col-xl-3 my-3">
                <div class="card shadow">
                    <div class="card-header card-header-blog-lg border border-dark p-0">
                        <img src="<?= $penyimpananGambar ?>/<?= $resultData['gambar'] ?>" title="<?= $resultData['judul'] ?>" alt="Gambar <?= $resultData['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <div class="dropdown float-end mt-2">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahProduk<?= $resultData['id_produk'] ?>" class="dropdown-item"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= $base_url ?>/<?= $result['slug'] ?>/<?= $resultData['slug'] ?>" target="_blank" class="dropdown-item"><i class="far fa-paper-plane"></i> Detail Produk</a>
                                <a onclick="confirmHapusProduk('<?= $resultData['id_produk']; ?>', '<?= $result['slug']; ?>')" class="dropdown-item bg-danger text-light"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </div>
                        </div>
                        <div class="plan-header">
                            <h4 class="plan-title fw-bolder text-uppercase"><?= $resultData['judul'] ?></h4>
                            <h2 class="plan-price fw-bolder text-pink"><small class="fs-5">Rp</small><?= rp($resultData['harga']) ?></h2>
                            <?php if ($resultData['stock']==="Tersedia"): ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif ?>
                            <small class="badge bg-primary"><i class="fas fa-eye"></i> <?= rp($resultData['view']) ?>x</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="UbahProduk<?= $resultData['id_produk'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl">
                    <form action="<?= $base_url_admin ?>/editProduk" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <h4 class="alert-heading">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg> PERHATIAN!
                                    </h4>
                                    <hr class="my-2">
                                    <ul class="mb-1">
                                        <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                        <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                        <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="col-md-8 my-auto">
                                <div class="row">
                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Landing Page" value="<?= $resultData['judul']; ?>" required="">
                                            <label for="judul">Judul Produk</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="status_kat" name="___in_status_produk_special_ARPATEAM" required="">
                                                <option value="None" <?php if ($resultData['status']==="None") { echo "selected"; } ?>>None</option>
                                                <option value="Sale" <?php if ($resultData['status']==="Sale") { echo "selected"; } ?>>Sale</option>
                                            </select>
                                            <label for="status_kat">Status?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="stock" name="___in_stock_special_ARPATEAM" required="">
                                                <option value="Tersedia" <?php if ($resultData['stock']==="Tersedia") { echo "selected"; } ?>>Tersedia</option>
                                                <option value="Habis" <?php if ($resultData['stock']==="Habis") { echo "selected"; } ?>>Habis</option>
                                            </select>
                                            <label for="stock">Stock Produk</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control sub_harga" data-a-sign="Rp" name="___in_sub_harga_special_ARPATEAM" placeholder="Masukkan Sub Harga disini..." value="<?= $resultData['sub_harga'] ?>" required="">
                                            <label for="sub_harga">Sub Harga</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="diskon" name="___in_diskon_special_ARPATEAM" value="<?= $resultData['diskon'] ?>" placeholder="Masukkan Diskon disini..." min="0" required="">
                                            <label for="diskon">Diskon (%)</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control harga" data-a-sign="Rp" value="<?= $resultData['harga'] ?>" readonly>
                                            <label for="harga">Harga</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 my-auto">
                                <!-- file preview template -->
                                    <div class="col-12 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $resultData['gambar'] ?>" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM">
                                            <label for="gambar">Gambar</label>
                                        </div>
                                    </div>
                                <!-- file preview template -->
                            </div>

                            <div class="col-12 my-3">
                                <textarea name="___in_deskripsi_special_ARPATEAM" id="myEditorFroala" value="Test"><?= $resultData['deskripsi'] ?></textarea>
                            </div><!-- end col -->

                            <div class="col-12 my-1">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="slug-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#slug-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="slug-<?= $resultData['slug']; ?>" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="title-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#title-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="title-<?= $resultData['slug']; ?>" aria-selected="false">Title <span data-bs-toggle="tooltip" data-bs-placement="top" title="Title adalah judul atau nama sebuah konten website. Biasanya tertera di header atau bagian atas header."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="keywords-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#keywords-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="keywords-<?= $resultData['slug']; ?>" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="description-<?= $resultData['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#description-<?= $resultData['slug']; ?>" type="button" role="tab" aria-controls="description-<?= $resultData['slug']; ?>" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="slug-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="slug-<?= $resultData['slug']; ?>-tab">
                                        <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" value="<?= $resultData['slug']; ?>" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                    </div>
                                    <div class="tab-pane fade" id="title-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="title-<?= $resultData['slug']; ?>-tab">
                                        <input type="text" class="form-control" name="___in_title_special_ARPATEAM" value="<?= $resultData['title']; ?>" placeholder="Cth: Jasa Pembuatan Website Toko Online Murah">
                                    </div>
                                    <div class="tab-pane fade" id="keywords-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="keywords-<?= $resultData['slug']; ?>-tab">
                                        <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"><?= $resultData['keyword']; ?></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="description-<?= $resultData['slug']; ?>" role="tabpanel" aria-labelledby="description-<?= $resultData['slug']; ?>-tab">
                                        <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memberikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"><?= $resultData['description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="___in_id_produk_special_ARPATEAM" value="<?= $resultData['id_produk']; ?>">
                            <input type="hidden" name="___in_id_kat_produk_special_ARPATEAM" value="<?= $resultData['id_kat_produk']; ?>">
                            <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $resultData['id_sitemap']; ?>">
                            <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $resultData['gambar']; ?>">
                            <input type="hidden" name="___in_img_share_lama_special_ARPATEAM" value="<?= $resultData['img_share']; ?>">
                            <input type="hidden" name="___in_slug_kat_produk_special_ARPATEAM" value="<?= $result['slug'] ?>">
                            <input type="hidden" name="___in_slug_lama_special_ARPATEAM" value="<?= $resultData['slug']; ?>">
                            <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal -->

            <?php
                    }
                }
            ?>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php
            break;
        default:
            $hal                = "Kategori Produk";
            $penyimpananGambar  = "$url_images/category";
            $database           = "kat_produk";
            $database2          = "produk";
            $link               = "produk";
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3><?= $hal ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $hal ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#TambahKategori"><i class="fas fa-plus"></i> Tambah <?= $hal ?></button>

                    <div id="TambahKategori" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= $base_url_admin ?>/addKatProduk" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah <?= $hal ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <h4 class="alert-heading">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg> PERHATIAN!
                                            </h4>
                                            <hr class="my-2">
                                            <ul class="mb-1">
                                                <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                                <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                                <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Landing Page" required="">
                                            <label for="judul">Judul Kategori</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="status_kat" name="___in_status_kat_special_ARPATEAM" required="">
                                                <option value="Active">Active</option>
                                                <option value="Non-Active">Non-Active</option>
                                            </select>
                                            <label for="status_kat">Status?</label>
                                        </div>
                                    </div>

                                    <!-- file preview template -->
                                    <div class="col-6 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM" required="">
                                            <label for="gambar">Gambar</label>
                                        </div>
                                    </div>
                                    <div class="col-6 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-height="300" id="img_share" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_img_share_special_ARPATEAM" required="">
                                            <label for="img_share">Image Share</label>
                                        </div>
                                    </div>

                                    <div class="col-12 my-1">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="slug-tab" data-bs-toggle="tab" data-bs-target="#slug" type="button" role="tab" aria-controls="slug" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="title-tab" data-bs-toggle="tab" data-bs-target="#title" type="button" role="tab" aria-controls="title" aria-selected="false">Title <span data-bs-toggle="tooltip" data-bs-placement="top" title="Title adalah judul atau nama sebuah konten website. Biasanya tertera di header atau bagian atas header."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="keywords-tab" data-bs-toggle="tab" data-bs-target="#keywords" type="button" role="tab" aria-controls="keywords" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="slug" role="tabpanel" aria-labelledby="slug-tab">
                                                <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                            </div>
                                            <div class="tab-pane fade" id="title" role="tabpanel" aria-labelledby="title-tab">
                                                <input type="text" class="form-control" name="___in_title_special_ARPATEAM" placeholder="Cth: Jasa Pembuatan Website Toko Online Murah">
                                            </div>
                                            <div class="tab-pane fade" id="keywords" role="tabpanel" aria-labelledby="keywords-tab">
                                                <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"></textarea>
                                            </div>
                                            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                                                <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memberikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                    <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <!--Pricing Column-->
            <?php
                $query = $pdo->query("
                        SELECT *
                        FROM $database
                        ORDER BY status ASC");
                while($result = $query->fetch(PDO::FETCH_ASSOC)){
            ?>

            <div class="col-md-6 col-lg-4 col-xl-3 my-2">
                <div class="card shadow">
                    <div class="card-header card-header-blog-lg border border-dark p-0">
                        <img src="<?= $penyimpananGambar ?>/<?= $result['gambar'] ?>" title="<?= $result['judul'] ?>" alt="Gambar <?= $result['judul'] ?>" class="image-zoom-on-hover img-thumbnail rounded-top-5">
                    </div>
                    <div class="card-body p-2">
                        <div class="dropdown float-end mt-2">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahKategori<?= $result['slug'] ?>" class="dropdown-item"><i class="fas fa-edit"></i> Ubah</a>
                                <!-- item-->
                                <?php if ($result['status']==="Active"): ?>
                                    <a href="<?= $base_url_admin ?>/nonAktifkanKatProduk/<?= $result['slug'] ?>" class="dropdown-item text-danger"><i class="fas fa-toggle-off"></i> Non-Aktifkan</a>
                                <?php else: ?>
                                    <a href="<?= $base_url_admin ?>/aktifkanKatProduk/<?= $result['slug'] ?>" class="dropdown-item text-success"><i class="fas fa-toggle-on"></i> Aktifkan</a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="plan-header text-center">
                            <h2 class="fw-bolder my-0"><?= $result['judul'] ?></h2>
                        </div>

                        <div class="text-center">
                            <a href="<?= $link ?>/<?= $result['slug'] ?>" class="btn btn-sm btn-outline-pink rounded-pill my-3">Daftar Produk <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="UbahKategori<?= $result['slug'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <form action="<?= $base_url_admin ?>/editKatProduk" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <h4 class="alert-heading">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg> PERHATIAN!
                                    </h4>
                                    <hr class="my-2">
                                    <ul class="mb-1">
                                        <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                        <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                        <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="col-md-8 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Landing Page" value="<?= $result['judul']; ?>" required="">
                                    <label for="judul">Judul Kategori</label>
                                </div>
                            </div>
                            <div class="col-md-4 my-1">
                                <div class="form-floating">
                                    <select class="form-select" id="status_kat" name="___in_status_kat_special_ARPATEAM" required="">
                                        <option value="Active" <?php if ($result['status']==="Active") { echo "selected"; } ?>>Active</option>
                                        <option value="Non-Active" <?php if ($result['status']==="Non-Active") { echo "selected"; } ?>>Non-Active</option>
                                    </select>
                                    <label for="status_kat">Status?</label>
                                </div>
                            </div>

                            <!-- file preview template -->
                            <div class="col-6 my-3">
                                    <div class="form-floating">
                                        <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $result['gambar'] ?>" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM">
                                        <label for="gambar">Gambar</label>
                                    </div>
                                </div>
                                <div class="col-6 my-3">
                                    <div class="form-floating">
                                        <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $result['img_share'] ?>" data-height="300" id="img_share" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_img_share_special_ARPATEAM">
                                        <label for="img_share">Image Share</label>
                                    </div>
                                </div>

                            <div class="col-12 my-1">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="slug-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#slug-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="slug-<?= $result['slug']; ?>" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="title-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#title-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="title-<?= $result['slug']; ?>" aria-selected="false">Title <span data-bs-toggle="tooltip" data-bs-placement="top" title="Title adalah judul atau nama sebuah konten website. Biasanya tertera di header atau bagian atas header."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="keywords-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#keywords-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="keywords-<?= $result['slug']; ?>" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        <button class="nav-link" id="description-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#description-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="description-<?= $result['slug']; ?>" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="slug-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="slug-<?= $result['slug']; ?>-tab">
                                        <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" value="<?= $result['slug']; ?>" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                    </div>
                                    <div class="tab-pane fade" id="title-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="title-<?= $result['slug']; ?>-tab">
                                        <input type="text" class="form-control" name="___in_title_special_ARPATEAM" value="<?= $result['title']; ?>" placeholder="Cth: Jasa Pembuatan Website Toko Online Murah">
                                    </div>
                                    <div class="tab-pane fade" id="keywords-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="keywords-<?= $result['slug']; ?>-tab">
                                        <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"><?= $result['keyword']; ?></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="description-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="description-<?= $result['slug']; ?>-tab">
                                        <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memberikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"><?= $result['description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                            <input type="hidden" name="___in_id_kat_produk_special_ARPATEAM" value="<?= $result['id_kat_produk']; ?>">
                            <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $result['id_sitemap']; ?>">
                            <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $result['gambar']; ?>">
                            <input type="hidden" name="___in_img_share_lama_special_ARPATEAM" value="<?= $result['img_share']; ?>">
                            <input type="hidden" name="___in_slug_lama_special_ARPATEAM" value="<?= $result['slug']; ?>">
                            <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal -->

            <?php
                }
            ?>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php } ?>