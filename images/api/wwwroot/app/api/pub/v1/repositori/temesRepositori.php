<?php
namespace PUB_V1;
require_once('app/DB/ConexionDB.php');

class temesRepositori
{
    public function getTemes()
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM temes",
                "params" => [
                ]
            ]
        ];
        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
}
