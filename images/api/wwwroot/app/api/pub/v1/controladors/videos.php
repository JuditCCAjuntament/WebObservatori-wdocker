<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/videosRepositori.php');

require_once('app/include/controlador.php');

class videos extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setTeCache(true);
        $this->repositori = new videosRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "")  {
        $vId = $aParamsUrl['videos'] ?? '';

        $aCerca = [
            "text" => $aParams['text'] ?? '',
            "tema" => $aParams['tema'] ?? '',
            "autor" => $aParams['autor'] ?? '',
            "projecte" => $aParams['projecte'] ?? '',
            "espai_educatiu" => $aParams['espai_educatiu'] ?? '',
            ];
        if ($vId !== '') {
            $aObjs = $this->getById($vId);
        } else {
            $aObjs = $this->getByCerca($aCerca);
        }
        return
            [
                "estado" => 200,
                "dades" => $aObjs,
                "total" => sizeof($aObjs)
            ];
    }

    private function getById($vId) {
        $aRetorn = $this->getRepositori()->getVideo($vId)[0] ?? [];
        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Vídeo no trobat",404);
        }
        $aRetorn['documents'] = $this->getRepositori()->getDocuments($vId);
        return $aRetorn;
    }

    private function getByCerca($aCerca) {

        $aRetorn = $this->getRepositori()->getVideos($aCerca) ?? [];

        foreach($aRetorn as $vIndex => $aItem) {
            $aRetorn[$vIndex]['documents'] = $this->getRepositori()->getDocuments($aItem['id']) ?? [];
        }
        return $aRetorn;
    }

}