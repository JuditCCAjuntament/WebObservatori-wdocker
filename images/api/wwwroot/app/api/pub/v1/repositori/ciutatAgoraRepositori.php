<?php
namespace PUB_V1;
$vVersion = $vVersion ?? '';

require_once('app/DB/ConexionDB.php');
require_once('app/api/'.$vVersion.'repositori/temesRepositori.php');
require_once('app/api/'.$vVersion.'repositori/projectesRepositori.php');
require_once('app/api/'.$vVersion.'repositori/videosRepositori.php');
class ciutatAgoraRepositori
{
    public function getTemes() {
        $oTemes = new temesRepositori();

        return $oTemes->getTemes();
    }
    public function getProjectes()
    {
        $oProjectes = new projectesRepositori();
        return $oProjectes->getProjectes();
    }
    public function getVideosDestacats() {
        $oVideos = new videosRepositori();
        $aCerca=[
            "max" => 5,
            "destacats" => 1
        ];
        return $oVideos->getVideos($aCerca);
    }

    public function getVideosEntrevistes() {
        $oVideos = new videosRepositori();

        $aCerca=[
            "tema" => 7
        ];

        return $oVideos->getVideos($aCerca);
    }

    public function getUltimsVideos() {
        $oVideos = new videosRepositori();
        $aCerca=[
            "max" => 10
        ];
        return $oVideos->getVideos($aCerca);
    }
}
