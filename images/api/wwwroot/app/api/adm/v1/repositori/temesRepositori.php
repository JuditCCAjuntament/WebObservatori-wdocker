<?php
namespace ADM_V1;
require_once('app/DB/ConexionDB.php');

class temesRepositori
{
    public function getTema($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM temes WHERE id = :id",
                "params" => [
                    "id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getAllTemes()
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM temes ORDER BY tema",
                "params" => []
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function addTema($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "INSERT INTO  temes (
                                    id,
                                    tema
                                )
                                VALUES (
                                    :id,
                                    :tema    
                                )",
                "params" => [
                    ":id" => $oObj['id'],
                    ":tema" => $oObj['tema']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function updateTema($oObj)
    {
        if (!isset($oObj['id']) || $oObj['id'] == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "UPDATE  temes SET 
                            tema = :tema
                        WHERE id = :id",
                "params" => [
                    ":id" => $oObj['id'],
                    ":tema" => $oObj['tema']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delTema($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  temes
                        WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

}