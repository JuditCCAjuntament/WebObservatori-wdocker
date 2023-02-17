<?php
namespace PUB_V1;
$vVersion="pub/v1/";

require_once('app/api/'.$vVersion.'controladors/autors.php');

use PHPUnit\Framework\TestCase;

class autorsTest extends TestCase {
    public function setUp(): void
    {
        $this->vistajsonmock = $this->getMockBuilder(\VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $this->autors = $this->getMockBuilder(autors::class)
            ->setMethods(array('getRepositori','newVista','newCache','getTeCache'))
            ->getMock();

        $this->autorsRepositori = $this->createMock(autorsRepositori::class);

        $this->autors->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->autors->method('getTeCache')
            ->willReturn(false);

        $this->autors->method('getRepositori')
            ->willReturn($this->autorsRepositori);

    }

    public function tearDown(): void
    {
        unset($this->autors);
        unset($this->autorsRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "autors" => ""
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "0" => ["Resultat Autors"]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutors')
            ->willReturn(
                [
                    "0" => [ "Resultat Autors"]
                ]
            );



        $this->assertEquals($expected,$this->autors->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_get_all_cerca_ok() {
        $aDadesUrl = [
            "autors" => ""
        ];
        $aDades = [
            "nom" => "Mar"
        ];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "0" => ["Resultat Autors"]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutors')
            ->with(["nom" => "Mar"])
            ->willReturn(
                [
                    "0" => [ "Resultat Autors"]
                ]
            );



        $this->assertEquals($expected,$this->autors->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }
    public function test_get_1_ok() {
        $aDadesUrl = [
            "autors" => "1"
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "id" => 1,
            "videos" => [
                "0" => [
                    "id_video" => 1
                ],
                "1" => [
                    "id_video" => 2
                ]
            ]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(1)
            ->willReturn(
                [
                    "0" => [ "id" => 1]
                ]
            );

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getVideos')
            ->with(["autor" => 1])
            ->willReturn(
                [
                    "0" => [
                        "id_video" => 1
                    ],
                    "1" => [
                        "id_video" => 2
                    ]
                ]
            );


        $this->assertEquals($expected,$this->autors->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_get_autor_no_existeix_ko() {
        $aDadesUrl = [
            "autors" => "10"
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Autor no trobat");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(10)
            ->willReturn(
                []
            );

        $this->autorsRepositori
            ->expects($this->never())
            ->method('getVideos');

        $this->autors->getResultat("get",$aDadesUrl,$aDades,$aDadesToken);
    }
}

