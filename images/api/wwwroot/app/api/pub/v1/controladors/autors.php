<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/autorsRepositori.php');

require_once('app/include/controlador.php');

class autors extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setTeCache(true);
        $this->repositori = new autorsRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "")  {
        $vId = $aParamsUrl['autors'] ?? '';
        $aCerca = [
            "nom" => $aParams['nom'] ?? ''
        ];
        $aCercaVideos = [
            "autor" => $vId,
        ];
        if ($vId !== '') {
            $aObjs = $this->getById($vId,$aCercaVideos);
        } else {
            $aObjs = $this->getAll($aCerca);
        }
        return
            [
                "estado" => 200,
                "dades" => $aObjs,
                "total" => sizeof($aObjs)
            ];
    }

    private function getById($vId,$aCercaVideos) {
        $aRetorn = $this->getRepositori()->getAutor($vId)[0] ?? [];

        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Autor no trobat",404);
        }
        $aRetorn['videos'] = $this->getRepositori()->getVideos($aCercaVideos) ?? [];
        return $aRetorn;
    }

    private function getAll($aCerca) {

        $aRetorn = $this->getRepositori()->getAutors($aCerca);

        return $aRetorn;
    }
}