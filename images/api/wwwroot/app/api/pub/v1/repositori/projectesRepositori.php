<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/DB/ConexionDB.php');
require_once('app/api/'.$vVersion.'repositori/videosRepositori.php');

class projectesRepositori
{
    public function getProjectes()
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM projectes",
                "params" => [
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
    public function getProjecta($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM projectes
                        WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
    public function getVideos($aCercaVideos) {
        $oVideos = new videosRepositori();

        $oRetorn = $oVideos->getVideos($aCercaVideos);

        return $oRetorn;
    }
}
