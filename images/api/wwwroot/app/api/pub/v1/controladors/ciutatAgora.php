<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/ciutatAgoraRepositori.php');

require_once('app/include/controlador.php');

class ciutatAgora extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setTeCache(true);
        $this->repositori = new ciutatAgoraRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "")  {
        $vId = $aParamsUrl['ciutat_agora'] ?? '';

        if ($vId !== '') {
            $aObjs = $this->getById($vId);
        } else {
            $aObjs = $this->getAll();
        }
        return
            [
                "estado" => 200,
                "dades" => $aObjs,
                "total" => sizeof($aObjs)
            ];
    }

    private function getById($vId) {
        return [];
    }

    private function getAll() {

        $aRetorn['temes'] = $this->getRepositori()->getTemes();
        $aRetorn['projectes'] = $this->getRepositori()->getProjectes();
        $aRetorn['destacats'] = $this->getRepositori()->getVideosDestacats();
        $aRetorn['entrevistes'] = $this->getRepositori()->getVideosEntrevistes();
        $aRetorn['ultimes_act'] = $this->getRepositori()->getUltimsVideos();
        return $aRetorn;
    }
}