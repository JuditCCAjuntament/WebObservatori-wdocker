<?php
require_once('gestors/debug.class.php');
require_once ("WebApi/ciutatAgora/ciutatAgoraApi.class.php");

class ciutatAgora {
    private $oApi;
    public $template;

    function __construct()
    {
        // incialitzem objectes
        $this->oApi = new ciutatAgoraApi();
    }

    public function get($oPortal,$aParams) {

        debug::getInstancia()->dump(["portal" => $oPortal,"params" => $aParams] , "ciutat agora - params");

        switch ($aParams[0]) {
            case "temes":

                $vIdVideo = $aParams[1] ?? "";
                if ($vIdVideo != "") {
                    $oRetorn = $this->oApi->getVideo($vIdVideo);
                    $oRetorn['cerca'] = [
                        "projecte"  => $oRetorn['id_projecte'],
                    ];
                    $oRetorn['relacionats'] = $this->oApi->getVideos($oRetorn['cerca']);
                    $this->template = "video.tpl";
                } else {
                    $vMax = 10;
                    $vPag = $_GET['pag'] ?? 0;
                    $vInici = $vPag * $vMax;

                    $this->template = "videos.tpl";
                    $oRetorn['temes'] = $this->oApi->getTemes();
                    $oRetorn['projectes'] = $this->oApi->getProjectes();
                    $oRetorn['autors'] = $this->oApi->getAutors([]);

                    $oRetorn['cerca'] = [
                        "projecte" => $_GET['projecte'] ?? '',
                        "autor" => $_GET['autor'] ?? '',
                        "tema"  => $_GET['tema'] ?? '',
                        "text" => $_GET['txCerca'] ?? ''
                    ];
                    $oRetorn['videos'] = $this->oApi->getVideos($oRetorn['cerca']);

                    $oRetorn['totalPag'] = 1;
                    $vTotalItems = sizeof($oRetorn['videos']) ?? 0;

                    if ($vTotalItems > $vMax) {
                        $oRetorn['videos']=array_slice($oRetorn['videos'], $vInici, $vMax);
                        $oRetorn['totalPag']=intval(ceil($vTotalItems/$vMax));
                        $oRetorn['pagAct']=$vPag;
                    }

                    // per si hi ha cerces no perdre els parametres
                    $oRetorn['paramsAct'] = "";
                    foreach($_GET as $kItem => $vItem) {
                        if ($kItem != 'pag' && $kItem != 'PATH_INFO') {
                            $oRetorn['paramsAct'] .= "&".$kItem."=".$vItem;
                        }
                    }
                }

                break;
            case "espai_educatiu":

                $vIdVideo = $aParams[1] ?? "";

                if ($vIdVideo != "") {
                    $oRetorn = $this->oApi->getVideo($vIdVideo);
                    $this->template = "video.tpl";
                } else {
                    $oRetorn['pagAct'] = 0;
                    $vMax = 10;
                    $vPag = $_GET['pag'] ?? 0;
                    $vInici = $vPag * $vMax;

                    $this->template = "espai_educatiu.tpl";

                    $oRetorn['cerca'] = [
                        "espai_educatiu" => '1'
                    ];
                    $oRetorn['videos'] = $this->oApi->getVideos($oRetorn['cerca']);

                    $oRetorn['totalPag'] = 1;
                    $vTotalItems = sizeof($oRetorn['videos']) ?? 0;

                    if ($vTotalItems > $vMax) {
                        $oRetorn['videos']=array_slice($oRetorn['videos'], $vInici, $vMax);
                        $oRetorn['totalPag']=intval(ceil($vTotalItems/$vMax));
                        $oRetorn['pagAct']=$vPag;
                    }

                    // per si hi ha cerces no perdre els parametres
                    $oRetorn['paramsAct'] = "";
                    foreach($_GET as $kItem => $vItem) {
                        if ($kItem != 'pag' && $kItem != 'PATH_INFO') {
                            $oRetorn['paramsAct'] .= "&".$kItem."=".$vItem;
                        }
                    }
                }

                break;
            case "projectes":

                $vProjecte = $aParams[1] ?? "";
                if ($vProjecte) {
                    $vMax = 6;
                    $vPag = $_GET['pag'] ?? 0;
                    $vInici = $vPag * $vMax;

                    $oRetorn = $this->oApi->getProjecta($vProjecte);
                    $oRetorn['totalPag'] = 1;
                    $vTotalItems = sizeof($oRetorn['videos']) ?? 0;

                    if ($vTotalItems > $vMax) {
                        $oRetorn['videos']=array_slice($oRetorn['videos'], $vInici, $vMax);
                        $oRetorn['totalPag']=intval(ceil($vTotalItems/$vMax));
                    }
                    $oRetorn['pagAct']=$vPag;

                    debug::getInstancia()->dump(["totalVideos" => $vTotalItems,"retorn" => $oRetorn],'gestor - ciutat agora');
                    $this->template = "projecte.tpl";
                } else {
                    $vMax = 8;
                    $vPag = $_GET['pag'] ?? 0;
                    $vInici = $vPag * $vMax;

                    $oRetorn['projectes'] = $this->oApi->getProjectes();

                    $oRetorn['totalPag'] = 1;
                    $vTotalItems = sizeof($oRetorn['projectes']) ?? 0;

                    if ($vTotalItems > $vMax) {
                        $oRetorn['projectes']=array_slice($oRetorn['projectes'], $vInici, $vMax);
                        $oRetorn['totalPag']=intval(ceil($vTotalItems/$vMax));
                    }
                    $oRetorn['pagAct']=$vPag;

                    // per si hi ha cerces no perdre els parametres
                    $oRetorn['paramsAct'] = "";
                    foreach($_GET as $kItem => $vItem) {
                        if ($kItem != 'pag' && $kItem != 'PATH_INFO') {
                            $oRetorn['paramsAct'] .= "&".$kItem."=".$vItem;
                        }
                    }

                    debug::getInstancia()->dump(["totalAutors" => $vTotalItems,"retorn" => $oRetorn],'gestor - ciutat agora');
                    $this->template = "projectes.tpl";
                }
                break;
            case "autors":

                $vAutor = $aParams[1] ?? "";
                if ($vAutor) {
                    $vMax = 6;
                    $vPag = $_GET['pag'] ?? 0;
                    $vInici = $vPag * $vMax;


                    $oRetorn = $this->oApi->getAutor($vAutor);
                    $oRetorn['totalPag'] = 1;
                    $vTotalItems = sizeof($oRetorn['videos']) ?? 0;


                    if ($vTotalItems > $vMax) {
                        $oRetorn['videos']=array_slice($oRetorn['videos'], $vInici, $vMax);
                        $oRetorn['totalPag']=intval(ceil($vTotalItems/$vMax));
                    }
                    $oRetorn['pagAct']=$vPag;

                    debug::getInstancia()->dump(["totalVideos" => $vTotalItems,"retorn" => $oRetorn],'gestor - ciutat agora');
                    $this->template = "autor.tpl";
                } else {
                    $vMax = 6;
                    $vPag = $_GET['pag'] ?? 0;
                    $vInici = $vPag * $vMax;

                    $oRetorn['cerca'] = [
                        "text" => $_GET['txCerca'] ?? ''
                    ];
                    $oRetorn['autors'] = $this->oApi->getAutors($oRetorn['cerca']);

                    $oRetorn['totalPag'] = 1;
                    $vTotalItems = sizeof($oRetorn['autors']) ?? 0;

                    if ($vTotalItems > $vMax) {
                        $oRetorn['autors']=array_slice($oRetorn['autors'], $vInici, $vMax);
                        $oRetorn['totalPag']=intval(ceil($vTotalItems/$vMax));
                    }
                    $oRetorn['pagAct']=$vPag;

                    // per si hi ha cerces no perdre els parametres
                    $oRetorn['paramsAct'] = "";
                    foreach($_GET as $kItem => $vItem) {
                        if ($kItem != 'pag' && $kItem != 'PATH_INFO') {
                            $oRetorn['paramsAct'] .= "&".$kItem."=".$vItem;
                        }
                    }
                    debug::getInstancia()->dump(["totalAutors" => $vTotalItems,"retorn" => $oRetorn],'gestor - ciutat agora');

                    $this->template = "autors.tpl";
                }
                break;
        }

        debug::getInstancia()->dump(["apartat" => $aParams[0] ?? 'home',"param" => $aParams[1] ?? '' ,"dades" => $oRetorn] , "ciutat agora  - resposta api");
        return $oRetorn;
    }
    public function getHome($oPortal,$aParams) {
        debug::getInstancia()->dump(["params" => $aParams, "portal" => $oPortal] , "ciutat agora - home - params");

        $oRetorn = $this->oApi->getHome();
        debug::getInstancia()->dump($oRetorn, "ciutat agora - home - api");
        return $oRetorn;
    }

}