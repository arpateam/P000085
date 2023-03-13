<footer class="container-fluid bg-dark py-4 mt--2">
	<div class="container px-0 px-sm-2 text-center text-light">
		<div class="row">
			<div class="col-md-4 text-start">
				<img src="<?= $url_images; ?>/<?= $logoMobile ?>" title="<?= $judulLogoMobile; ?>" alt="Gambar <?= $judulLogoMobile; ?>" class="img-fluid mb-3">
				<h5 class="text-success fw-bolder"><?= $slogan ?></h5>
				<small class="fw-bolder">Dikembangkan oleh:</small>
				<br />
				<small><strong>TIM MAGANG UAD</strong><br /><?= $alamat ?></small>
			</div>
			<div class="col-md-4 text-start">
				<h4 class="text-success fw-bolder">Kategori Produk</h4>
				<hr />
				<ul class="list-unstyled lh-lg">
					<?php
	                    try {
	                        $queryMenuFooter = $pdo->prepare("
	                                SELECT judul, slug
	                                FROM kat_produk
	                                ORDER BY urutan ASC");

	                        $queryMenuFooter->execute();
	                        while($resultMenuFooter = $queryMenuFooter->fetch(PDO::FETCH_ASSOC)){
	                ?>
	                <li><a href="<?= $base_url ?>/produk/<?= $resultMenuFooter['slug'] ?>" title="<?= $resultMenuFooter['judul'] ?>" class="link-light-footer <?php if($_GET['module']=='produk' AND $_GET['act']=='kategori' AND  $_GET['kat_slug']===$resultMenuFooter['slug']){ echo 'active'; } ?>"><i class="fa-solid fa-arrow-right-long"></i> <?= $resultMenuFooter['judul'] ?></a></li>
	                <?php
	                        }   
	                    } catch (Exception $e) {
	                        var_dump($e);
	                    }
	                ?>
				</ul>
			</div>
			<div class="col-md-4 text-start">
				<h4 class="text-success fw-bolder">Alamat</h4>
				<hr />
				<?= $googleMaps ?>
			</div>
		</div>

		<hr class="my-4" />

		<a target="_blank" href="<?= $linkInstagram ?>" title="Instagram Kami" class="link-danger text-decoration-none m-2"><i class="fa-brands fa-instagram fa-xl"></i></a>
        <a target="_blank" href="<?= $linkFacebook ?>" title="Facebook Kami" class="link-primary text-decoration-none m-2"><i class="fa-brands fa-facebook fa-xl"></i></a>
        <a target="_blank" href="<?= $linkTwitter ?>" title="Twitter Kami" class="link-info text-decoration-none m-2"><i class="fa-brands fa-twitter fa-xl"></i></a>
        <a target="_blank" href="<?= $linkYouTube ?>" title="Youtube Kami" class="link-danger text-decoration-none m-2"><i class="fa-brands fa-youtube fa-xl"></i></a>
        <a href="mailto:<?= $email ?>" title="Email Kami" class="link-danger text-decoration-none m-2"><i class="fa-solid fa-envelope fa-xl"></i></a>
	    <br /><br />
		<small class="text-muted">&copy; <?= date("Y")." ".$nama_web ?></small>
	</div>
</footer>