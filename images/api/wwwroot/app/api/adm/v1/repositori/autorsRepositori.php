<?php
namespace ADM_V1;
require_once('app/DB/ConexionDB.php');
require_once('app/WebApi/media/mediaApi.class.php');

class autorsRepositori
{
    public function getAutor($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM autors WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getAllAutors()
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM autors",
                "params" => []
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function addAutor($oObj)
    {

        $aSentencies = [
            "0" => [
                "query" =>
                    "INSERT INTO  autors (
                                        nom,
                                        imatge,
                                        resum,
                                        text,
                                        web,
                                        facebook,
                                        twitter,
                                        instagram,
                                        youtube
                                    )
                                    VALUES (
                                        :nom,
                                        :imatge,
                                        :resum,
                                        :text,
                                        :web,
                                        :facebook,
                                        :twitter,
                                        :instagram,
                                        :youtube
                                    )",
                "params" => [
                    ":nom" => $oObj['nom'],
                    ":imatge" => $oObj['imatge'],
                    ":resum" => $oObj['resum'],
                    ":text" => $oObj['text'],
                    ":web" => $oObj['web'],
                    ":facebook" => $oObj['facebook'],
                    ":twitter" => $oObj['twitter'],
                    ":instagram" => $oObj['instagram'],
                    ":youtube" => $oObj['youtube']

                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function updateAutor($oObj)
    {
        if (!isset($oObj['id']) || $oObj['id'] == '') {
            throw new \Exception( "No té identificador",500);
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "UPDATE  autors SET 
                            nom = :nom,
                            imatge = :imatge,
                            resum = :resum,
                            text = :text,
                            web = :web,
                            facebook = :facebook,
                            twitter = :twitter,
                            instagram = :instagram,
                            youtube = :youtube
                        WHERE id = :id",
                "params" => [
                    ":id" => $oObj['id'],
                    ":nom" => $oObj['nom'],
                    ":imatge" => $oObj['imatge'],
                    ":resum" => $oObj['resum'],
                    ":text" => $oObj['text'],
                    ":web" => $oObj['web'],
                    ":facebook" => $oObj['facebook'],
                    ":twitter" => $oObj['twitter'],
                    ":instagram" => $oObj['instagram'],
                    ":youtube" => $oObj['youtube']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delAutor($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  autors
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
        $carpeta = "ciutat_agora/autors/";

        $vImatge = substr($vFitxer,strrpos($vFitxer,"/") + 1);

        $oMedia = new \mediaApi();
        $aResults = $oMedia->deleteMedia($carpeta,$vImatge);

        return $aResults;
    }
}