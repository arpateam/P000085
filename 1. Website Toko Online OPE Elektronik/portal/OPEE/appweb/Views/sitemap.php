<?php
    switch ($_GET['act']) {
        case "daftar-sitemap":
            $hal                = "Sitemap";
            $hal2               = "Sitemap";
            $penyimpananGambar  = "$base_url/assets/files/images/sitemap";
            $database           = "sitemap";
            $database2          = "sub_sitemap";
            $link               = "sitemap";

            $stmt   = $pdo->prepare("
                    SELECT *
                    FROM $database2
                    WHERE slug = ?");

            $stmt->bindValue(1, $_GET["slug"]);
            $stmt->execute();
            $rows   = $stmt->rowCount();

            if ($rows>0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
                    <h3><?= $hal ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $hal2 ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $hal." ".$result['halaman'] ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#TambahSitemap"><i class="fas fa-plus"></i> Tambah <?= $hal." ".$result['halaman'] ?></button>

                    <div id="TambahSitemap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= $base_url_admin ?>/addSitemap" method="POST" data-parsley-validate="" class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah <?= $hal." ".$result['halaman'] ?></h4>
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
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-9 my-1">
                                        <div class="form-floating">
                                            <input type="url" class="form-control" id="loc" name="___in_loc_special_ARPATEAM" placeholder="Cth: https://arpateam.com/promo" value="<?= $base_url.'/'.$result['slug'] ?>" required="">
                                            <label for="loc">Url</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="priority" name="___in_priority_special_ARPATEAM" required="">
                                                <option value="1.00">1.00</option>
                                                <option value="0.90">0.90</option>
                                                <option value="0.80">0.80</option>
                                                <option value="0.70">0.70</option>
                                                <option value="0.60">0.60</option>
                                                <option value="0.50">0.50</option>
                                            </select>
                                            <label for="priority">Pilih Priority?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                    <input type="hidden" name="___in_id_sub_sitemap_special_ARPATEAM" value="<?= $result['id_sub_sitemap'] ?>">
                                    <input type="hidden" name="___in_slug_special_ARPATEAM" value="<?= $result['slug'] ?>">
                                    <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loc</th>
                                    <th>Lastmod</th>
                                    <th>Priority</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no=1;
                                    $queryData = $pdo->prepare("
                                            SELECT *
                                            FROM $database
                                            WHERE id_sub_sitemap = ?
                                            ORDER BY priority DESC");

                                    $queryData->bindValue(1, $result["id_sub_sitemap"]);
                                    $queryData->execute();
                                    while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                        
                                ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td class="text-wrap"><?= $resultData['loc'] ?></td>
                                    <td><?= $resultData['lastmod'] ?></td>
                                    <td><?= $resultData['priority'] ?></td>
                                    <td>
                                        <a role="button" data-bs-toggle="modal" data-bs-target="#UbahSitemap<?= $resultData['id_sitemap'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <a onclick="confirmHapusSitemap('<?= $resultData['id_sitemap']; ?>', '<?= $result['slug']; ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>

                                        <div id="UbahSitemap<?= $resultData['id_sitemap'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <form action="<?= $base_url_admin ?>/editSitemap" method="POST" data-parsley-validate="" class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Ubah <?= $hal." ".$result['halaman'] ?></h4>
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
                                                                </ul>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-9 my-1">
                                                            <div class="form-floating">
                                                                <input type="url" class="form-control" id="loc" name="___in_loc_special_ARPATEAM" placeholder="Cth: https://arpateam.com/promo" value="<?= $resultData['loc'] ?>" required="">
                                                                <label for="loc">Url</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 my-1">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="priority" name="___in_priority_special_ARPATEAM" required="">
                                                                    <option value="1.00" <?php if ($resultData['priority']==="1.00") { echo "selected"; } ?>>1.00</option>
                                                                    <option value="0.90" <?php if ($resultData['priority']==="0.90") { echo "selected"; } ?>>0.90</option>
                                                                    <option value="0.80" <?php if ($resultData['priority']==="0.80") { echo "selected"; } ?>>0.80</option>
                                                                    <option value="0.70" <?php if ($resultData['priority']==="0.70") { echo "selected"; } ?>>0.70</option>
                                                                    <option value="0.60" <?php if ($resultData['priority']==="0.60") { echo "selected"; } ?>>0.60</option>
                                                                    <option value="0.50" <?php if ($resultData['priority']==="0.50") { echo "selected"; } ?>>0.50</option>
                                                                </select>
                                                                <label for="priority">Pilih Priority?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                                        <input type="hidden" name="___in_id_sub_sitemap_special_ARPATEAM" value="<?= $result['id_sub_sitemap'] ?>">
                                                        <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $resultData['id_sitemap'] ?>">
                                                        <input type="hidden" name="___in_slug_special_ARPATEAM" value="<?= $result['slug'] ?>">
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
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php
            break;
        case "edit-layanan":
            $hal                = "Layanan";
            $hal2               = "Kategori Layanan";
            $penyimpananGambar  = "$base_url/assets/files/images/layanan";
            $database           = "layanan";
            $database2          = "kat_layanan";
            $link               = "layanan";

            $query  = $pdo->query("
                    SELECT judul, slug
                    FROM $database2
                    WHERE slug='$_GET[slug]'");
            $rows   = $query->rowCount();

            if ($rows>0) {
                $result     = $query->fetch(PDO::FETCH_ASSOC);

                $queryData  = $pdo->query("
                    SELECT *
                    FROM $database
                    WHERE slug='$_GET[slugedit]'");
                $rowsData   = $queryData->rowCount();

                if ($rowsData>0) {
                    $resultData = $queryData->fetch(PDO::FETCH_ASSOC);
                }else{
                    echo "<script>window.location.href = '$base_url_admin/$link';</script>";
                    die();
                    exit();
                }
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
            <h3><?= $hal ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $hal2 ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= $link.'/'.$result['slug'] ?>"><?= $result['judul'] ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $hal." ".$resultData['judul'] ?></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="<?= $base_url_admin ?>/editLayanan" method="POST" data-parsley-validate="" class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
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

                                <div class="col-md-3 my-1">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="no_urut" name="___in_no_urut_special_ARPATEAM" placeholder="Masukkan No Urut disini..." value="<?= $resultData['no_urut']; ?>" required="">
                                        <label for="no_urut">No Urut</label>
                                    </div>
                                </div>
                                <div class="col-md-9 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Landing Page" value="<?= $resultData['judul']; ?>" required="">
                                        <label for="judul">Judul Layanan</label>
                                    </div>
                                </div>

                                <div class="col-md-12 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="icon" name="___in_icon_special_ARPATEAM" placeholder='<i class="fa-brands fa-amazon-pay"></i>' value="<?= htmlspecialchars($resultData['icon']); ?>" required="">
                                        <label for="icon">Icon</label>
                                    </div>
                                </div>

                                <!-- file preview template -->
                                    <div class="col-6 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $resultData['gambar'] ?>" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM">
                                            <label for="gambar">Gambar</label>
                                        </div>
                                    </div>
                                    <div class="col-6 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $resultData['img_share'] ?>" data-height="300" id="img_share" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_img_share_special_ARPATEAM">
                                            <label for="img_share">Image Share</label>
                                        </div>
                                    </div>
                                <!-- file preview template -->

                                <div class="col-md-8 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="ubah_sub_harga" name="___in_sub_harga_special_ARPATEAM" placeholder="Masukkan Sub Harga disini..." data-a-dec="," data-a-sep="." value="<?= $resultData['sub_harga'] ?>" required="">
                                        <label for="ubah_sub_harga">Sub Harga</label>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="diskon" name="___in_diskon_special_ARPATEAM" value="<?= $resultData['diskon'] ?>" placeholder="Masukkan Diskon disini..." min="0" required="">
                                        <label for="diskon">Diskon</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="harga_tahunan" value="<?= $resultData['harga_tahunan'] ?>" data-a-dec="," data-a-sep="." readonly>
                                        <label for="harga_tahunan">Harga Tahunan</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="harga_bulanan" value="<?= $resultData['harga_bulanan'] ?>" data-a-dec="," data-a-sep="." readonly>
                                        <label for="harga_bulanan">Harga Bulanan</label>
                                    </div>
                                </div>

                                <div class="col-md-12 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="ubah_harga_perpanjangan" name="___in_perpanjangan_special_ARPATEAM" value="<?= $resultData['perpanjangan'] ?>" placeholder="Masukkan Harga Perpanjangan disini..." data-a-dec="," data-a-sep="." required="">
                                        <label for="ubah_harga_perpanjangan">Harga Perpanjangan</label>
                                    </div>
                                </div>

                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fitur_1" name="___in_fitur_1_special_ARPATEAM" value="<?= $resultData['fitur_1'] ?>" placeholder="Masukkan Fitur 1 disini..." required="">
                                        <label for="fitur_1">Fitur 1</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fitur_2" name="___in_fitur_2_special_ARPATEAM" value="<?= $resultData['fitur_2'] ?>" placeholder="Masukkan Fitur 2 disini..." required="">
                                        <label for="fitur_2">Fitur 2</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fitur_3" name="___in_fitur_3_special_ARPATEAM" value="<?= $resultData['fitur_3'] ?>" placeholder="Masukkan Fitur 3 disini..." required="">
                                        <label for="fitur_3">Fitur 3</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fitur_4" name="___in_fitur_4_special_ARPATEAM" value="<?= $resultData['fitur_4'] ?>" placeholder="Masukkan Fitur 4 disini..." required="">
                                        <label for="fitur_4">Fitur 4</label>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fitur_5" name="___in_fitur_5_special_ARPATEAM" value="<?= $resultData['fitur_5'] ?>" placeholder="Masukkan Fitur 5 disini..." required="">
                                        <label for="fitur_5">Fitur 5</label>
                                    </div>
                                </div>

                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <select class="form-select" id="terlaris" name="___in_terlaris_special_ARPATEAM" required="">
                                            <option value="Yes" <?php if ($resultData['terlaris']==="Yes") { echo "selected"; } ?>>Yes</option>
                                            <option value="No" <?php if ($resultData['terlaris']==="No") { echo "selected"; } ?>>No</option>
                                        </select>
                                        <label for="terlaris">Terlaris?</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <select class="form-select" id="status_kat" name="___in_status_layanan_special_ARPATEAM" required="">
                                            <option value="Active" <?php if ($resultData['status']==="Active") { echo "selected"; } ?>>Active</option>
                                            <option value="Non-Active" <?php if ($resultData['status']==="Non-Active") { echo "selected"; } ?>>Non-Active</option>
                                        </select>
                                        <label for="status_kat">Status?</label>
                                    </div>
                                </div>

                                <div class="col-12 my-3">
                                    <div>
                                        <input type="hidden" name="ubahDeskripsi">
                                        <div id="ubahDeskripsi" style="min-height: 160px;"><?= $resultData['deskripsi'] ?></div>
                                    </div>
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
                                            <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memerikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"><?= $resultData['description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="___in_id_layanan_special_ARPATEAM" value="<?= $resultData['id_layanan']; ?>">
                                <input type="hidden" name="___in_id_kat_layanan_special_ARPATEAM" value="<?= $resultData['id_kat_layanan']; ?>">
                                <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $resultData['id_sitemap']; ?>">
                                <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $resultData['gambar']; ?>">
                                <input type="hidden" name="___in_img_share_lama_special_ARPATEAM" value="<?= $resultData['img_share']; ?>">
                                <input type="hidden" name="___in_slug_kat_layanan_special_ARPATEAM" value="<?= $result['slug'] ?>">
                                <input type="hidden" name="___in_slug_lama_special_ARPATEAM" value="<?= $resultData['slug']; ?>">
                                <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php
            break;
        default:
            $hal        = "Sitemap";
            // $penyimpananGambar  = "$base_url/assets/files/images/sitemap";
            $database   = "sub_sitemap";
            $database2  = "sitemap";
            $link       = "sitemap";
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <h3><?= $hal ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $hal ?></li>
                </ol>
            </nav>
        </div>
        <div class="row mt-3 justify-content-center">
            <?php
                $stmt = $pdo->prepare("
                        SELECT *
                        FROM $database");
                $stmt->execute();
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $stmt2  = $pdo->prepare("
                        SELECT *
                        FROM $database2
                        WHERE id_sub_sitemap = ?");

                    $stmt2->bindValue(1, $result['id_sub_sitemap']);
                    $stmt2->execute();
                    $result2 = $stmt2->rowCount();
            ?>

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="sitemap/<?= $result['slug'] ?>" class="dropdown-item"><i class="fas fa-external-link-alt"></i> Detail</a>
                            </div>
                        </div>

                        <h4 class="header-title mt-0 mb-3">Sitemap <?= $result['halaman'] ?></h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                <h2 class="fw-normal mb-1"> <?= rp($result2) ?> </h2>
                                <p class="text-muted">Total url <?= $result['halaman'] ?></p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php } ?>