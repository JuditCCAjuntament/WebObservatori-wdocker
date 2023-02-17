<?php
namespace PUB_V1;
require_once('app/DB/ConexionDB.php');

class videosRepositori
{
    public function getVideos($aCerca)
    {
        $vWhere = "";
        $vLimit = "";
        $aParams = [];
        $vLeftJoin = "";


        $vDestacat = $aCerca['destacats'] ?? 0;

        if ($vDestacat == 1) {
            $vWhere .= " AND destacat = 1";
        }

        $vMax = $aCerca['max'] ?? '';
        $vInici = $aCerca['inici'] ?? 0;

        if ($vMax != '') {
            $vLimit = " LIMIT ".$vInici.", ".$vMax;
        }

        if (isset($aCerca['tema']) && $aCerca['tema'] != '') {
            $vLeftJoin .= " LEFT JOIN videos_temes vp ON vp.id_video = v.id ";
            $vWhere .= " AND vp.id_tema = :id_tema";
            $aParams[":id_tema"] = $aCerca['tema'];
        }
        if (isset($aCerca['autor']) && $aCerca['autor'] != '') {
            $vLeftJoin .= " LEFT JOIN videos_autors va ON va.id_video = v.id ";
            $vWhere .= " AND va.id_autor = :id_autor";
            $aParams[":id_autor"] = $aCerca['autor'];
        }
        if (isset($aCerca['projecte']) && $aCerca['projecte'] != '') {
            $vWhere .= " AND v.id_projecte = :id_projecte";
            $aParams[":id_projecte"] = $aCerca['projecte'];
        }
        if (isset($aCerca['text']) && $aCerca['text'] != '') {
            $vWhere .= " AND (v.resum like :text 
                            OR v.text like :text
                            OR v.nom like :text
                            )";
            $aParams[":text"] = "%".$aCerca['text']."%";
        }
        if (isset($aCerca['espai_educatiu']) && $aCerca['espai_educatiu'] != '') {
            $vWhere .= " AND (SELECT count(1) FROM videos_documents vd WHERE vd.id_video = v.id > 0
                            )";
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT 
                            v.*,
                            p.nom as 'projecte',
                            (SELECT GROUP_CONCAT(nom,':',a.id separator '#') FROM autors a
                            INNER JOIN videos_autors va ON va.id_autor = a.id
                            WHERE va.id_video = v.id                                        
                            GROUP BY va.id_video) as autors,
                            (SELECT count(1) FROM videos_documents vd WHERE vd.id_video = v.id) as espai_educatiu
                        FROM videos v
                        LEFT JOIN projectes p ON p.id = v.id_projecte".
                        $vLeftJoin.
                        " WHERE 1 = 1 ".
                        $vWhere.
                        " ORDER BY data_video DESC,ordre".
                        $vLimit,
                "params" => $aParams
            ]
        ];
        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getVideo($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT 
                            v.*,
                            p.nom as 'projecte',
                            (SELECT GROUP_CONCAT(nom,':',a.id separator '#') FROM autors a
                            INNER JOIN videos_autors va ON va.id_autor = a.id
                            WHERE va.id_video = v.id                                        
                            GROUP BY va.id_video) as autors
                        FROM videos v
                        LEFT JOIN projectes p ON p.id = v.id_projecte                        
                        WHERE v.id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
    public function getDocuments($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT 
                            d.*
                        FROM videos_documents d                       
                        WHERE d.id_video = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

}
