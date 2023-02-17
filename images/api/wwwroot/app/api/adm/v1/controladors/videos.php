<?php
namespace ADM_V1;
$vVersion = $vVersion ?? '';

require_once('app/include/controlador.php');
require_once('app/api/'.$vVersion.'repositori/videosRepositori.php');

class videos extends \controlador {
    private $repositori;

    public function __construct() {
        parent::__construct();
        $this->setValidat(true);
        $this->repositori = new videosRepositori();
    }

    protected function getRepositori() {
        return $this->repositori;
    }

    public function get($aParamsUrl,$aParams = "",$aParamsToken = "") {
        $vId = $aParamsUrl['videos'] ?? '';

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
        $aRetorn =  $this->getRepositori()->getVideo($vId)[0] ?? [];
        if (sizeof($aRetorn) == 0) {
            throw new \Exception("Vídeo no trobat",404);
        }
        $aRetorn['temes'] = $this->getRepositori()->getTemesByIdVideo($aRetorn['id']) ?? [];
        $aRetorn['autors'] = $this->getRepositori()->getAutorsByIdVideo($aRetorn['id']) ?? [];
        $aRetorn['documents'] = $this->getRepositori()->getDocumentsByIdVideo($aRetorn['id']) ?? [];
        return $aRetorn;
    }

    private function getAll() {
        $aRetorn = $this->getRepositori()->getAllVideos();
        foreach($aRetorn as $kObj => $aObj) {
            $aRetorn[$kObj]['temes'] = $this->getRepositori()->getTemesByIdVideo($aObj['id']) ?? [];
            $aRetorn[$kObj]['autors'] = $this->getRepositori()->getAutorsByIdVideo($aObj['id']) ?? [];
            $aRetorn[$kObj]['documents'] = $this->getRepositori()->getDocumentsByIdVideo($aObj['id']) ?? [];
        }
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

        $aIdResult = $this->getRepositori()->addVideo($aObj);
        if (isset($aIdResult[1]) && $aIdResult[1] > 0) {
            $id = $aIdResult[1];
            if (sizeof($aObj['temes']) > 0) {
                foreach ($aObj['temes'] as $tObj) {
                    $tObj->id_video = $id;
                    $this->getRepositori()->addTemaVideo((array) $tObj);
                }

            }
            if (sizeof($aObj['autors']) > 0) {
                foreach ($aObj['autors'] as $tObj) {
                    $tObj->id_video = $id;
                    $this->getRepositori()->addAutorVideo((array) $tObj);
                }

            }
            if (sizeof($aObj['documents']) > 0) {
                foreach ($aObj['documents'] as $tObj) {
                    $tObj->id_video = $id;
                    $this->getRepositori()->addDocumentVideo((array) $tObj);
                }

            }
            return $this->get(["videos" => $id]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function put($aParamsUrl,$oObj,$aParansToken) //modificar
    {
        $aObj = (array) $oObj;

        $vId = $aParamsUrl['videos'];

        if (isset($aObj['id']) && $aObj['id'] != $vId) {
            throw new \Exception("Ids no coincideixen",500);
        }

        $aVideo = $this->getRepositori()->getVideo($vId)[0] ?? [];

        if (sizeof($aVideo) == 0) {
            throw new \Exception("Vídeo no trobat",404);
        }



        //sino es canvia recuperar el hash anterior i actualitzar-lo
        $aResult = $this->getRepositori()->updateVideo($aObj);

        if (isset($aResult[1])) {
            // si la imatge que hi havia no estava buida, la esborrem
            if (!empty($aVideo['imatge_v']) && $aVideo['imatge_v'] != $aObj['imatge_v']) {

                $this->getRepositori()->delMedia($aVideo['imatge_v']);
            }

            if (!empty($aVideo['imatge_h']) && $aVideo['imatge_h'] != $aObj['imatge_h']) {

                $this->getRepositori()->delMedia($aVideo['imatge_h']);
            }

            if (sizeof($aObj['temes']) > 0) {
                foreach ($aObj['temes'] as $tObj) {
                    $tObj->id_video = $vId;
                    if ($tObj->id == 0) { // afegim
                        $this->getRepositori()->addTemaVideo((array) $tObj);
                    } else if ($tObj->id > 0) { // modifiquem
//                        $oGrupsPermisosDB->update($aO);
                    } else { // esborrem
                        $tObj->id = intval($tObj->id * -1);
                        $this->getRepositori()->delTemaVideo($tObj->id);
                    }
                }

            }

            if (sizeof($aObj['autors']) > 0) {
                foreach ($aObj['autors'] as $tObj) {
                    $tObj->id_video = $vId;
                    if ($tObj->id == 0) { // afegim
                        $this->getRepositori()->addAutorVideo((array) $tObj);
                    } else if ($tObj->id > 0) { // modifiquem
//                        $oGrupsPermisosDB->update($aO);
                    } else { // esborrem
                        $tObj->id = intval($tObj->id * -1);
                        $this->getRepositori()->delAutorVideo($tObj->id);
                    }
                }

            }

            if (sizeof($aObj['documents']) > 0) {
                foreach ($aObj['documents'] as $tObj) {
                    $tObj->id_video = $vId;
                    if ($tObj->id == 0) { // afegim
                        $this->getRepositori()->addDocumentVideo((array) $tObj);
                    } else if ($tObj->id > 0) { // modifiquem
                        $aDocument = $this->getRepositori()->getDocumentVideo($tObj->id)[0] ?? '';
                        $this->getRepositori()->updateDocumentVideo((array) $tObj);
                        if (!empty($aDocument['url_document']) && $aDocument['url_document'] != $tObj->url_document) {
                            $this->getRepositori()->delMediaDocument($aDocument['url_document']);
                        }
                    } else { // esborrem
                        $tObj->id = intval($tObj->id * -1);
                        $aDocument = $this->getRepositori()->getDocumentVideo($tObj->id)[0] ?? '';
                        $this->getRepositori()->delDocumentVideo($tObj->id);
                        if (!empty($aDocument['url_document']) ) {
                            $this->getRepositori()->delMediaDocument($aDocument['url_document']);
                        }
                    }
                }

            }

            return $this->get(["videos" => $aObj['id']]);
        }
        throw new \Exception("Error inesperat",500);
    }

    public function delete($aParamsUrl,$aParansToken) //esborrar
    {
        $vId = $aParamsUrl['videos'];

        $aVideo = $this->getRepositori()->getVideo($vId)[0] ?? [];

        if (sizeof($aVideo) == 0) {
            throw new \Exception("Vídeo no trobat",404);
        }

        $aDocuments = $this->getRepositori()->getDocumentsByIdVideo($vId);


        $aResult = $this->getRepositori()->delVideo($vId)[1];

        if (!empty($aVideo['imatge_v'])) {

            $this->getRepositori()->delMedia($aVideo['imatge_v']);
        }

        if (!empty($aVideo['imatge_h'])) {

            $this->getRepositori()->delMedia($aVideo['imatge_h']);
        }

        foreach($aDocuments as $aDocument) {
            $this->getRepositori()->delDocument($aDocument['id']);
            if (!empty($aDocument['url_document'])) {

                $this->getRepositori()->delMediaDocument($aDocument['url_document']);
            }
        }
        return
            [
                "estado" => 200,
                "dades" => $aResult,
                "total" => 1
            ];
    }
}
