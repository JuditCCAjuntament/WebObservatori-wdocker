<?php

require_once('app/vistes/VistaJson.php');

$vAllPathInfo = explode("/",$_GET['PATH_INFO'] ?? '');
$vContext = '';

// poder afegir prefixes a la url al publicar-ho, aquesrta funcio calcula el primer index important
foreach($vAllPathInfo  as $vIndex => $vPath) {
    if ($vPath === 'pub' || $vPath === 'adm') {
        $vContext = $vPath;
        break;
    }
    unset($vAllPathInfo[$vIndex]);
}
unset($vAllPathInfo[$vIndex]);
$vVersion = $vAllPathInfo[$vIndex + 1] ?? '';
unset($vAllPathInfo[$vIndex + 1]);
$vPathInfo = implode("/",$vAllPathInfo);

$vPath= 'app/api/'.$vContext.'/'.$vVersion.'/init.php';
//echo $vPath;
if (file_exists('/var/www/html/'.$vPath)) {
    $vNameClass = $vContext."_".$vVersion."\init";

    require_once($vPath);
    $oApi = new $vNameClass($vPathInfo);
    echo $aResult = $oApi->callApi();
} else {
    $oVista =  new VistaJson();
    $oCuerpo = [
        "estado" => 400,
        "mensaje" => "Url mal formatada"
    ];
    echo $oVista->imprimir($oCuerpo);
}
die();