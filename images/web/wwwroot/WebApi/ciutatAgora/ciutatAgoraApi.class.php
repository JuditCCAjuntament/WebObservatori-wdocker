<?php
require_once ("WebApi/global/apiGlobal.class.php");

class ciutatAgoraApi extends apiGlobal {

    function __construct() {
        // si la url coincideix amb url de desenvolupament per defecte fem servir la url de desenvolupament
        $vAjtApi = "";
        if (stripos($_SERVER['SCRIPT_URI'],getenv('URL_DEVEL')) === 0) {
            $vAjtApi = "devel";
        } else if (stripos($_SERVER['SCRIPT_URI'],getenv('URL_LOCAL')) === 0) {
            $vAjtApi = "local";
        }

        $vAjtApi = isset($_COOKIE["ajt_api"]) ? $_COOKIE["ajt_api"] : $vAjtApi;
        switch ($vAjtApi) {
            case "local":
                $vUrl = getenv('URL_API_CIUTATAGORA_LOCAL') != '' ? getenv('URL_API_CIUTATAGORA_LOCAL') : getenv('URL_API_CIUTATAGORA_PROD');
                break;
            case "devel":
                $vUrl = getenv('URL_API_CIUTATAGORA_DEVEL') != '' ? getenv('URL_API_CIUTATAGORA_DEVEL') : getenv('URL_API_CIUTATAGORA_PROD');
                break;
            default:
            case "prod":
                $vUrl = getenv('URL_API_CIUTATAGORA_PROD');
        }
        $vUrl .= "/pub/v1/"; // petició produccio

        parent::__construct($vUrl) ;

        $this->setTeCache(true);
    }
    public function getHome () {


        $aRetorn = $this->CallAPI("GET","ciutatAgora/");

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }

    public function getTemes () {


        $aRetorn = $this->CallAPI("GET","temes/");

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }

    public function getAutors ($aCerca) {

        $aDades = [
            "nom" => $aCerca['text'] ?? ''
        ];

        $aRetorn = $this->CallAPI("GET","autors/",$aDades);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
    public function getAutor($vId) {


        $aRetorn = $this->CallAPI("GET","autors/".$vId);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
    public function getProjectes() {


        $aRetorn = $this->CallAPI("GET","projectes/");

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
    public function getProjecta($vId) {


        $aRetorn = $this->CallAPI("GET","projectes/".$vId);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
    public function getVideosByTema($vIdTema) {

        $aDades['tema'] = $vIdTema;

        $aRetorn = $this->CallAPI("GET","videos/",$aDades);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
    public function getVideosByAutor($vIdAutor) {

        $aDades['autor'] = $vIdAutor;

        $aRetorn = $this->CallAPI("GET","videos/",$aDades);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
    public function getVideosByProjecte($vIdProjecte) {

        $aDades['projecte'] = $vIdProjecte;

        $aRetorn = $this->CallAPI("GET","videos/",$aDades);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }

    public function getVideos($aCerca) {

        $aDades = [
          "projecte" => $aCerca['projecte'] ?? '',
          "autor" => $aCerca['autor'] ?? '',
          "tema"  => $aCerca['tema'] ?? '',
          "text" => $aCerca['text'] ?? '',
          "espai_educatiu" => $aCerca['espai_educatiu'] ?? ''
        ];

        $aRetorn = $this->CallAPI("GET","videos/",$aDades);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }

    public function getVideo($vId) {

        $aRetorn = $this->CallAPI("GET","videos/".$vId);

        $vErrors = $this->getErrors();
        $vHttpCode = $this->getHttpCode();

        if (sizeof($vErrors) > 0) {
            throw new ExcepcionWeb('error',$vErrors,$vHttpCode);
        }
        if  ($vHttpCode != 200 ) {
            if ($vHttpCode == 404) {
                throw new ExcepcionWeb('pagina404',$vErrors,$vHttpCode);
            } else {
                throw new ExcepcionWeb('noExisteix',$vErrors,$vHttpCode);
            }

        }

        return $aRetorn['dades'];
    }
}

?>