<?php

    switch ($_GET['act']) {
        case 'list':

            $hal        = "Tagihan";
            $database   = "klien";
            $link       = "tagihan";

            if ((date("H:i") >= "00:01") AND (date("H:i") <= "10:00")) {
                $waktu  = "Selamat Pagi";
            }elseif ((date("H:i") >= "10:01") AND (date("H:i") <= "15:00")) {
                $waktu  = "Selamat Siang";
            }elseif ((date("H:i") >= "15:01") AND (date("H:i") <= "18:00")) {
                $waktu  = "Selamat Sore";
            }else{
                $waktu  = "Selamat Malam";
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
                    <li class="breadcrumb-item active" aria-current="page"><?= $hal ?></li>
                </ol>
            </nav>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="max-width: 3%;">No.</th>
                                    <th style="max-width: 17%;">No. Klien</th>
                                    <th style="max-width: 50%;">Keterangan Klien</th>
                                    <th style="max-width: 15%;">Waktu Tagihan</th>
                                    <th style="max-width: 15%;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $StatusActive = "Active";
                                    try{
                                        $query = $pdo->prepare("
                                                SELECT *
                                                FROM $database
                                                WHERE status = ?
                                                ORDER BY perpanjangan ASC");

                                        $query->bindValue(1, $StatusActive);
                                        $query->execute();
                                        while($result = $query->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?= $result['no_urut'] ?></td>
                                    <td><span class="badge bg-pink p-1 text-uppercase fs-5"><?= $result['no_klien'] ?></span></td>
                                    <td class="text-wrap py-0">
                                        <h5 class="text-pink fw-bolder mb-0">Nama Bidang Usaha/Instansi</h5>
                                        <span><?= $result['nama'] ?></span>
                                        <h5 class="text-pink fw-bolder mb-0">Nama Klien</h5>
                                        <span><?= $result['nama_klien'] ?></span>
                                    </td>
                                    <td class="text-wrap">
                                        <h4 class="text-pink fw-bolder"><?= indoTgl($result['perpanjangan']) ?></h4>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= whatsApp($result['nomor_whatsapp']) ?>&text=<?= urlencode($waktu) ?>%20*<?= urlencode($result['nama_klien']) ?>*%2C%0A%0AKami%20ingin%20mengingatkan%20kembali%20bahwa%20masa%20aktif%20*<?= urlencode($result['nama']) ?>*%20akan%20habis%20pada%20tanggal%20*<?= urlencode(indoTgl($result['perpanjangan'])) ?>*.%0A%0ASehubungan%20dengan%20itu%2C%20maka%20harus%20dilakukan%20perpanjangan%20lagi%20agar%20websitenya%20bisa%20terus%20aktif.%0A%0AUntuk%20detail%20biaya%20perpanjangan%20website%20*(Terlampir%20Pada%20Invoice)*.%0A%0ACATATAN%3A%0A(1)%20Jika%20ingin%20di%20perpanjang%2C%20mohon%20untuk%20membayar%20sebelum%20tanggal%20*<?= urlencode(indoTgl($result['perpanjangan'])) ?>*%2C%20agar%20websitenya%20tidak%20terblokir%0A(2)%20Invoice%20perpanjangan%20website%20terlampir%0A(3)%20Nomor%20Rekening%20pembayaran%20terlampir%20pada%20Invoice" title="Hubungi Klien" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> Hubungi Klien</a>
                                            <hr class="my-1" />
                                            <button type="button" class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#KontakLain<?= $result['no_klien'] ?>"><i class="fas fa-external-link-alt"></i> Kontak Lain</button>
                                        </div>

                                        <div id="KontakLain<?= $result['no_klien'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Kontak Lain</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <h1><?= $result['kontak_lain'] ?></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.modal -->
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }catch(Exception $e){
                                        var_dump($e);
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- end col-->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>

<?php

            break;
        
        default:

            header("location: $base_url_admin/keluar-edit");
            die();
            exit();

            break;
    }

?>