<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/DB/ConexionDB.php');
require_once('app/api/'.$vVersion.'repositori/videosRepositori.php');

class autorsRepositori
{
    public function getAutors($aCerca)
    {
        $vWhere = "";
        $vNom = $aCerca['nom'] ?? '';

        if ($vNom != '') {
            $vWhere .= " AND nom like '%".$vNom."%'";
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT 
                            * 
                        FROM autors
                        WHERE 1 = 1".
                        $vWhere.
                        " ORDER BY nom",
                "params" => [
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
    public function getAutor($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM autors
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
