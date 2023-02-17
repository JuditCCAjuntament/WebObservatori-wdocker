<?php
namespace ADM_V1;
require_once('app/DB/ConexionDB.php');

class projectesRepositori
{
    public function getProjecte($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM projectes WHERE id = :id",
                "params" => [
                    "id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getAllProjectes()
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM projectes",
                "params" => []
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function addProjecte($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "INSERT INTO  projectes (
                                    nom,
                                    resum,
                                    text,
                                    web,
                                    imatge
                                )
                                VALUES (
                                    :nom,
                                    :resum,
                                    :text,
                                    :web,
                                    :imatge
                                )",
                "params" => [
                    ":nom" => $oObj['nom'],
                    ":resum" => $oObj['resum'],
                    ":text" => $oObj['text'],
                    ":web" => $oObj['web'],
                    ":imatge" => $oObj['imatge']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function updateProjecte($oObj)
    {
        if (!isset($oObj['id']) || $oObj['id'] == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "UPDATE  projectes SET 
                                    nom = :nom,
                                    resum = :resum,
                                    text = :text,
                                    web = :web,
                                    imatge = :imatge
                                WHERE id = :id",
                "params" => [
                    ":id" => $oObj['id'],
                    ":nom" => $oObj['nom'],
                    ":resum" => $oObj['resum'],
                    ":text" => $oObj['text'],
                    ":web" => $oObj['web'],
                    ":imatge" => $oObj['imatge']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delProjecte($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  projectes
                            WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delMedia($vFitxer)
    {
        $carpeta = "ciutat_agora/projectes/";

        $vImatge = substr($vFitxer,strrpos($vFitxer,"/") + 1);

        $oMedia = new \mediaApi();
        $aResults = $oMedia->deleteMedia($carpeta,$vImatge);

        return $aResults;
    }
}