<?php
namespace ADM_V1;
$vVersion = $vVersion ?? '';

require_once('app/api/'.$vVersion.'repositori/autorsRepositori.php');

require_once('app/include/controlador.php');

class autors extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setValidat(true);
        $this->repositori = new autorsRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "") {
        $vId = $aParamsUrl['autors'] ?? '';

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
        $aRetorn =  $this->getRepositori()->getAutor($vId)[0] ?? [];

        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Autor no trobat",404);
        }
        return $aRetorn;
    }

    private function getAll() {
        $aRetorn = $this->getRepositori()->getAllAutors();

        return $aRetorn;
    }

    public function post($aParamsUrl,$oObj,$aParansToken) //afegir
    {
        $aObj = (array) $oObj;
        /**
        {
            "obj": {
                "nom": "Prova",
                "usuari": "prova2022",
                "password": "aaaaaaaaa",
                "grups" : [
         *          {
                        "id": 69,
                        "id_grup": 1,
                        "nom": "Webs - root"
                    },
                    {
                        "id": 70,
                        "id_grup": 2,
                        "nom": "Regals i obsequis - root"
                    }]
            }
        }
         */

        $aIdResult = $this->getRepositori()->addAutor($aObj);
        if ($aIdResult > 0) {
            $id = $aIdResult;
            return $this->get(["autors" => $id]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function put($aParamsUrl,$oObj,$aParansToken) //modificar
    {
        $aObj = (array) $oObj;

        $vId = $aParamsUrl['autors'];

        if (isset($aObj['id']) && $aObj['id'] != $vId) {
            throw new \Exception("Ids no coincideixen",500);
        }

        $aAutor = $this->getRepositori()->getAutor($vId)[0] ?? [];

        if (sizeof($aAutor) == 0) {
            throw new \Exception("Autor no trobat",404);
        }



        //sino es canvia recuperar el hash anterior i actualitzar-lo
        $aResult = $this->getRepositori()->updateAutor($aObj);

        if ($aResult > 0) {

            // si la imatge que hi havia no estava buida, la esborrem
            if (!empty($aAutor['imatge']) && $aAutor['imatge'] != $aObj['imatge']) {

                $this->getRepositori()->delMedia($aAutor['imatge']);
            }

            return $this->get(["autors" => $aObj['id']]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function delete($aParamsUrl,$aParansToken) //esborrar
    {
        $vId = $aParamsUrl['autors'];

        $aAutor = $this->getRepositori()->getAutor($vId)[0] ?? [];

        if (sizeof($aAutor) == 0) {
            throw new \Exception("Autor no trobat",404);
        }

        try {
            $aResult = $this->getRepositori()->delAutor($vId);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            if (strpos($error,' 1451 ')) {
                $msgError = 'Aquest autor no es pot esborrar perquè l\'està fent servir algun vídeo';
            } else {
                $msgError = $error;
            }
            throw new \Exception($msgError,400);
        }

        if (!empty($aAutor['imatge'])) {

            $this->getRepositori()->delMedia($aAutor['imatge']);
        }

        return
            [
                "estado" => 200,
                "dades" => $aResult,
                "total" => 1
            ];
    }
}
