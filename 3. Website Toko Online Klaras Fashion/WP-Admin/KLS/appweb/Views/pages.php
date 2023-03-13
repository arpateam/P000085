<?php
    $hal                = "Halaman Website";
    $penyimpananGambar  = "$base_url/assets/files/images/pages";
    $database           = "page";
    $link               = "halaman";
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <h3><?= $hal ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar <?= $hal ?></li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Halaman</th>
                                            <th>Slug</th>
                                            <th>Terakhir Update</th>
                                            <th width="125">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no=1;
                                            $query = $pdo->query("
                                                    SELECT *
                                                    FROM $database");
                                            while($result = $query->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $result['judul'] ?></td>
                                            <td>/<?= $result['slug'] ?></td>
                                            <td><?= indoTgl($result['tgl_update']) ?></td>
                                            <td>
                                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahHalaman<?= $result['slug'] ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Ubah</a>
                                                <div id="UbahHalaman<?= $result['slug'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog <?php if($result['jenis_page']==="All"){ echo 'modal-xl'; }elseif($result['jenis_page']==="SEO"){ echo 'modal-lg'; } ?>">
                                                        <form action="<?= $base_url_admin ?>/editHalaman" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
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

                                                                <div class="col-md-12 my-1">
                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Cth: Beranda" value="<?= $result['judul']; ?>" required="">
                                                                        <label for="judul">Nama Halaman</label>
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

                                                                <?php if ($result['jenis_page']==="All"): ?>
                                                                    <div class="col-12 my-3">
                                                                        <textarea name="___in_deskripsi_special_ARPATEAM" id="myEditorFroala" value="Test" required=""><?= $result['deskripsi'] ?></textarea>
                                                                    </div><!-- end col -->
                                                                <?php endif ?>

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
                                                                            <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" value="<?= $result['slug']; ?>" placeholder="Cth: jasa-pembuatan-website-toko-online" required="">
                                                                        </div>
                                                                        <div class="tab-pane fade" id="title-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="title-<?= $result['slug']; ?>-tab">
                                                                            <input type="text" class="form-control" name="___in_title_special_ARPATEAM" value="<?= $result['title']; ?>" placeholder="Cth: Jasa Pembuatan Website Toko Online Murah" required="">
                                                                        </div>
                                                                        <div class="tab-pane fade" id="keywords-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="keywords-<?= $result['slug']; ?>-tab">
                                                                            <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja" required=""><?= $result['keyword']; ?></textarea>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="description-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="description-<?= $result['slug']; ?>-tab">
                                                                            <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memerikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online" required=""><?= $result['description']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                                                <input type="hidden" name="___in_id_page_special_ARPATEAM" value="<?= $result['id_page']; ?>">
                                                                <input type="hidden" name="___in_jenis_page_special_ARPATEAM" value="<?= $result['jenis_page']; ?>">
                                                                <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $result['id_sitemap']; ?>">
                                                                <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $result['gambar']; ?>">
                                                                <input type="hidden" name="___in_img_share_lama_special_ARPATEAM" value="<?= $result['img_share']; ?>">
                                                                <input type="hidden" name="___in_slug_lama_special_ARPATEAM" value="<?= $result['slug']; ?>">
                                                                <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal -->
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->