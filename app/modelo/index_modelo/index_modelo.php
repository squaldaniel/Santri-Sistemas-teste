<?php
$pathvisao = PATHVISAO . get_class(). "_visao/" . get_class() . "_index.html";
$pagina = compact($pathvisao);
$pagina = str_replace("[@pathpublic]", "public/", $pagina);
echo $pagina;
?>