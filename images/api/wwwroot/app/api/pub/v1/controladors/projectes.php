<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/projectesRepositori.php');

require_once('app/include/controlador.php');

class projectes extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setTeCache(true);
        $this->repositori = new projectesRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "")  {
        $vId = $aParamsUrl['projectes'] ?? '';

        $aCercaVideos = [
            "projecte" => $vId,
        ];
        if ($vId !== '') {
            $aObjs = $this->getById($vId,$aCercaVideos);
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

    private function getById($vId,$aCercaVideos) {
        $aRetorn = $this->getRepositori()->getProjecta($vId)[0] ?? [];
        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Projecte no trobat",404);
        }
        $aRetorn['videos'] = $this->getRepositori()->getVideos($aCercaVideos) ?? [];
        return $aRetorn;
    }

    private function getAll() {

        $aRetorn = $this->getRepositori()->getProjectes();

        return $aRetorn;
    }
}