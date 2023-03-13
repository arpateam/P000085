<nav id="navbar_top" class="container-fluid sticky-top navbar navbar-expand-md bg-white navbar-light shadow-sm" data-aos="fade-down" data-aos-duration="1500">
    <div class="container px-0 px-sm-2 py-1">
        <a class="navbar-brand d-block d-md-none" href="<?= $base_url; ?>">
          	<img src="<?= $url_images; ?>/<?= $logoMobile ?>" title="<?= $judulLogoMobile; ?>" alt="Gambar <?= $judulLogoMobile; ?>" id="navbar_brand" class="navbar-brand-50">
        </a>

        <button class="navbar-toggler text-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <hr class="border border-white d-block d-md-none">
            <ul class="navbar-nav">
                <li class="nav-item">
	            	<a class="nav-link <?php if($_GET['module']=='produk' AND $_GET['view']=='new-arrivals'){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>/new-arrivals" title="New Arrivals">
	            		New Arrivals
					</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET['module']=='produk' AND $_GET['view']=='best-seller'){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>/best-seller" title="Best Seller">
                        Best Seller
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET['module']=='produk' AND $_GET['view']=='sale'){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>/sale" title="Sale">Sale <span class="text-danger"><i class="fa-solid fa-tag"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET['module']=='produk' AND $_GET['view']=='all-products'){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>/all-products" title="All Products">
                        All Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(($_GET['module']=='produk' AND $_GET['view']=='list-category') OR ($_GET['module']=='produk' AND $_GET['view']=='detail-category')){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>/category" title="Category">
                        Category
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if(($_GET['module']=='pages') OR ($_GET['module']=='blog')){ echo 'active'; } ?>" title="Information" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Information
                    </a>
                    <ul class="dropdown-menu fade-up shadow navbar-nav-scroll overflow-auto text-wrap" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php if($_GET['module']=='pages' AND $_GET['view']=='how-to-order'){ echo 'active'; } ?>" href="<?= $base_url ?>/how-to-order"><span class="me-1"><i class="fa-solid fa-headset"></i></span> How to Order</a></li>
                        <li><a class="dropdown-item <?php if($_GET['module']=='pages' AND $_GET['view']=='payment-method'){ echo 'active'; } ?>" href="<?= $base_url ?>/payment-method"><span class="me-1"><i class="fa-solid fa-credit-card"></i></span> Payment Method</a></li>
                        <li><a class="dropdown-item <?php if($_GET['module']=='blog'){ echo 'active'; } ?>" href="<?= $base_url ?>/blog"><span class="me-1"><i class="fa-solid fa-newspaper"></i></span> Blog</a></li>
                        <li><a class="dropdown-item <?php if($_GET['module']=='pages' AND $_GET['view']=='about-us'){ echo 'active'; } ?>" href="<?= $base_url ?>/about-us"><span class="me-1"><i class="fa-regular fa-address-card"></i></span> About Us</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>