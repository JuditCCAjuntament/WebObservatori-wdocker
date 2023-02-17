<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/temesRepositori.php');

require_once('app/include/controlador.php');

class temes extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setTeCache(true);
        $this->repositori = new temesRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "")  {
        $vId = $aParamsUrl['temes'] ?? '';
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

        $aRetorn = $this->getRepositori()->getTemes();

        return $aRetorn;
    }
}