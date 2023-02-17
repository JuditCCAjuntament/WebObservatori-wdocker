<?php
namespace ADM_V1;
$vVersion="adm/v1/";

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

        $this->temesGet = $this->getMockBuilder(temes::class)
            ->setMethods(array('getRepositori','get','newVista','newCache','getTeCache'))
            ->getMock();

        $this->temesRepositori = $this->createMock(temesRepositori::class);

        $this->temes->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->temes->method('getTeCache')
            ->willReturn(false);

        $this->temes->method('getRepositori')
            ->willReturn($this->temesRepositori);

        $this->temesGet->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->temesGet->method('getTeCache')
            ->willReturn(false);

        $this->temesGet->method('getRepositori')
            ->willReturn($this->temesRepositori);
    }

    public function tearDown(): void
    {
        unset($this->temes);
        unset($this->temesGet);
        unset($this->temesRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_3_ok() {
        $aDadesUrl = [
            "temes" => "3"
        ];
        $aDades = [];

        // sortida
        $aSortida= [
            "id" => 3,
            "tema" => "Memòria"
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with("3")
            ->willReturn(
                [
                    "0" => [
                        "id" => 3,
                        "tema" => "Memòria"
                    ],

                ]
            );

        $this->assertEquals($expected,$this->temes->getResultat("get",$aDadesUrl,$aDades,[]));
    }

    public function test_get_100_no_trobat_ok() {
        $aDadesUrl = [
            "temes" => "100"
        ];
        $aDades = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Tema no trobat");

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with("100")
            ->willReturn(
                []
            );

        $this->temes->getResultat("get",$aDadesUrl,$aDades,[]);
    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "temes" => ""
        ];
        $aDades = [];
        $aDadesToken = [];


        // sortida
        $aSortida= [
            "0" => [
                "id" => 10,
			    "tema" => "Art"
            ],
            "1" => [
                "id" => 8,
                "tema" => "Ciència"
            ],
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->temesRepositori
            ->expects($this->once())
            ->method('getAllTemes')
            ->willReturn(
                [
                    "0" => [
                        "id" => 10,
                        "tema" => "Art"
                    ],
                    "1" => [
                        "id" => 8,
                        "tema" => "Ciència"
                    ],
                ]
            );


        $this->assertEquals($expected,$this->temes->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_getResultats_post_add_error_ko() {

        $aDadesUrl = [
            "temes" => ""
        ];

        $aDadesJson='{
                        "tema" => "Prova"
                        }';

        $aDades = json_decode($aDadesJson);
        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->temesRepositori
            ->expects($this->once())
            ->method('addTema')
            ->with(
                (array) $aDades
            )
            ->willReturn("");

        $this->temes->getResultat("post",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_post_add_ok() {

        $aDadesUrl = [
            "temes" => ""
        ];

        $aDadesJson='{
                    "tema": "prova"
                        }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->temesRepositori
            ->expects($this->once())
            ->method('addTema')
            ->with(
                (array) $aDades
            )
            ->willReturn( 1335);

        $this->temesGet
            ->expects($this->once())
            ->method('get')
            ->with(['temes' => 1335] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->temesGet->getResultat("post",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_ids_no_coincideixen_ko() {

        $aDadesUrl = [
            "temes" => 3
        ];

        $aDadesJson='{
                    "id" : 252,
                    "tema": "prova 2"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Ids no coincideixen");

        $this->temesRepositori
            ->expects($this->never())
            ->method('updateTema');


        $this->temesGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_no_existeix_ko() {

        $aDadesUrl = [
            "temes" => 3
        ];

        $aDadesJson='{
                    "id" : 3,
                    "tema": "prova 2"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Tema no trobat");

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with(3)
            ->willReturn([]);

        $this->temesRepositori
            ->expects($this->never())
            ->method('updateTema');

        $this->temesGet
            ->expects($this->never())
            ->method('get');

        $this->temesGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_ok() {

        $aDadesUrl = [
            "temes" => 3
        ];

        $aDadesJson='{
                    "id" : 3,
                    "tema": "prova 2"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with(3)
            ->willReturn([
                "0" => [
                    "id" => 3,
                    "tema" => "prova 2"
                ]
            ]);

        $this->temesRepositori
            ->expects($this->once())
            ->method('updateTema')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");



        $this->temesGet
            ->expects($this->once())
            ->method('get')
            ->with(['temes' => 3] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->temesGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_error() {

        $aDadesUrl = [
            "temes" => 3
        ];

        $aDadesJson='{
                    "id" : 3,
                    "tema": "prova"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with(3)
            ->willReturn([
                "0" => [
                    "id" => 3,
                    "tema" => "prova 2"
                ]
            ]);

        $this->temesRepositori
            ->expects($this->once())
            ->method('updateTema')
            ->with(
                (array) $aDades
            )
            ->willReturn("0");



        $this->temesGet
            ->expects($this->never())
            ->method('get');

        $expected = '"ok"';

        $this->assertEquals($expected,$this->temesGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_delete_ok() {

        $aDadesUrl = [
            "temes" => 3
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with(
                3
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 3,
                        "tema" => "prova"
                    ],
                ]
            );

        $this->temesRepositori
            ->expects($this->once())
            ->method('delTema')
            ->with(3
            )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->temes->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_no_trobat_ko() {

        $aDadesUrl = [
            "temes" => 3
        ];

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Tema no trobat");

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with(
                3
            )
            ->willReturn(
                []
            );

        $this->temesRepositori
            ->expects($this->never())
            ->method('delTema');

        $this->temes->getResultat("delete",$aDadesUrl,[],[]);
    }
    public function test_getResultats_delete_return_exception_ko() {

        $aDadesUrl = [
            "temes" => 3
        ];

        //sortida
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Aquest tema no es pot esborrar perquè l'està fent servir algun vídeo");

        $this->temesRepositori
            ->expects($this->once())
            ->method('getTema')
            ->with(
                3
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 3,
                        "tema" => "prova"
                    ],
                ]
            );

        $this->temesRepositori
            ->expects($this->once())
            ->method('delTema')
            ->with(3)
            ->will($this->throwException(new \Exception('Error 1451 : Error Mysql',400)))
            ;

        $this->temes->getResultat("delete",$aDadesUrl,[],[]);
    }
}

