<?php
	class pagingGaleri{
		function cariPosisi($batas){
			if(empty($_GET['page'])){
				$posisi=0;
				$_GET['page']=1;
			}else{
				$posisi = ($_GET['page']-1) * $batas;
			}
			return $posisi;
		}

		// Fungsi untuk menghitung total page
		function jmlhalaman($jmldata, $batas){
			$jmlhalaman = ceil($jmldata/$batas);
			return $jmlhalaman;
		}

		// Fungsi untuk link halaman 1,2,3 (untuk admin)
		function navHalaman($halaman_aktif, $jmlhalaman){
			$link_halaman = "";

			// Link ke halaman pertama (first) dan sebelumnya (prev)
			if($halaman_aktif == 1){
				
				$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>";
			}elseif($halaman_aktif > 1){
				$prev = $halaman_aktif-1;
				$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
								<a href='galeri/page/1/'><i class='fas fa-angle-double-left'></i></a>
								<a href='galeri/page/$prev/' title='Previous'><i class='fas fa-chevron-left' aria-hidden='true'></i></a> ";
			}else{ 
				$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
								<i class='fas fa-chevron-left' aria-hidden='true'></i> First < Prev | ";
			}

			// Link halaman 1,2,3, ...
			$angka = ($halaman_aktif > 3 ? " ... " : " "); 
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
					continue;
					$angka .= "<a href=galeri/page/$i/>$i</a> ";
				}
				  $angka .= " <strong class='current-pag'><b>$halaman_aktif</b></strong>";
				  
				for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				  break;
				  $angka .= "<a href=galeri/page/$i/>$i</a> ";
				}
				  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=galeri/page/$jmlhalaman/>$jmlhalaman</a> " : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (Last) 
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <a href='galeri/page/$next/' title='Next'><i class='fas fa-angle-right'></i></a>
								 <a href='galeri/page/$jmlhalaman/'><i class='fas fa-angle-double-right'></i></a>
								 ";
			}else{
				$link_halaman .= "";
			}
			return $link_halaman;
		}
	}
	
	class pagingKabar{
		function cariPosisi($batas){
			if(empty($_GET['page'])){
				$posisi=0;
				$_GET['page']=1;
			}else{
				$posisi = ($_GET['page']-1) * $batas;
			}
			return $posisi;
		}

		// Fungsi untuk menghitung total page
		function jmlhalaman($jmldata, $batas){
			$jmlhalaman = ceil($jmldata/$batas);
			return $jmlhalaman;
		}

		// Fungsi untuk link halaman 1,2,3 (untuk admin)
		function navHalaman($halaman_aktif, $jmlhalaman){
			$link_halaman = "";

			// Link ke halaman pertama (first) dan sebelumnya (prev)
			if($halaman_aktif == 1){
				
				$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>";
			}elseif($halaman_aktif > 1){
				$prev = $halaman_aktif-1;
				$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
								<a href='kabar/page/1/'><i class='fas fa-angle-double-left'></i></a>
								<a href='kabar/page/$prev/' title='Previous'><i class='fas fa-chevron-left' aria-hidden='true'></i></a> ";
			}else{ 
				$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
								<i class='fas fa-chevron-left' aria-hidden='true'></i> First < Prev | ";
			}

			// Link halaman 1,2,3, ...
			$angka = ($halaman_aktif > 3 ? " ... " : " "); 
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
					continue;
					$angka .= "<a href=kabar/page/$i/>$i</a> ";
				}
				  $angka .= " <strong class='current-pag'><b>$halaman_aktif</b></strong>";
				  
				for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				  break;
				  $angka .= "<a href=kabar/page/$i/>$i</a> ";
				}
				  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=kabar/page/$jmlhalaman/>$jmlhalaman</a> " : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (Last) 
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <a href='kabar/page/$next/' title='Next'><i class='fas fa-angle-right'></i></a>
								 <a href='kabar/page/$jmlhalaman/'><i class='fas fa-angle-double-right'></i></a>
								 ";
			}else{
				$link_halaman .= "";
			}
			return $link_halaman;
		}
	}
?>