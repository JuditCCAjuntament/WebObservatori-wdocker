<?php
namespace ADM_V1;
$vVersion="adm/v1/";

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

        $this->projectesGet = $this->getMockBuilder(projectes::class)
            ->setMethods(array('getRepositori','get','newVista','newCache','getTeCache'))
            ->getMock();

        $this->projectesRepositori = $this->createMock(projectesRepositori::class);

        $this->projectes->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->projectes->method('getTeCache')
            ->willReturn(false);

        $this->projectes->method('getRepositori')
            ->willReturn($this->projectesRepositori);

        $this->projectesGet->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->projectesGet->method('getTeCache')
            ->willReturn(false);

        $this->projectesGet->method('getRepositori')
            ->willReturn($this->projectesRepositori);
    }

    public function tearDown(): void
    {
        unset($this->projectes);
        unset($this->projectesGet);
        unset($this->projectesRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_2_ok() {
        $aDadesUrl = [
            "projectes" => "2"
        ];
        $aDades = [];

        // sortida
        $aSortida= [
            "id" => 2,
			"nom" => "Cosmògraf",
			"resum" => "Projecte del cosmògraf",
			"text" => "<p>Text complert </p>",
			"web" => "http://www.manresacultura.cat/cosmògraf",
			"imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with("2")
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Cosmògraf",
                        "resum" => "Projecte del cosmògraf",
                        "text" => "<p>Text complert </p>",
                        "web" => "http://www.manresacultura.cat/cosmògraf",
                        "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    ],
                ]
            );

        $this->assertEquals($expected,$this->projectes->getResultat("get",$aDadesUrl,$aDades,[]));
    }

    public function test_get_100_no_trobat_ok() {
        $aDadesUrl = [
            "projectes" => "100"
        ];
        $aDades = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Projecte no trobat");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with("100")
            ->willReturn(
                []
            );

        $this->projectes->getResultat("get",$aDadesUrl,$aDades,[]);
    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "projectes" => ""
        ];
        $aDades = [];
        $aDadesToken = [];


        // sortida
        $aSortida= [
            "0" => [
                "id" => 2,
                "nom" => "Cosmògraf",
                "resum" => "Projecte del cosmògraf",
                "text" => "<p>Text complert </p>",
                "web" => "http://www.manresacultura.cat/cosmògraf",
                "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
            ],
            "1" => [
                "id" => 2,
                "nom" => "Cosmògraf",
                "resum" => "Projecte del cosmògraf",
                "text" => "<p>Text complert </p>",
                "web" => "http://www.manresacultura.cat/cosmògraf",
                "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
            ],
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getAllProjectes')
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Cosmògraf",
                        "resum" => "Projecte del cosmògraf",
                        "text" => "<p>Text complert </p>",
                        "web" => "http://www.manresacultura.cat/cosmògraf",
                        "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    ],
                    "1" => [
                        "id" => 2,
                        "nom" => "Cosmògraf",
                        "resum" => "Projecte del cosmògraf",
                        "text" => "<p>Text complert </p>",
                        "web" => "http://www.manresacultura.cat/cosmògraf",
                        "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    ],
                ]
            );


        $this->assertEquals($expected,$this->projectes->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_getResultats_post_add_error_ko() {

        $aDadesUrl = [
            "projectes" => ""
        ];

        $aDadesJson='{
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                        }';

        $aDades = json_decode($aDadesJson);
        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('addProjecte')
            ->with(
                (array) $aDades
            )
            ->willReturn("");

        $this->projectes->getResultat("post",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_post_add_ok() {

        $aDadesUrl = [
            "projectes" => ""
        ];

        $aDadesJson='{
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                        }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->projectesRepositori
            ->expects($this->once())
            ->method('addProjecte')
            ->with(
                (array) $aDades
            )
            ->willReturn( 1335);

        $this->projectesGet
            ->expects($this->once())
            ->method('get')
            ->with(['projectes' => 1335] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->projectesGet->getResultat("post",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_ids_no_coincideixen_ko() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        $aDadesJson='{
                        "id" : 252,
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Ids no coincideixen");

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');
        
        $this->projectesRepositori
            ->expects($this->never())
            ->method('updateProjecte');


        $this->projectesGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_no_existeix_ko() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Projecte no trobat");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(2)
            ->willReturn([]);

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        
        $this->projectesRepositori
            ->expects($this->never())
            ->method('updateProjecte');

        $this->projectesGet
            ->expects($this->never())
            ->method('get');

        $this->projectesGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_ok() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Cosmògraf",
                    "resum" => "Projecte del cosmògraf",
                    "text" => "<p>Text complert </p>",
                    "web" => "http://www.manresacultura.cat/cosmògraf",
                    "imatge" => ""
                ]
            ]);

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->projectesRepositori
            ->expects($this->once())
            ->method('updateProjecte')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");

        $this->projectesGet
            ->expects($this->once())
            ->method('get')
            ->with(['projectes' => 2] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->projectesGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_no_delete_orig_img_equal_orig_new_ok() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Cosmògraf",
                    "resum" => "Projecte del cosmògraf",
                    "text" => "<p>Text complert </p>",
                    "web" => "http://www.manresacultura.cat/cosmògraf",
                    "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                ]
            ]);

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->projectesRepositori
            ->expects($this->once())
            ->method('updateProjecte')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");

        $this->projectesGet
            ->expects($this->once())
            ->method('get')
            ->with(['projectes' => 2] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->projectesGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_delete_orig_img_ok() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Cosmògraf",
                    "resum" => "Projecte del cosmògraf",
                    "text" => "<p>Text complert </p>",
                    "web" => "http://www.manresacultura.cat/cosmògraf",
                    "imatge" => "/docs/ciutat_agora/projectes/cosmograf_845.jpg"
                ]
            ]);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('delMedia')
            ->with('/docs/ciutat_agora/projectes/cosmograf_845.jpg')
            ->willReturn('ok');

        $this->projectesRepositori
            ->expects($this->once())
            ->method('updateProjecte')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");

        $this->projectesGet
            ->expects($this->once())
            ->method('get')
            ->with(['projectes' => 2] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->projectesGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_error() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Cosmògraf",
                        "resum": "Projecte del cosmògraf",
                        "text": "<p>Text complert </p>",
                        "web": "http://www.manresacultura.cat/cosmògraf",
                        "imatge": "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Cosmògraf",
                    "resum" => "Projecte del cosmògraf",
                    "text" => "<p>Text complert </p>",
                    "web" => "http://www.manresacultura.cat/cosmògraf",
                    "imatge" => "/docs/ciutat_agora/projectes/cosmograf_84.jpg"
                ]
            ]);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('updateProjecte')
            ->with(
                (array) $aDades
            )
            ->willReturn("0");

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->projectesGet
            ->expects($this->never())
            ->method('get');

        $expected = '"ok"';

        $this->assertEquals($expected,$this->projectesGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_delete_ok() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(
                2
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Cosmògraf",
                        "resum" => "Projecte del cosmògraf",
                        "text" => "<p>Text complert </p>",
                        "web" => "http://www.manresacultura.cat/cosmògraf",
                        "imatge" => ""                    ],
                ]
            );

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->projectesRepositori
            ->expects($this->once())
            ->method('delProjecte')
            ->with(2
            )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->projectes->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_delete_img_ok() {

        $aDadesUrl = [
            "projectes" => 2
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(
                2
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Cosmògraf",
                        "resum" => "Projecte del cosmògraf",
                        "text" => "<p>Text complert </p>",
                        "web" => "http://www.manresacultura.cat/cosmògraf",
                        "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"                    ],
                ]
            );
        $this->projectesRepositori
            ->expects($this->once())
            ->method('delMedia')
            ->with('/docs/ciutat_agora/projectes/cosmograf_844.jpg')
            ->willReturn('ok');

        $this->projectesRepositori
            ->expects($this->once())
            ->method('delProjecte')
            ->with(2
            )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->projectes->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_no_trobat_ko() {

        $aDadesUrl = [
            "projectes" => 3
        ];

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Projecte no trobat");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(
                3
            )
            ->willReturn(
                []
            );

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delProjecte');

        $this->projectes->getResultat("delete",$aDadesUrl,[],[]);
    }

    public function test_getResultats_delete_return_exception_ko() {

        $aDadesUrl = [
            "projectes" => 3
        ];

        //sortida
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Aquest projecte no es pot esborrar perquè l'està fent servir algun vídeo");

        $this->projectesRepositori
            ->expects($this->once())
            ->method('getProjecte')
            ->with(
                3
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 3,
                        "nom" => "Cosmògraf",
                        "resum" => "Projecte del cosmògraf",
                        "text" => "<p>Text complert </p>",
                        "web" => "http://www.manresacultura.cat/cosmògraf",
                        "imatge" => "/docs/ciutat_agora/projectes/cosmograf_844.jpg"
                    ],
                ]
            );

        $this->projectesRepositori
            ->expects($this->once())
            ->method('delProjecte')
            ->with(3)
            ->will($this->throwException(new \Exception('Error 1451 : Error Mysql',400)));

        $this->projectesRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->projectes->getResultat("delete",$aDadesUrl,[],[]);
    }
}

