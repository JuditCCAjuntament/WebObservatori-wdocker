<?php
namespace PUB_V1;
$vVersion="pub/v1/";

require_once('app/api/'.$vVersion.'controladors/temes.php');
require_once('app/api/'.$vVersion.'controladors/projectes.php');
require_once('app/api/'.$vVersion.'controladors/ciutatAgora.php');
require_once('app/api/'.$vVersion.'controladors/videos.php');
require_once('app/api/'.$vVersion.'controladors/autors.php');

require_once('app/include/apiComponent.php');

class init  extends \apiComponent {
    public function __construct($paramsUrl)
    {
        parent::__construct($paramsUrl);
        $this->setEstructura(
            [
                "ciutatAgora" => [],
                "videos" => [],
                "autors" => [],
                "projectes" => [],
                "temes" => []
            ]
        );
        $this->setNameSpace("PUB_V1\\");
    }
}