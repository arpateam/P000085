-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 06:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_p000062`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id_data_admin` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `level` enum('Administrator') NOT NULL,
  `status` enum('Active','Non-Active') NOT NULL,
  `session` text DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id_data_admin`, `username`, `password`, `nama`, `jenis_kelamin`, `avatar`, `level`, `status`, `session`, `terakhir_login`) VALUES
(0, 'arpateam', '$2y$10$i98Fi5Gygbpzk3uB4cGeWeDjU.WuGFt0UDbHP5BC.FoUQXR2UAgDi', '#ARPATEAM', 'Laki-Laki', 'arpateam-administrator.png', 'Administrator', 'Active', NULL, '2022-09-23 13:54:16'),
(1, 'admin', '$2y$10$pXsJr37yeo5nKojWCUv9P.YJyDnM9yeBWa4ykyRUyLGpazgHOKByO', 'Admin OPE Elektronik', 'Laki-Laki', 'admin-ope-elektronik-administrator.png', 'Administrator', 'Active', 'f87f405941cf41f0c2b5b1939e8a1f9edac7e03c7ceb1491ca5ef467f3bdc6db4bec974789d092946bf563d3e40bac9da81b5d4e19d640d86c02ca1a36704e58', '2023-01-05 10:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `kat_produk`
--

CREATE TABLE `kat_produk` (
  `id_kat_produk` int(4) NOT NULL,
  `urutan` int(3) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tgl_update` date NOT NULL,
  `id_sitemap` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kat_produk`
--

INSERT INTO `kat_produk` (`id_kat_produk`, `urutan`, `judul`, `gambar`, `slug`, `keyword`, `description`, `tgl_update`, `id_sitemap`) VALUES
(1, 1, 'Laptop', 'laptop.png', 'laptop', 'Laptop', 'Laptop', '2023-01-05', 5),
(2, 2, 'Kamera', 'kamera.png', 'kamera', 'Kamera', 'Kamera', '2023-01-05', 6),
(3, 3, 'Lensa', 'lensa.png', 'lensa', 'Lensa', 'Lensa', '2023-01-05', 7);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id_page` int(4) NOT NULL,
  `jenis_page` enum('All','Gambar','Deskripsi','SEO') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `img_share` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `description` text NOT NULL,
  `tgl_update` date NOT NULL,
  `id_sitemap` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id_page`, `jenis_page`, `judul`, `gambar`, `img_share`, `deskripsi`, `slug`, `title`, `keyword`, `description`, `tgl_update`, `id_sitemap`) VALUES
(1, 'SEO', 'Beranda', 'beranda.png', 'beranda-img-share.png', NULL, 'beranda', 'Website Toko Online OPE Elektronik', 'Toko OPE Elektronik Menjual Laptop, Kamera, &amp; Lensa Baru dan Secound di Jogja', 'Toko Online OPE Elektronik Menjual Laptop, Kamera, &amp; Lensa Baru dan Secound Terlengkap di Jogja', '2023-01-05', 1),
(2, 'SEO', 'Produk', 'produk.png', 'produk-img-share.png', NULL, 'produk', 'Katalog Produk OPE Elektronik', 'Katalog Produk OPE Elektronik menjual berbagai pilihan Laptop, Kamera, &amp; Lensa Baru dan Secound di Jogja', 'Katalog Produk OPE Elektronik menjual berbagai pilihan Laptop, Kamera, &amp; Lensa Baru dan Secound terlengkap dan bergaransi di Jogja', '2023-01-05', 2),
(3, 'SEO', 'Kontak Kami', 'kontak-kami.png', 'kontak-kami-img-share.png', NULL, 'kontak-kami', 'Informasi Layanan OPE Elektronik', 'Kontak Resmi OPE Elektronik', 'Kontak Resmi OPE Elektronik | Toko Online OPE Elektronik Menjual Laptop, Kamera, &amp; Lensa Baru dan Secound Terlengkap di Jogja', '2023-01-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(4) NOT NULL,
  `no_urut` int(4) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis_pengaturan` enum('Gambar','Deskripsi','Teks','Textarea') NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Active','Non-Active') NOT NULL,
  `tgl_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `no_urut`, `judul`, `jenis_pengaturan`, `gambar`, `deskripsi`, `status`, `tgl_update`) VALUES
(1, 1, 'Icon Website', 'Gambar', 'icon-website.png', NULL, 'Active', '2023-01-05'),
(2, 2, 'Logo Website (Versi Desktop)', 'Gambar', 'logo-website-versi-desktop.png', NULL, 'Active', '2023-01-05'),
(3, 3, 'Logo Website (Versi Mobile)', 'Gambar', 'logo-website-versi-mobile.png', NULL, 'Active', '2023-01-05'),
(4, 4, 'Nomor WhatsApp', 'Teks', NULL, '+62822 2809 6594', 'Active', '2022-09-13'),
(5, 5, 'Nomor Telp./SMS', 'Teks', NULL, '0822 2809 6594', 'Active', '2022-09-13'),
(6, 6, 'Instagram', 'Teks', NULL, 'https://www.instagram.com', 'Active', '2023-01-05'),
(7, 7, 'Facebook', 'Teks', NULL, 'https://web.facebook.com/', 'Active', '2022-03-28'),
(8, 8, 'Twitter', 'Teks', NULL, '#', 'Active', '2022-03-28'),
(9, 9, 'YouTube', 'Teks', NULL, 'https://www.youtube.com', 'Active', '2023-01-05'),
(10, 10, 'Email', 'Teks', NULL, '-', 'Active', '2022-07-24'),
(11, 11, 'Google Maps', 'Textarea', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2989665668597!2d110.39820801477786!3d-7.758083194408517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a599977ac8e1b%3A0xc28ff50874bd94a8!2sPolda%20DIY!5e0!3m2!1sid!2sid!4v1663924572105!5m2!1sid!2sid\" width=\"100%\" height=\"225\" class=\"rounded-5 shadow\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Active', '2022-09-23'),
(12, 12, 'Alamat', 'Textarea', NULL, 'Jl. Ring Road Utara, Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283', 'Active', '2022-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(4) NOT NULL,
  `id_kat_produk` int(4) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `harga` int(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(400) NOT NULL,
  `tgl_update` date NOT NULL,
  `view` int(25) NOT NULL,
  `id_sitemap` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kat_produk`, `judul`, `harga`, `gambar`, `deskripsi`, `slug`, `keyword`, `description`, `tgl_update`, `view`, `id_sitemap`) VALUES
