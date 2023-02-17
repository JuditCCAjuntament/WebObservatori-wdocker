<?php
namespace PUB_V1;
$vVersion="pub/v1/";

require_once('app/api/'.$vVersion.'controladors/ciutatAgora.php');


use PHPUnit\Framework\TestCase;

class ciutatAgoraTest extends TestCase {
    public function setUp(): void
    {
        $this->vistajsonmock = $this->getMockBuilder(\VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $this->ciutatAgora = $this->getMockBuilder(ciutatAgora::class)
            ->setMethods(array('getRepositori','newVista','newCache','getTeCache'))
            ->getMock();

        $this->ciutatAgoraRepositori = $this->createMock(ciutatAgoraRepositori::class);

        $this->ciutatAgora->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->ciutatAgora->method('getTeCache')
            ->willReturn(false);

        $this->ciutatAgora->method('getRepositori')
            ->willReturn($this->ciutatAgoraRepositori);

    }

    public function tearDown(): void
    {
        unset($this->ciutatAgora);
        unset($this->ciutatAgoraRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_252_ok() {
        $aDadesUrl = [
            "ciutat_agora" => "1"
        ];
        $aDades = [];

        // sortida
        $aSortida= [];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->assertEquals($expected,$this->ciutatAgora->getResultat("get",$aDadesUrl,$aDades,[]));
    }

    public function test_get_by_portal_ok() {
        $aDadesUrl = [
            "ciutat_agora" => ""
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "temes" => [
                "0" => ["Resultat Temes"]
            ],
            "projectes" => [
                "0" => ["Resultat projectes"]
            ],
            "destacats" => [
                "0" => [ "Resultat Destacats"]
            ],
            "entrevistes" => [
                "0" => [ "Resultat Entrevistes"]
            ],
            "ultimes_act" => [
                "0" => [ "Resultat ultimes"]
            ]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->ciutatAgoraRepositori
            ->expects($this->once())
            ->method('getTemes')
            ->willReturn(
                [
                    "0" => [ "Resultat Temes"]
                ]
            );
        $this->ciutatAgoraRepositori
            ->expects($this->once())
            ->method('getProjectes')
            ->willReturn(
                [
                    "0" => [ "Resultat projectes"]
                ]
            );
        $this->ciutatAgoraRepositori
            ->expects($this->once())
            ->method('getVideosDestacats')
            ->willReturn(
                [
                    "0" => [ "Resultat Destacats"]
                ]
            );
        $this->ciutatAgoraRepositori
            ->expects($this->once())
            ->method('getVideosEntrevistes')
            ->willReturn(
                [
                    "0" => [ "Resultat Entrevistes"]
                ]
            );
        $this->ciutatAgoraRepositori
            ->expects($this->once())
            ->method('getUltimsVideos')
            ->willReturn(
                [
                    "0" => [ "Resultat ultimes"]
                ]
            );


        $this->assertEquals($expected,$this->ciutatAgora->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }
}

