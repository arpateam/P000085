<?php
    $hal                = "Metode Pembayaran";
    $penyimpananGambar  = "$url_images/payment-method";
    $database           = "metode_pembayaran";
    $link               = "metode-pembayaran";
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
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#TambahMetodePembayaran"><i class="fas fa-plus"></i> Tambah <?= $hal ?></button>

                    <div id="TambahMetodePembayaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= $base_url_admin ?>/addMetodePembayaran" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
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
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-3 my-1">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="no_urut" name="___in_no_urut_special_ARPATEAM" min="1" placeholder="Cth: 1" required="">
                                            <label for="no_urut">No. Urut</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="jenis_pembayaran" name="___in_jenis_pembayaran_special_ARPATEAM" placeholder="Cth: BRI" required="">
                                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="no_rekening" name="___in_no_rekening_special_ARPATEAM" placeholder="Cth: 5771-202111" required="">
                                            <label for="no_rekening">Nomor Rekening</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="atas_nama" name="___in_atas_nama_special_ARPATEAM" placeholder="Cth: Aldi Febriyanto" required="">
                                            <label for="atas_nama">Atas Nama</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="status_metode_pembayaran" name="___in_status_metode_pembayaran_special_ARPATEAM" required="">
                                                <option value="Active">Active</option>
                                                <option value="Non-Active">Non-Active</option>
                                            </select>
                                            <label for="status_metode_pembayaran">Status?</label>
                                        </div>
                                    </div>

                                    <!-- file preview template -->
                                    <div class="col-12 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif, image/svg" name="___in_gambar_special_ARPATEAM" required="">
                                            <label for="gambar">Gambar Metode Pembayaran</label>
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

            <div class="col-xl-4">
                <div class="card">
                    <div class="text-center card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop position-absolute"  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahMetodePembayaran<?= $result['id_metode_pembayaran'] ?>" class="dropdown-item"><i class="fas fa-edit"></i> Ubah <?= $hal ?></a>
                                <!-- item-->
                                <?php if ($result['status']==="Active"): ?>
                                    <a href="nonAktifkanMetodePembayaran/<?= $result['id_metode_pembayaran'] ?>" class="dropdown-item text-danger"><i class="fas fa-toggle-off"></i> Non-Aktifkan</a>
                                <?php else: ?>
                                    <a href="aktifkanMetodePembayaran/<?= $result['id_metode_pembayaran'] ?>" class="dropdown-item text-success"><i class="fas fa-toggle-on"></i> Aktifkan</a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div>
                            <img src="<?= $penyimpananGambar ?>/<?= $result['gambar'] ?>" title="<?= $result['jenis_pembayaran'] ?>" alt="Gambar <?= $result['jenis_pembayaran'] ?>" class="w-75 text-center">

                            <h2 class="mt-4"><?= $result['no_rekening'] ?></h2>

                            <p class="text-muted font-18">
                                <small class="fs-6">a/n</small> <?= $result['atas_nama'] ?>
                            </p>

                            <hr>

                            <?php if ($result['status']==="Active"): ?>
                                <span class="badge bg-success p-1"><i class="far fa-check-circle"></i> Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger p-1"><i class="fas fa-ban"></i> Non-Active</span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div id="UbahMetodePembayaran<?= $result['id_metode_pembayaran'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <form action="<?= $base_url_admin ?>/editMetodePembayaran" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
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
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="col-md-3 my-1">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="no_urut" name="___in_no_urut_special_ARPATEAM" min="1" placeholder="Cth: 1" value="<?= $result['no_urut'] ?>" required="">
                                    <label for="no_urut">No. Urut</label>
                                </div>
                            </div>
                            <div class="col-md-9 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="jenis_pembayaran" name="___in_jenis_pembayaran_special_ARPATEAM" placeholder="Cth: BRI" value="<?= $result['jenis_pembayaran'] ?>" required="">
                                    <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                </div>
                            </div>

                            <div class="col-md-6 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="no_rekening" name="___in_no_rekening_special_ARPATEAM" placeholder="Cth: 5771-202111" value="<?= $result['no_rekening'] ?>" required="">
                                    <label for="no_rekening">Nomor Rekening</label>
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="atas_nama" name="___in_atas_nama_special_ARPATEAM" placeholder="Cth: Aldi Febriyanto" value="<?= $result['atas_nama'] ?>" required="">
                                    <label for="atas_nama">Atas Nama</label>
                                </div>
                            </div>

                            <div class="col-md-12 my-1">
                                <div class="form-floating">
                                    <select class="form-select" id="status_metode_pembayaran" name="___in_status_metode_pembayaran_special_ARPATEAM" required="">
                                        <option value="Active" <?php if ($result['status']==="Active") { echo "selected"; } ?>>Active</option>
                                        <option value="Non-Active" <?php if ($result['status']==="Non-Active") { echo "selected"; } ?>>Non-Active</option>
                                    </select>
                                    <label for="status_metode_pembayaran">Status?</label>
                                </div>
                            </div>

                            <!-- file preview template -->
                            <div class="col-12 my-3">
                                <div class="form-floating">
                                    <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $result['gambar'] ?>" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif, image/svg" name="___in_gambar_special_ARPATEAM">
                                    <label for="gambar">Gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                            <input type="hidden" name="___in_id_metode_pembayaran_special_ARPATEAM" value="<?= $result['id_metode_pembayaran']; ?>">
                            <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $result['gambar']; ?>">
                            <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal -->

            <?php } ?>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->