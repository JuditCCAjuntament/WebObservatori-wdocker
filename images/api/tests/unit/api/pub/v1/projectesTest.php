<?php
namespace PUB_V1;
$vVersion="pub/v1/";

require_once('app/api/'.$vVersion.'controladors/projectes.php');

use PHPUnit\Framework\TestCase;

class projectesTest extends TestCase {
    public function setUp(): void
    {
        $this->vistajsonmock = $this->getMockBuilder(\VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $this->projectes = $this->getMockBuilder(projectes::class)
            ->setMethods(array('getRepositori','newVista','newCache','getTeCache'))
            ->getMock();

        $this->projectesRepositori = $this->createMock(projectesRepositori::class);

        $this->projectes->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->projectes->method('getTeCache')
            ->willReturn(false);

        $this->projectes->method('getRepositori')
            ->willReturn($this->projectesRepositori);

    }

    public function tearDown(): void
    {
        unset($this->projectes);
        unset($this->projectesRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "projectes" => ""
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "0" => ["Resultat Projectes"]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjectes')
            ->willReturn(
                [
                    "0" => [ "Resultat Projectes"]
                ]
            );



        $this->assertEquals($expected,$this->projectes->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_get_1_ok() {
        $aDadesUrl = [
            "projectes" => "1"
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

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecta')
            ->with(1)
            ->willReturn(
                [
                    "0" => [ "id" => 1]
                ]
            );

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getVideos')
            ->with(["projecte" => 1])
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


        $this->assertEquals($expected,$this->projectes->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_get_projecte_no_existeix_ko() {
        $aDadesUrl = [
            "projectes" => "10"
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Projecte no trobat");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecta')
            ->with(10)
            ->willReturn(
                []
            );

        $this->projectesRepositori
            ->expects($this->never())
            ->method('getVideos');

       $this->projectes->getResultat("get",$aDadesUrl,$aDades,$aDadesToken);
    }
}

