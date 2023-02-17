<?php
namespace ADM_V1;
require_once('app/DB/ConexionDB.php');

class videosRepositori
{
    public function getVideo($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM videos WHERE id = :id",
                "params" => [
                    "id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getAllVideos()
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM videos ORDER BY ordre",
                "params" => []
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function addVideo($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "CALL ordenarVideos_p('A',:posicio, :id)",
                "params" => [
                    ":posicio" => $oObj['ordre'],
                    ":id" => 0,
                ]
            ],
            "1" => [
                "query" =>
                    "INSERT INTO  videos (
                                    nom,
                                    resum,
                                    text,
                                    imatge_v,
                                    imatge_h,
                                    url_video,
                                    destacat,
                                    ordre,
                                    url_subtitols,
                                    url_podcast,
                                    url_versio_original,
                                    url_versio_eng,
                                    id_projecte,
                                    durada,
                                    data_video
                                )
                                VALUES (
                                    :nom,
                                    :resum,
                                    :text,
                                    :imatge_v,
                                    :imatge_h,
                                    :url_video,
                                    :destacat,
                                    :ordre,
                                    :url_subtitols,
                                    :url_podcast,
                                    :url_versio_original,
                                    :url_versio_eng,
                                    :id_projecte,
                                    :durada,
                                    :data_video
                                )",
                "params" => [
                    ":nom" => $oObj['nom'],
                    ":resum" => $oObj['resum'],
                    ":text" => $oObj['text'],
                    ":imatge_v" => $oObj['imatge_v'],
                    ":imatge_h" => $oObj['imatge_h'],
                    ":url_video" => $oObj['url_video'],
                    ":destacat" => intval($oObj['destacat']),
                    ":ordre" => $oObj['ordre'],
                    ":url_subtitols" => $oObj['url_subtitols'],
                    ":url_podcast" => $oObj['url_podcast'],
                    ":url_versio_original" => $oObj['url_versio_original'],
                    ":url_versio_eng" => $oObj['url_versio_eng'] ?? '',
                    ":id_projecte" => $oObj['id_projecte'],
                    ":durada" => $oObj['durada'],
                    ":data_video" => $oObj['data_video'] ?? ''
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function updateVideo($oObj)
    {
        if (!isset($oObj['id']) || $oObj['id'] == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "CALL ordenarVideos_p('U',:posicio, :id)",
                "params" => [
                    ":posicio" => $oObj['ordre'],
                    ":id" =>  $oObj['id'],
                ]
            ],
            "1" => [
                "query" =>
                    "UPDATE  videos SET 
                                    nom = :nom,
                                    resum = :resum,
                                    text = :text,
                                    imatge_v = :imatge_v,
                                    imatge_h = :imatge_h,
                                    url_video = :url_video,
                                    destacat = :destacat,
                                    ordre = :ordre,
                                    url_subtitols = :url_subtitols,
                                    url_podcast = :url_podcast,
                                    url_versio_original = :url_versio_original,
                                    url_versio_eng = :url_versio_eng,
                                    id_projecte = :id_projecte,
                                    durada = :durada,
                                    data_video = :data_video
                                WHERE id = :id",
                "params" => [
                    ":id" => $oObj['id'],
                    ":nom" => $oObj['nom'],
                    ":resum" => $oObj['resum'],
                    ":text" => $oObj['text'],
                    ":imatge_v" => $oObj['imatge_v'],
                    ":imatge_h" => $oObj['imatge_h'],
                    ":url_video" => $oObj['url_video'],
                    ":destacat" => intval($oObj['destacat']),
                    ":ordre" => $oObj['ordre'],
                    ":url_subtitols" => $oObj['url_subtitols'],
                    ":url_podcast" => $oObj['url_podcast'],
                    ":url_versio_original" => $oObj['url_versio_original'],
                    ":url_versio_eng" => $oObj['url_versio_eng'] ?? '',
                    ":id_projecte" => $oObj['id_projecte'],
                    ":durada" => $oObj['durada'],
                    ":data_video" => $oObj['data_video'] ?? ''
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delVideo($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "CALL ordenarVideos_p('D',:posicio, :id)",
                "params" => [
                    ":posicio" => 0,
                    ":id" =>  $vId,
                ]
            ],
            "1" => [
                "query" =>
                    "DELETE FROM  videos
                            WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delDocument($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }
        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  videos_documents
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
        $carpeta = "ciutat_agora/videos/";

        $vImatge = substr($vFitxer,strrpos($vFitxer,"/") + 1);

        $oMedia = new \mediaApi();
        $aResults = $oMedia->deleteMedia($carpeta,$vImatge);

        return $aResults;
    }

    public function delMediaDocument($vFitxer)
    {
        $carpeta = "ciutat_agora/documents/";

        $vImatge = substr($vFitxer,strrpos($vFitxer,"/") + 1);
        $oMedia = new \mediaApi();
        $aResults = $oMedia->deleteMedia($carpeta,$vImatge);

        return $aResults;
    }
    public function getTemesByIdVideo($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM videos_temes WHERE id_video = :id",
                "params" => [
                    "id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function addTemaVideo($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "INSERT INTO  videos_temes (
                                         id_video,
                                         id_tema
                                    )
                                    VALUES (
                                         :id_video,
                                         :id_tema
                                    )",
                "params" => [
                    ":id_video" => $oObj['id_video'],
                    ":id_tema" => $oObj['id_tema']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delTemaVideo($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  videos_temes
                                        WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getAutorsByIdVideo($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM videos_autors WHERE id_video = :id",
                "params" => [
                    "id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function addAutorVideo($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "INSERT INTO  videos_autors (
                                         id_video,
                                         id_autor
                                    )
                                    VALUES (
                                         :id_video,
                                         :id_autor
                                    )",
                "params" => [
                    ":id_video" => $oObj['id_video'],
                    ":id_autor" => $oObj['id_autor']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delAutorVideo($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  videos_autors
                                        WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getDocumentsByIdVideo($vId)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM videos_documents WHERE id_video = :id",
                "params" => [
                    "id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function getDocumentVideo($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT * FROM  videos_documents
                            WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
    public function addDocumentVideo($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "INSERT INTO  videos_documents (
                                         id_video,
                                         nom_document,
                                         url_document
                                    )
                                    VALUES (
                                         :id_video,
                                         :nom_document,
                                         :url_document
                                    )",
                "params" => [
                    ":id_video" => $oObj['id_video'],
                    ":nom_document" => $oObj['nom_document'],
                    ":url_document" => $oObj['url_document']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function updateDocumentVideo($oObj)
    {
        $aSentencies = [
            "0" => [
                "query" =>
                    "UPDATE  videos_documents SET 
                                    nom_document = :nom_document,
                                    url_document = :url_document
                                WHERE id = :id",
                "params" => [
                    ":id" => $oObj['id'],
                    ":nom_document" => $oObj['nom_document'],
                    ":url_document" => $oObj['url_document']
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }

    public function delDocumentVideo($vId)
    {
        if (!isset($vId) || $vId == '') {
            throw new \Exception( "No té identificador",500);
        }

        $aSentencies = [
            "0" => [
                "query" =>
                    "DELETE FROM  videos_documents
                            WHERE id = :id",
                "params" => [
                    ":id" => $vId
                ]
            ]
        ];

        return \ConexionBD::executeQuery ('ciutat_agora',$aSentencies);
    }
}