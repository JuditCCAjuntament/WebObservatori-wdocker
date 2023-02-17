<?php
namespace ADM_V1;
$vVersion="adm/v1/";

require_once('app/api/'.$vVersion.'controladors/temes.php');
require_once('app/api/'.$vVersion.'controladors/projectes.php');
require_once('app/api/'.$vVersion.'controladors/videos.php');
require_once('app/api/'.$vVersion.'controladors/autors.php');

require_once('app/include/apiComponent.php');

class init  extends \apiComponent {
    public function __construct($paramsUrl)
    {
        parent::__construct($paramsUrl);
        $this->setEstructura(
            [
                "videos" => [],
                "autors" => [],
                "projectes" => [],
                "temes" => []
            ]
        );
        $this->setNameSpace("ADM_V1\\");
    }
}