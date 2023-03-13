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
                        <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
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
                                    <td class="text-center">
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
                                                            <div class="alert alert-warning alert-dismissible fade show text-start" role="alert">
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