(1, 2, 'Kamera Mirrorless Panasonic Lumix DMC GX9 12-32mm Bundling Battery DMW BLG 10E', 11169000, 'kamera-mirrorless-panasonic-lumix-dmc-gx9-12-32mm-bundling-battery-dmw-blg-10e.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Kamera:</strong></h3><p><br></p><ul><li>20.3MP sensor with no low pass filter</li><li>5-axis dual in-body-image-stabilisation (IBIS) that can be combined with 2-axis lens stabilisation</li><li>Tilt EVF with 2.76-million-dot resolution and 0.7x magnification (full frame equivalent)</li><li>3in LCD touchscreen that tilts up 80&deg; and down 45&deg;</li><li>4K videos up to 30fps in MP4</li><li>4K Photo Mode with Auto Marking and Sequence Composition functions</li><li>Wi-Fi and Bluetooth wireless connection</li></ul>', 'kamera-mirrorless-panasonic-lumix-dmc-gx9-12-32mm-bundling-battery-dmw-blg-10e', 'Di jual Kamera Mirrorless Panasonic Lumix DMC GX9 12-32mm Bundling Battery DMW BLG 10E', 'Jual Kamera Mirrorless Panasonic Lumix DMC GX9 12-32mm Bundling Battery DMW BLG 10E Murah dan Bergaransi di Jogja', '2023-01-05', 0, 8),
(2, 2, 'Kamera Mirrorless Sony Alpha 6400 Body Only', 16699000, 'kamera-mirrorless-sony-alpha-6400-body-only.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Kamera:</strong></h3><p><br></p><ul><li>24.2MP APS-C Exmor CMOS Sensor</li><li>Real-Time Eye AF &amp; Real-Time Tracking</li><li>XGA Tru-Finder 2.36m-Dot OLED EVF</li><li>3.0&Prime; 921.6k-Dot 180&deg; Tilting Touchscreen</li><li>Internal UHD 4K Video, S-Log3, &amp; HLG</li><li>S&amp;Q Motion pada Full HD dari 1-120 fps</li><li>Built-In Wi-Fi dengan NFC</li><li>425 Phase- &amp; Contrast-Detect AF Points</li><li>Hingga 11 fps Shooting &amp; ISO 102.400</li></ul>', 'kamera-mirrorless-sony-alpha-6400-body-only', 'Jual Kamera Kamera Mirrorless Sony Alpha 6400 Body Only di Yogyakarta', 'Jual Kamera Mirrorless Sony Alpha 6400 Body Only Murah dan Bergaransi di Jogja', '2023-01-05', 1, 9),
(3, 2, 'Kamera Mirrorless Sony Alpha 7c Body Only', 23999000, 'kamera-mirrorless-sony-alpha-7c-body-only.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Kamera:</strong></h3><p><br></p><ul><li>24MP BSI CMOS full-frame sensor</li><li>Bionz X processor (same as in the a7 III)</li><li>&lsquo;Real-time tracking&rsquo; AF system with human head, face, eye, and animal recognition</li><li>Oversampled 4K video at up to 30p, including 8-bit S-Log and HLG</li><li>Continuous bursts at up to 10 fps</li><li>Fully articulating 921k-dot touchscreen</li><li>2.36M-dot EVF with 0.59x mag.</li><li>Mic and headphone sockets</li><li>Dual-band, 2.4 and 5Ghz Wi-Fi</li><li>Large &lsquo;Z-type&rsquo; battery, rated to 740 shots per charge</li></ul>', 'kamera-mirrorless-sony-alpha-7c-body-only', 'Jual Kamera Mirrorless Sony Alpha 7c Body Only di Jogja', 'Jual Kamera Mirrorless Sony Alpha 7c Body Only Murah dan Bergaransi di Jogja', '2023-01-05', 0, 10),
(4, 2, 'Kamera Mirrorless Fujifilm X-S10 15-45mm Package Vlog Kit', 29950000, 'kamera-mirrorless-fujifilm-x-s10-15-45mm-package-vlog-kit.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Kamera Ini:</strong></h3><p><br></p><ul><li>26MP X-Trans BSI-CMOS sensor</li><li>5-axis in-body image stabilization</li><li>On-sensor phase detection</li><li>3&Prime;, 1.04M-dot fully articulating touchscreen</li><li>2.36M-dot OLED electronic viewfinder</li><li>30 fps burst shooting with crop (up to 20 fps without)</li><li>DCI and UHD 4K capture at up to 30p with F-Log support</li><li>External mic and headphone sockets</li><li>325 shots per charge using LCD</li><li>USB Power Delivery support</li><li>Single UHS-I card slot</li><li>Wi-Fi + Bluetooth</li></ul>', 'kamera-mirrorless-fujifilm-x-s10-15-45-mm-package-vlog-kit', 'Jual Kamera Mirrorless Fujifilm X-S10 15-45mm Package Vlog Kit', 'Jual Kamera Mirrorless Fujifilm X-S10 15-45mm Package Vlog Kit Murah dan Bergaransi di Jogja', '2023-01-05', 0, 11),
(5, 2, 'Kamera Sony DSC RX100 M5 Bundling VCT-SGR1', 13129000, 'kamera-sony-dsc-rx100-m5-bundling-vct-sgr1.jpeg', '<h3 id=\"isPasted\"><strong>Sony DSC RX100 M5</strong></h3><ul><li>20.1MP 1&Prime; Exmor RS BSI CMOS Sensor</li><li>BIONZ X Image Processor &amp; Front-End LSI</li><li>Internal UHD 4K Video &amp; S-Log2 Gamma</li><li>Zeiss Vario-Sonnar T* f/1.8-2.8 Lens</li><li>24-70mm (35mm Equivalent)</li><li>Fast Hybrid AF System with 315 Points</li><li>HFR Mode for Full HD Video up to 960 fps</li><li>0.39&Prime; 2.36m-Dot OLED Pop-Up EVF</li><li>3.0&Prime; 1.23m-Dot 180&deg; Tilting LCD</li><li>ISO 12800 and 24 fps Continuous Shooting</li></ul>', 'kamera-sony-dsc-rx100-m5-bundling-vct-sgr1', 'Jual Kamera Sony DSC RX100 M5 Bundling VCT-SGR1', 'Jual Kamera Sony DSC RX100 M5 Bundling VCT-SGR1 Murah dan Bergaransi di Jogja', '2023-01-05', 0, 12),
(6, 3, 'Lensa Kamera Canon EF 11-24mm F/4L USM', 53999000, 'lensa-kamera-canon-ef-11-24mm-f-4l-usm.jpeg', '<h3 id=\"isPasted\"><strong>Fitur Utama Canon EF 11-24mm f/4L USM:</strong></h3><p><br></p><ul><li>EF Mount L-Series Lens/Full-Frame Format</li><li>Constant f/4 Maximum Aperture</li><li>Super UD, UD, and 4 Aspherical Elements</li><li>SWC, Air Sphere, and Fluorine Coatings</li><li>Ring-Type USM Autofocus Motor</li><li>Internal Focus; Full-Time Manual Focus</li><li>Weather-Resistant Design</li><li>Rounded 9-Blade Diaphragm</li></ul>', 'lensa-kamera-canon-ef-11-24mm-f-4l-usm', 'Jual Lensa Lensa Kamera Canon EF 11-24mm F/4L USM', 'Jual Lensa Kamera Canon EF 11-24mm F/4L USM di Jogja, Bantul, Sleman, Kulon Progo dan Gunung Kidul murah dan bergaransi', '2023-01-05', 0, 13),
(7, 3, 'Lensa Kamera Canon RF 100-500mm f/4.5-7.1L IS USM', 52999000, 'lensa-kamera-canon-rf-100-500mm-f-4-5-7-1l-is-usm.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Lensa:</strong></h3><p><br></p><ul><li>RF-Mount Lens/Full-Frame Format</li><li>Aperture Range: f/4.5-7.1 to f/32-54</li><li>One Super UD Element, Six UD Elements</li><li>Dual Nano USM AF System</li></ul>', 'lensa-kamera-canon-rf-100-500mm-f-4-5-7-1l-is-usm', 'Jual Lensa Kamera Canon RF 100-500mm f/4.5-7.1L IS USM', 'Jual Lensa Kamera Canon RF 100-500mm f/4.5-7.1L IS USM di Jogja, Bantul, Sleman, Kulon Progo dan Gunung Kidul murah dan bergaransi', '2023-01-05', 0, 14),
(8, 3, 'Lensa Kamera Canon RF 70-200mm f2.8 L IS USM', 51999000, 'lensa-kamera-canon-rf-70-200mm-f2-8-l-is-usm.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Lensa:</strong></h3><p><br></p><ul><li>RF-Mount Lens/Full-Frame Format</li><li>Aperture Range: f/2.8 to f/22</li><li>Air Sphere and Fluorine Coatings</li><li>Dual Nano USM AF System</li><li>Optical Image Stabilizer</li><li>Customizable Control Ring</li></ul>', 'lensa-kamera-canon-rf-70-200mm-f2-8-l-is-usm', 'Jual Lensa Kamera Canon RF 70-200mm f2.8 L IS USM', 'Jual Lensa Kamera Canon RF 70-200mm f2.8 L IS USM Terbaik di Jogja', '2023-01-05', 0, 15),
(9, 3, 'Lensa Kamera Canon EF 200mm F/2.0 L IS USM', 85990000, 'lensa-kamera-canon-ef-200mm-f-2-0-l-is-usm.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Lensa:</strong></h3><p><br></p><ul><li>EF Mount L-Series Lens</li><li>Aperture Range: f/2-32</li><li>Fluorite and UD Lens Elements</li><li>Two Mode Optical Image Stabilization</li><li>Ultrasonic Focus Motor</li><li>Manual Focus Override</li><li>AF Stop Button and Focus Preset</li><li>Dustproof and Moisture Proof</li><li>Removable, Rotatable Tripod Collar</li><li>52mm Drop-in Gelatin Filter Holder</li></ul>', 'lensa-kamera-canon-ef-200mm-f-2-0-l-is-usm', 'Jual Lensa Kamera Canon EF 200mm F/2.0 L IS USM Terbaik', 'Jual Lensa Kamera Canon EF 200mm F/2.0 L IS USM Terbaik di Daerah Jogja Utara', '2023-01-05', 0, 16),
(10, 3, 'Lensa Kamera Canon EF 70-200mm f/2.8 L IS III USM', 39499000, 'lensa-kamera-canon-ef-70-200mm-f-2-8-l-is-iii-usm.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Lensa:</strong></h3><p><br></p><ul><li>EF-Mount Lens/Full-Frame Format</li><li>Aperture Range f/2.8 &ndash; f/32</li><li>Air Sphere Coating</li><li>Ring-Type Ultrasonic Motor AF System</li><li>Optical Image Stabilizer</li><li>Internal Focus, Focus Range Limiter</li><li>Weather-Sealed Design, Fluorine Coating</li><li>Detachable, Rotatable Tripod Collar</li><li>Rounded 8-Blade Diaphragm</li></ul>', 'lensa-kamera-canon-ef-70-200mm-f-2-8-l-is-iii-usm', 'Dijual Lensa Kamera Canon EF 70-200mm f/2.8 L IS III USM', 'Dijual Lensa Kamera Canon EF 70-200mm f/2.8 L IS III USM terbaik', '2023-01-05', 0, 17),
(11, 3, 'Lensa Kamera Canon EF 600mm f4L IS III USM', 252999000, 'lensa-kamera-canon-ef-600mm-f4l-is-iii-usm.jpeg', '<h3 id=\"isPasted\"><strong>Spesifikasi Lensa:</strong></h3><p><br></p><ul><li>EF-Mount Lens/Full-Frame Format</li><li>Aperture Range: f/4 to f/32</li><li>Super UD, Fluorite &amp; Aspherical Elements</li><li>Super Spectra and Air Sphere Coatings</li><li>Ring-Type Ultrasonic Motor AF System</li><li>Customizable Electronic Focusing Ring</li><li>Optical Image Stabilizer</li><li>Weather-Sealed Design, Fluorine Coating</li><li>Detachable, Rotatable Tripod Collar</li><li>Rounded 9-Blade Diaphragm</li></ul>', 'lensa-kamera-canon-ef-600mm-f4l-is-iii-usm', 'Jual Lensa Kamera Canon EF 600mm f4L IS III USM', 'Jual Lensa Kamera Canon EF 600mm f4L IS III USM Terbaik di Jogja OPE Elektronik', '2023-01-05', 3, 18),
(12, 1, 'Asus vivobook x441n 14″ inch LED', 2400000, 'asus-vivobook-x441n-14-inch-led.jpeg', '<h3 id=\"isPasted\"><strong>Deskripsi</strong></h3><p><br></p><ul><li>Asus vivobook x441n Type baru Harga pelajar cocok untuk kerja kuliah online</li><li>14&Prime; inch LED</li><li>prosesor Intel 2core n3350</li><li>Windows10</li><li>ram 4gb</li><li>Hd 500gb</li><li>Dvdrw</li><li>Audio Sonic master</li><li>Baterai awet 3 jam</li><li>Fisik mulus terawat</li><li>Lengkap laptop dan carger ori</li></ul>', 'asus-vivobook-x441n-14-inch-led', ' Deskripsi     Asus vivobook x441n Type baru Harga pelajar cocok untuk kerja kuliah online  14″ inch LED  prosesor Intel 2core n3350  Windows10  ram 4gb  Hd 500gb  Dvdrw  Audio Sonic master  Baterai awet 3 jam  Fisik mulus terawat  Lengkap laptop da', ' Deskripsi     Asus vivobook x441n Type baru Harga pelajar cocok untuk kerja kuliah online  14″ inch LED  prosesor Intel 2core n3350  Windows10  ram 4gb  Hd 500gb  Dvdrw  Audio Sonic master  Baterai awet 3 jam  Fisik mulus terawat  Lengkap laptop dan carger ori ', '2023-01-05', 0, 19),
(13, 1, 'Acer aspire E5-553G', 4800000, 'acer-aspire-e5-553g.jpeg', '<h3 id=\"isPasted\"><strong>Deskripsi</strong></h3><ul><li>For sale _ Acer aspire E5-553G || editing , grafis design , Game Lancar Pes 2017 Dota dll</li><li>15&Prime; inch LED Hd</li><li>AMD Quadcore A12 &ndash; 9700P turbo core</li><li>VGA AMD Radeon R8 2gb dedicated vram</li><li>W10 original</li><li>Ram 8gb ddr4</li><li>Hd 1 tb</li><li>USB Type C</li><li>Baterai awet standart 2 jam</li><li>Performa kenceng</li><li>Dvdrw</li></ul>', 'acer-aspire-e5-553g', '  Deskripsi    For sale _ Acer aspire E5-553G || editing , grafis design , Game Lancar Pes 2017 Dota dll  15&Prime; inch LED Hd  AMD Quadcore A12 &ndash; 9700P turbo core  VGA AMD Radeon R8 2gb dedicated vram  W10 original  Ram 8gb ddr4  Hd 1 tb  USB Type', '  Deskripsi    For sale _ Acer aspire E5-553G || editing , grafis design , Game Lancar Pes 2017 Dota dll  15&Prime; inch LED Hd  AMD Quadcore A12 &ndash; 9700P turbo core  VGA AMD Radeon R8 2gb dedicated vram  W10 original  Ram 8gb ddr4  Hd 1 tb  USB Type C  Baterai awet standart 2 jam  Performa kenceng  Dvdrw  ', '2023-01-05', 0, 20),
(14, 1, 'Acer aspire3 431', 2600000, 'acer-aspire3-431.jpeg', '<h3 id=\"isPasted\"><strong>Laptop 2nd berkualitas masih segel blm pernah bongkar Normal tinggal pakai</strong></h3><ul><li>SERI : Acer aspire3 431</li><li>Generasi baru , siap Lembur tugas2 grafis</li><li>14&Prime; inch LED Hd</li><li>prosesor Intel cpu n4000</li><li>W10</li><li>Ram 4gb ddr4</li><li>Hd 500gb</li><li>Fasted memory ddr4</li><li>Fasted wireles</li><li>Dvdrw</li><li>Baterai awet 3 jam</li><li>Kondisi :</li><li>Normal lancar jaya</li><li>Aplikasi lengkap tinggal pakai</li><li>Fisik terawat</li><li>Laptop + cas ori + tas</li><li>Hrg 2.600 jete ,- Free mouse New</li><li>Garansi personal test 1 bulan</li></ul>', 'acer-aspire3-431', '  Laptop 2nd berkualitas masih segel blm pernah bongkar Normal tinggal pakai    SERI : Acer aspire3 431  Generasi baru , siap Lembur tugas2 grafis  14&Prime; inch LED Hd  prosesor Intel cpu n4000  W10  Ram 4gb ddr4  Hd 500gb  Fasted memory ddr4  Fasted wi', '  Laptop 2nd berkualitas masih segel blm pernah bongkar Normal tinggal pakai    SERI : Acer aspire3 431  Generasi baru , siap Lembur tugas2 grafis  14&Prime; inch LED Hd  prosesor Intel cpu n4000  W10  Ram 4gb ddr4  Hd 500gb  Fasted memory ddr4  Fasted wireles  Dvdrw  Baterai awet 3 jam  Kondisi :  Normal lancar jaya  Aplikasi lengkap tinggal pakai  Fisik terawat  Laptop + cas ori + tas  Hrg 2.600', '2023-01-05', 0, 21),
(15, 1, 'Asus a451l', 3850000, 'asus-a451l.jpeg', '<h3 id=\"isPasted\"><strong>For Sale &gt; Asus a451lCocok utk kerja kuliah online / Kerja Grafis editing Game</strong></h3><p><br></p><ul><li>14&Prime; inch LED Hd</li><li>Prosesor Intel i5-4200 haswell</li><li>Nvidia GeForce 840mx 2gb</li><li>Windows10</li><li>Ram 4gb</li><li>Hd.1tb</li><li>Body kokoh aluminum.</li><li>Dvdrw</li><li>Baterai awet 3 jam</li><li>Fisik terawat</li><li>Kelengkapan Laptop carger ori</li><li>All sdh tested aplikasi lengkap tinggal pakai</li></ul>', 'asus-a451l', '  For Sale &gt; Asus a451lCocok utk kerja kuliah online / Kerja Grafis editing Game       14&Prime; inch LED Hd  Prosesor Intel i5-4200 haswell  Nvidia GeForce 840mx 2gb  Windows10  Ram 4gb  Hd.1tb  Body kokoh aluminum.  Dvdrw  Baterai awet 3 jam  Fisik t', '  For Sale &gt; Asus a451lCocok utk kerja kuliah online / Kerja Grafis editing Game       14&Prime; inch LED Hd  Prosesor Intel i5-4200 haswell  Nvidia GeForce 840mx 2gb  Windows10  Ram 4gb  Hd.1tb  Body kokoh aluminum.  Dvdrw  Baterai awet 3 jam  Fisik terawat  Kelengkapan Laptop carger ori  All sdh tested aplikasi lengkap tinggal pakai  ', '2023-01-05', 0, 22),
(16, 1, 'Asus vivobook x441b', 3100000, 'asus-vivobook-x441b.jpeg', '<h3 id=\"isPasted\"><strong>Asus vivobook x441b Gold Spek grafis medium Harga pelajar cocok untuk kerja kuliah online</strong></h3><ul><li>14&Prime; inch LED</li><li>prosesor AMD a9-9425 7th gen</li><li>AMD Radeon r5</li><li>Windows10</li><li>ram 4gb</li><li>Hd 1 TB</li><li>Dvdrw</li><li>Audio Sonic master</li><li>Baterai awet 3 jam</li><li>Fisik mulus terawat</li><li>Lengkap laptop dan carger ori</li></ul>', 'asus-vivobook-x441b', '  Asus vivobook x441b Gold Spek grafis medium Harga pelajar cocok untuk kerja kuliah online    14&Prime; inch LED  prosesor AMD a9-9425 7th gen  AMD Radeon r5  Windows10  ram 4gb  Hd 1 TB  Dvdrw  Audio Sonic master  Baterai awet 3 jam  Fisik mulus terawat', '  Asus vivobook x441b Gold Spek grafis medium Harga pelajar cocok untuk kerja kuliah online    14&Prime; inch LED  prosesor AMD a9-9425 7th gen  AMD Radeon r5  Windows10  ram 4gb  Hd 1 TB  Dvdrw  Audio Sonic master  Baterai awet 3 jam  Fisik mulus terawat  Lengkap laptop dan carger ori  ', '2023-01-05', 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `sitemap`
--

CREATE TABLE `sitemap` (
  `id_sitemap` int(10) NOT NULL,
  `id_sub_sitemap` int(4) NOT NULL,
  `loc` varchar(255) NOT NULL,
  `lastmod` date NOT NULL,
  `priority` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitemap`
--

INSERT INTO `sitemap` (`id_sitemap`, `id_sub_sitemap`, `loc`, `lastmod`, `priority`) VALUES
(0, 1, 'http://localhost/project/P000062', '2023-01-05', '1.00'),
(1, 1, 'http://localhost/project/P000062/beranda', '2023-01-05', '1.00'),
(2, 1, 'http://localhost/project/P000062/produk', '2023-01-05', '1.00'),
(3, 1, 'http://localhost/project/P000062/kontak-kami', '2023-01-05', '1.00'),
(4, 3, 'http://localhost/project/P000055/berita', '2022-12-27', '1.00'),
(5, 2, 'http://localhost/project/P000062/produk/laptop', '2023-01-05', '0.80'),
(6, 2, 'http://localhost/project/P000062/produk/kamera', '2023-01-05', '0.80'),
(7, 2, 'http://localhost/project/P000062/produk/lensa', '2023-01-05', '0.80'),
(8, 3, 'http://localhost/project/P000062/produk/kamera/kamera-mirrorless-panasonic-lumix-dmc-gx9-12-32mm-bundling-battery-dmw-blg-10e', '2023-01-05', '0.80'),
(9, 3, 'http://localhost/project/P000062/produk/kamera/kamera-mirrorless-sony-alpha-6400-body-only', '2023-01-05', '0.80'),
(10, 3, 'http://localhost/project/P000062/produk/kamera/kamera-mirrorless-sony-alpha-7c-body-only', '2023-01-05', '0.80'),
(11, 3, 'http://localhost/project/P000062/produk/kamera/kamera-mirrorless-fujifilm-x-s10-15-45-mm-package-vlog-kit', '2023-01-05', '0.80'),
(12, 3, 'http://localhost/project/P000062/produk/kamera/kamera-sony-dsc-rx100-m5-bundling-vct-sgr1', '2023-01-05', '0.80'),
(13, 3, 'http://localhost/project/P000062/produk/lensa/lensa-kamera-canon-ef-11-24mm-f-4l-usm', '2023-01-05', '0.80'),
(14, 3, 'http://localhost/project/P000062/produk/lensa/lensa-kamera-canon-rf-100-500mm-f-4-5-7-1l-is-usm', '2023-01-05', '0.80'),
(15, 3, 'http://localhost/project/P000062/produk/lensa/lensa-kamera-canon-rf-70-200mm-f2-8-l-is-usm', '2023-01-05', '0.80'),
(16, 3, 'http://localhost/project/P000062/produk/lensa/lensa-kamera-canon-ef-200mm-f-2-0-l-is-usm', '2023-01-05', '0.80'),
(17, 3, 'http://localhost/project/P000062/produk/lensa/lensa-kamera-canon-ef-70-200mm-f-2-8-l-is-iii-usm', '2023-01-05', '0.80'),
(18, 3, 'http://localhost/project/P000062/produk/lensa/lensa-kamera-canon-ef-600mm-f4l-is-iii-usm', '2023-01-05', '0.80'),
(19, 3, 'http://localhost/project/P000062/produk/laptop/asus-vivobook-x441n-14-inch-led', '2023-01-05', '0.80'),
(20, 3, 'http://localhost/project/P000062/produk/laptop/acer-aspire-e5-553g', '2023-01-05', '0.80'),
(21, 3, 'http://localhost/project/P000062/produk/laptop/acer-aspire3-431', '2023-01-05', '0.80'),
(22, 3, 'http://localhost/project/P000062/produk/laptop/asus-a451l', '2023-01-05', '0.80'),
(23, 3, 'http://localhost/project/P000062/produk/laptop/asus-vivobook-x441b', '2023-01-05', '0.80');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sitemap`
--

CREATE TABLE `sub_sitemap` (
  `id_sub_sitemap` int(4) NOT NULL,
  `halaman` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_sitemap`
--

INSERT INTO `sub_sitemap` (`id_sub_sitemap`, `halaman`, `slug`) VALUES
(1, 'Pages', 'pages'),
(2, 'Kategori Produk', 'produk'),
(3, 'Produk', 'produk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_data_admin`);

--
-- Indexes for table `kat_produk`
--
ALTER TABLE `kat_produk`
  ADD PRIMARY KEY (`id_kat_produk`),
  ADD KEY `id_sitemap` (`id_sitemap`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`),
  ADD KEY `id_sitemap` (`id_sitemap`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_sitemap` (`id_sitemap`),
  ADD KEY `id_kat_berita` (`id_kat_produk`);

--
-- Indexes for table `sitemap`
--
ALTER TABLE `sitemap`
  ADD PRIMARY KEY (`id_sitemap`),
  ADD KEY `id_sub_sitemap` (`id_sub_sitemap`);

--
-- Indexes for table `sub_sitemap`
--
ALTER TABLE `sub_sitemap`
  ADD PRIMARY KEY (`id_sub_sitemap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_data_admin` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kat_produk`
--
ALTER TABLE `kat_produk`
  MODIFY `id_kat_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sitemap`
--
ALTER TABLE `sitemap`
  MODIFY `id_sitemap` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sub_sitemap`
--
ALTER TABLE `sub_sitemap`
  MODIFY `id_sub_sitemap` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kat_produk`
--
ALTER TABLE `kat_produk`
  ADD CONSTRAINT `kat_produk_ibfk_1` FOREIGN KEY (`id_sitemap`) REFERENCES `sitemap` (`id_sitemap`);

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`id_sitemap`) REFERENCES `sitemap` (`id_sitemap`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kat_produk`) REFERENCES `kat_produk` (`id_kat_produk`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_sitemap`) REFERENCES `sitemap` (`id_sitemap`);

--
-- Constraints for table `sitemap`
--
ALTER TABLE `sitemap`
  ADD CONSTRAINT `sitemap_ibfk_1` FOREIGN KEY (`id_sub_sitemap`) REFERENCES `sub_sitemap` (`id_sub_sitemap`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
