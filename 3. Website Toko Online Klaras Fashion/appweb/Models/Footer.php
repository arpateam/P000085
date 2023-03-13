<footer class="container-fluid bg-primary py-5" data-aos="fade-up" data-aos-duration="3500">
    <div class="container px-0 px-sm-2 text-muted">
    	<div class="row justify-content-between">
    		<div class="col-md-12 col-lg-4" data-aos="fade-up" data-aos-duration="4000">
    			<h4 class="mb-3 mb-lg-4 text-dark fw-bolder">Offline Store</h4>

    			<h5 class="text-dark"><?= $nama_web ?></h5>
    			<p><?= $alamat ?></p>

    			<?= $googleMaps ?>
    		</div>
    		<div class="col-md-6 col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-duration="4000">
    			<h4 class="mb-3 mb-lg-4 text-dark fw-bolder">Category</h4>

    			<p class="lh-lg">
    				<?php
                        try{
                            $stmtCategoryFooter = $pdo->prepare("
                                    SELECT judul, slug
                                    FROM kat_produk
                                    WHERE status = ?
                            ");

                            $stmtCategoryFooter->bindValue(1, "Active");
                            $stmtCategoryFooter->execute();
                            while($resultCategoryFooter = $stmtCategoryFooter->fetch(PDO::FETCH_ASSOC)){
                    ?>
		            <a href="<?= $base_url ?>/<?= $resultCategoryFooter['slug'] ?>" class="link-dark-footer"><i class="fa-solid fa-angle-right"></i> <?= $resultCategoryFooter['judul'] ?></a>
		            <br />
                    <?php
                            }
                        }catch(Exception $e){
                            var_dump($e);
                        }
                    ?>
		        </p>
                <h4 class="mb-3 mb-lg-4 text-dark fw-bolder">Information</h4>

                <div class="row">
                    <div class="col-6 col-sm-12 col-md-6 col-lg-12">
                        <p class="lh-lg mb-0">
                            <a href="<?= $base_url ?>/how-to-order" class="link-dark-footer <?php if($_GET['module']=='how-to-order'){ echo 'active'; } ?>"><i class="fa-solid fa-angle-right"></i> How to Order</a>
                            <br />

                            <a href="<?= $base_url ?>/payment-method" class="link-dark-footer <?php if($_GET['module']=='payment-method'){ echo 'active'; } ?>"><i class="fa-solid fa-angle-right"></i> Payment Method</a>
                            <br />

                            <a href="<?= $base_url ?>/blog" class="link-dark-footer <?php if($_GET['module']=='blog'){ echo 'active'; } ?>"><i class="fa-solid fa-angle-right"></i> Blog</a>
                            <br />

                            <a href="<?= $base_url ?>/pembayaran" class="link-dark-footer <?php if($_GET['module']=='pembayaran'){ echo 'active'; } ?>"><i class="fa-solid fa-angle-right"></i> Pembayaran</a>
                            <br />

                            <a href="<?= $base_url ?>/about-us" class="link-dark-footer <?php if($_GET['module']=='about-us'){ echo 'active'; } ?>"><i class="fa-solid fa-angle-right"></i> About Us</a>
                        </p>
                    </div>
                </div>
    		</div>
    		<div class="col-sm-6 col-md-5 col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-duration="4000">
    			<h4 class="mb-3 mb-lg-4 text-dark fw-bolder">Contact Us</h4>

	            <a href="tel:<?= $nomorTelpSms ?>" class="link-dark-footer"><i class="fa-solid fa-phone"></i> <?= $nomorTelpSms ?></a>
	            <br />

	            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= whatsApp($nomorWhatsApp) ?>&text=Halo%20%23ARPATEAM..." class="link-dark-footer"><i class="fa-brands fa-whatsapp"></i> <?= $nomorWhatsApp ?></a>

	            <br />
	            <a href="mailto:<?= $email ?>" class="link-dark-footer"><i class="fa-solid fa-envelope"></i> <?= $email ?></a>

	            <br /><br />
	            <a target="_blank" role="button" href="<?= $linkInstagram ?>" title="Instagram" class="btn btn-sm btn-outline-dark"><i class="fa-brands fa-instagram"></i></a>
	            <a target="_blank" role="button" href="<?= $linkTikTok ?>" title="TikTok" class="btn btn-sm btn-outline-dark"><i class="fa-brands fa-tiktok"></i></a>
	            <a target="_blank" role="button" href="<?= $linkYouTube ?>" title="YouTube" class="btn btn-sm btn-outline-dark"><i class="fa-brands fa-youtube"></i></a>

	            <p class="mt-4">Silakan hubungi kami melalui Alamat dan Info yang tertera untuk mendapatka Promo menaik dari kami.</p>
    		</div>
    	</div>
    </div>
</footer>

<section class="container-fluid bg-primary py-4 border-top border-light">
    <div class="container px-0 px-sm-2">
    	<div class="row justify-content-center">
    		<?php
                try{
                    $stmtPembayaranFooter = $pdo->prepare("
                            SELECT gambar, jenis_pembayaran
                            FROM metode_pembayaran
                            WHERE status = ?
                            ORDER BY no_urut ASC
                    ");

                    $stmtPembayaranFooter->bindValue(1, "Active");
                    $stmtPembayaranFooter->execute();
                    while($resultPembayaranFooter = $stmtPembayaranFooter->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="col-2 col-lg-1 my-auto">
                <img src="<?= $url_images ?>/payment-method/<?= $resultPembayaranFooter['gambar'] ?>" alt="Pembayaran Via <?= $resultPembayaranFooter['jenis_pembayaran'] ?>" class="img-fluid my-1">
            </div>
            <?php
                    }
                }catch(Exception $e){
                    var_dump($e);
                }
            ?>
    	</div>
    </div>
    <div class="container mt-4 px-0 px-sm-2 text-center text-muted">
    	<span>Copyright &copy; <?= date("Y") ?> <a href="<?= $base_url ?>" title="<?= $nama_web ?>" class="link-dark-footer"><?= $nama_web ?></a> All right reserved. Design Website by <a target="_blank" href="https://www.arpateam.com" title="Website #ARPATEAM" class="link-dark-footer fw-bolder">#ARPATEAM</a>.</span>
    </div>
</section>