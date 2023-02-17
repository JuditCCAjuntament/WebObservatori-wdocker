<?php
namespace PUB_V1;
$vVersion="pub/v1/";

require_once('app/api/'.$vVersion.'controladors/videos.php');

use PHPUnit\Framework\TestCase;

class videosTest extends TestCase {
    public function setUp(): void
    {
        $this->vistajsonmock = $this->getMockBuilder(\VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $this->videos = $this->getMockBuilder(videos::class)
            ->setMethods(array('getRepositori','newVista','newCache','getTeCache'))
            ->getMock();

        $this->videosRepositori = $this->createMock(videosRepositori::class);

        $this->videos->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->videos->method('getTeCache')
            ->willReturn(false);

        $this->videos->method('getRepositori')
            ->willReturn($this->videosRepositori);

    }

    public function tearDown(): void
    {
        unset($this->videos);
        unset($this->videosRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "videos" => ""
        ];
        $aDades = [
            "text" => "a",
            "tema" => 1,
            "autor" => 2,
            "projecte" => 3,
            "espai_educatiu" => 1

        ];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "0" => [
                "id" => 1,
                "documents" => [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/programa_setmana_drets_dels_infants_2021.pdf"
                    ]
                ]
            ]

        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideos')
            ->with(["text" => "a","tema" => 1, "autor" => 2, "projecte" => 3,"espai_educatiu" => "1"])
            ->willReturn(
                [
                    "0" => [
                        "id" => 1
                    ]
                ]
            );

        $this->videosRepositori
            ->expects($this->once())
            ->method('getDocuments')
            ->with(1)
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/programa_setmana_drets_dels_infants_2021.pdf"
                    ]
                ]
            );

        $this->assertEquals($expected,$this->videos->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_get_1_ok() {
        $aDadesUrl = [
            "videos" => "1"
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "id" => 1,
            "documents" =>                 [
                "0" => [
                    "id" => 1,
                    "id_video" => 1,
                    "nom_document" => "prova",
                    "url_document" => "/docs/ciutat_agora/documents/programa_setmana_drets_dels_infants_2021.pdf"
                ]
            ]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(1)
            ->willReturn(
                [
                    "0" => [
                        "id" => 1

                    ]
                ]
            );

        $this->videosRepositori
            ->expects($this->once())
            ->method('getDocuments')
            ->with(1)
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/programa_setmana_drets_dels_infants_2021.pdf"
                    ]
                ]
            );
        $this->assertEquals($expected,$this->videos->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_get_autor_no_existeix_ko() {
        $aDadesUrl = [
            "videos" => "10"
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Vídeo no trobat");

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(10)
            ->willReturn(
                []
            );

        $this->videos->getResultat("get",$aDadesUrl,$aDades,$aDadesToken);
    }

}

