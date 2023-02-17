<?php
namespace PUB_V1;
$vVersion="pub/v1/";

require_once('app/api/'.$vVersion.'controladors/temes.php');

use PHPUnit\Framework\TestCase;

class temesTest extends TestCase {
    public function setUp(): void
    {
        $this->vistajsonmock = $this->getMockBuilder(\VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $this->temes = $this->getMockBuilder(temes::class)
            ->setMethods(array('getRepositori','newVista','newCache','getTeCache'))
            ->getMock();

        $this->temesRepositori = $this->createMock(temesRepositori::class);

        $this->temes->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->temes->method('getTeCache')
            ->willReturn(false);

        $this->temes->method('getRepositori')
            ->willReturn($this->temesRepositori);

    }

    public function tearDown(): void
    {
        unset($this->temes);
        unset($this->temesRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "temes" => ""
        ];
        $aDades = [];
        $aDadesToken = [];

        // sortida
        $aSortida= [
            "0" => ["Resultat Temes"]
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTemes')
            ->willReturn(
                [
                    "0" => [ "Resultat Temes"]
                ]
            );



        $this->assertEquals($expected,$this->temes->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }
}

