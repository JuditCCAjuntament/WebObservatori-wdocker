<?php
namespace ADM_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/projectesRepositori.php');

require_once('app/include/controlador.php');

class projectes extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setValidat(true);
        $this->repositori = new projectesRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "")  {
        $vId = $aParamsUrl['projectes'] ?? '';

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
        $aRetorn = $this->getRepositori()->getProjecte($vId)[0] ?? [];
        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Projecte no trobat",404);
        }
        return $aRetorn;
    }

    private function getAll() {
        $aRetorn = $this->getRepositori()->getAllProjectes() ?? [];
        return $aRetorn;
    }

    public function post($aParamsUrl,$oObj,$aParansToken) //afegir
    {
        $aObj = (array) $oObj;
        /**
        {
        "obj": {
            "nom": "App",
            "url": "http://prova/",
            "icona": "home",
            "permisos" : [
                {
                    "id": 0,
                    "permis": "Root",
                    "id_usuari": 0
                },
                {
                    "id": 0,
                    "permis": "Menus",
                    "id_usuari": 0
                }]
            }
        }
         */


        $aIdResult = $this->getRepositori()->addProjecte($aObj);
        if ($aIdResult > 0) {
            $id = $aIdResult;

            return $this->get(["projectes" => $id]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function put($aParamsUrl,$oObj,$aParansToken) //modificar
    {
        $aObj = (array) $oObj;

        $vId = $aParamsUrl['projectes'];

        if (isset($aObj['id']) && $aObj['id'] != $vId) {
            throw new \Exception("Ids no coincideixen",500);
        }

        $aProjecte = $this->getRepositori()->getProjecte($vId)[0] ?? [];

        if (sizeof($aProjecte) == 0) {
            throw new \Exception("Projecte no trobat",404);
        }

        $aResult = $this->getRepositori()->updateProjecte($aObj);

        if ($aResult > 0) {
            // si la imatge que hi havia no estava buida, la esborrem
            if (!empty($aProjecte['imatge']) && $aProjecte['imatge'] != $aObj['imatge']) {

                $this->getRepositori()->delMedia($aProjecte['imatge']);
            }
            return $this->get(["projectes" => $vId]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function delete($aParamsUrl,$aParansToken) //esborrar
    {
        $vId = $aParamsUrl['projectes'];

        $aProjecte = $this->getRepositori()->getProjecte($vId)[0] ?? [];

        if (sizeof($aProjecte) == 0) {
            throw new \Exception("Projecte no trobat",404);
        }



        try {
            $aResult = $this->getRepositori()->delProjecte($vId);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            if (strpos($error,' 1451 ')) {
                $msgError = 'Aquest projecte no es pot esborrar perquè l\'està fent servir algun vídeo';
            } else {
                $msgError = $error;
            }
            throw new \Exception($msgError,400);
        }

        if (!empty($aProjecte['imatge'])) {

            $this->getRepositori()->delMedia($aProjecte['imatge']);
        }

        return
            [
                "estado" => 200,
                "dades" => $aResult,
                "total" => 1
            ];
    }
}