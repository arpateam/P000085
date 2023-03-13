<?php

	header("Content-type: text/xml");
	echo'<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
	echo'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

    require "appweb/Config/Db.php";

    $key 	= "1";
	$stmt 	= $pdo->prepare("
				SELECT *
				FROM sitemap
				WHERE id_sub_sitemap = ?
				ORDER BY priority DESC");

    $stmt->bindValue(1, $key);
    $stmt->execute();
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

?>
    <url>
    	<loc><?= $result['loc']; ?></loc>
    	<lastmod><?= $result['lastmod']; ?></lastmod>
    	<priority><?= $result['priority']; ?></priority>
    </url>

<?php
	}
?> 

</urlset>