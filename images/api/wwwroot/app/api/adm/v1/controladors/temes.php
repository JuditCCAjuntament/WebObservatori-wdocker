<?php
namespace ADM_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/temesRepositori.php');

require_once('app/include/controlador.php');

class temes extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setValidat(true);
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
        $aRetorn = $this->getRepositori()->getTema($vId)[0] ?? [];
        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Tema no trobat",404);
        }
        return $aRetorn;
    }

    private function getAll() {
        $aRetorn = $this->getRepositori()->getAllTemes() ?? [];
        return $aRetorn;
    }

    public function post($aParamsUrl,$oObj,$aParansToken) //afegir
    {
        $aObj = (array) $oObj;
        /**
        {
        "obj": {
            "nom": "Grup - el que sigui",
            "permisos" : [
                {
                    "id": 0,
                    "id_grup": 0,
                    "id_permis": 18,
                    "valor": 1
                },
                {
                    "id": 0,
                    "id_grup": 0,
                    "id_permis": 14,
                    "valor": 2
                }]
            }
        }
         */


        $aIdResult = $this->getRepositori()->addTema($aObj);
        if ($aIdResult > 0) {
            $id = $aIdResult;
            return $this->get(["temes" => $id]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function put($aParamsUrl,$oObj,$aParansToken) //modificar
    {
        $aObj = (array) $oObj;

        $vId = $aParamsUrl['temes'];

        if (isset($aObj['id']) && $aObj['id'] != $vId) {
            throw new \Exception("Ids no coincideixen",500);
        }

        $aUsuari = $this->getRepositori()->getTema($vId)[0] ?? [];

        if (sizeof($aUsuari) == 0) {
            throw new \Exception("Tema no trobat",404);
        }

        $aResult = $this->getRepositori()->updateTema($aObj);

        if ($aResult > 0) {
            return $this->get(["temes" => $vId]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function delete($aParamsUrl,$aParansToken) //esborrar
    {
        $vId = $aParamsUrl['temes'];

        $aUsuari = $this->getRepositori()->getTema($vId)[0] ?? [];

        if (sizeof($aUsuari) == 0) {
            throw new \Exception("Tema no trobat",404);
        }

        try {
            $aResult = $this->getRepositori()->delTema($vId);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            if (strpos($error,' 1451 ')) {
                $msgError = 'Aquest tema no es pot esborrar perquè l\'està fent servir algun vídeo';
            } else {
                $msgError = $error;
            }
            throw new \Exception($msgError,400);
        }


        return
            [
                "estado" => 200,
                "dades" => $aResult,
                "total" => 1
            ];
    }
}