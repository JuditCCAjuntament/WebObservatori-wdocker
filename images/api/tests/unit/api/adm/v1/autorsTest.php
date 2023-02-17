<?php
namespace ADM_V1;
$vVersion="adm/v1/";

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

        $this->autorsGet = $this->getMockBuilder(autors::class)
            ->setMethods(array('getRepositori','get','newVista','newCache','getTeCache'))
            ->getMock();

        $this->autorsRepositori = $this->createMock(autorsRepositori::class);

        $this->autors->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->autors->method('getTeCache')
            ->willReturn(false);

        $this->autors->method('getRepositori')
            ->willReturn($this->autorsRepositori);

        $this->autorsGet->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->autorsGet->method('getTeCache')
            ->willReturn(false);

        $this->autorsGet->method('getRepositori')
            ->willReturn($this->autorsRepositori);
    }

    public function tearDown(): void
    {
        unset($this->autors);
        unset($this->autorsGet);
        unset($this->autorsRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_2_ok() {
        $aDadesUrl = [
            "autors" => "2"
        ];
        $aDades = [];

        // sortida
        $aSortida= [
            "id" => 2,
			"nom" => "Marina Garcés",
			"imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
			"resum" => "L’aliança dels aprenents.",
			"text" => "<p>text Complert</p>",
			"web" => "",
			"facebook" => "",
			"twitter" => "",
			"instagram" => "",
			"youtube" => ""
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with("2")
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Marina Garcés",
                        "imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum" => "L’aliança dels aprenents.",
                        "text" => "<p>text Complert</p>",
                        "web" => "",
                        "facebook" => "",
                        "twitter" => "",
                        "instagram" => "",
                        "youtube" => ""
                    ],
                ]
            );

        $this->assertEquals($expected,$this->autors->getResultat("get",$aDadesUrl,$aDades,[]));
    }

    public function test_get_100_no_trobat_ok() {
        $aDadesUrl = [
            "autors" => "100"
        ];
        $aDades = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Autor no trobat");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with("100")
            ->willReturn(
                []
            );

        $this->autors->getResultat("get",$aDadesUrl,$aDades,[]);
    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "autors" => ""
        ];
        $aDades = [];
        $aDadesToken = [];


        // sortida
        $aSortida= [
            "0" => [
                "id" => 2,
                "nom" => "Marina Garcés",
                "imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                "resum" => "L’aliança dels aprenents.",
                "text" => "<p>text Complert</p>",
                "web" => "",
                "facebook" => "",
                "twitter" => "",
                "instagram" => "",
                "youtube" => ""
            ],
            "1" => [
                "id" => 2,
                "nom" => "Marina Garcés",
                "imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                "resum" => "L’aliança dels aprenents.",
                "text" => "<p>text Complert</p>",
                "web" => "",
                "facebook" => "",
                "twitter" => "",
                "instagram" => "",
                "youtube" => ""
            ],
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAllAutors')
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Marina Garcés",
                        "imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum" => "L’aliança dels aprenents.",
                        "text" => "<p>text Complert</p>",
                        "web" => "",
                        "facebook" => "",
                        "twitter" => "",
                        "instagram" => "",
                        "youtube" => ""
                    ],
                    "1" => [
                        "id" => 2,
                        "nom" => "Marina Garcés",
                        "imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum" => "L’aliança dels aprenents.",
                        "text" => "<p>text Complert</p>",
                        "web" => "",
                        "facebook" => "",
                        "twitter" => "",
                        "instagram" => "",
                        "youtube" => ""
                    ],
                ]
            );


        $this->assertEquals($expected,$this->autors->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_getResultats_post_add_error_ko() {

        $aDadesUrl = [
            "autors" => ""
        ];

        $aDadesJson='{
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                        }';

        $aDades = json_decode($aDadesJson);
        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('addAutor')
            ->with(
                (array) $aDades
            )
            ->willReturn("");

        $this->autors->getResultat("post",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_post_add_ok() {

        $aDadesUrl = [
            "autors" => ""
        ];

        $aDadesJson='{
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                        }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->autorsRepositori
            ->expects($this->once())
            ->method('addAutor')
            ->with(
                (array) $aDades
            )
            ->willReturn( 1335);

        $this->autorsGet
            ->expects($this->once())
            ->method('get')
            ->with(['autors' => 1335] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->autorsGet->getResultat("post",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_ids_no_coincideixen_ko() {

        $aDadesUrl = [
            "autors" => 2
        ];

        $aDadesJson='{
                        "id" : 252,
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Ids no coincideixen");

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');
        
        $this->autorsRepositori
            ->expects($this->never())
            ->method('updateAutor');


        $this->autorsGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_no_existeix_ko() {

        $aDadesUrl = [
            "autors" => 2

        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Autor no trobat");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(2)
            ->willReturn([]);

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');

        
        $this->autorsRepositori
            ->expects($this->never())
            ->method('updateAutor');

        $this->autorsGet
            ->expects($this->never())
            ->method('get');

        $this->autorsGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_ok() {

        $aDadesUrl = [
            "autors" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Marina Garcés",
                    "imatge" => "",
                    "resum" => "L’aliança dels aprenents.",
                    "text" => "<p>text Complert</p>",
                    "web" => "",
                    "facebook" => "",
                    "twitter" => "",
                    "instagram" => "",
                    "youtube" => ""
                ]
            ]);

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->autorsRepositori
            ->expects($this->once())
            ->method('updateAutor')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");

        $this->autorsGet
            ->expects($this->once())
            ->method('get')
            ->with(['autors' => 2] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->autorsGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_no_delete_orig_img_equal_orig_new_ok() {

        $aDadesUrl = [
            "autors" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Marina Garcés",
                    "imatge" => "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                    "resum" => "L’aliança dels aprenents.",
                    "text" => "<p>text Complert</p>",
                    "web" => "",
                    "facebook" => "",
                    "twitter" => "",
                    "instagram" => "",
                    "youtube" => ""
                ]
            ]);

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->autorsRepositori
            ->expects($this->once())
            ->method('updateAutor')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");

        $this->autorsGet
            ->expects($this->once())
            ->method('get')
            ->with(['autors' => 2] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->autorsGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_delete_orig_img_ok() {

        $aDadesUrl = [
            "autors" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Marina Garcés",
                    "imatge" => "/docs/ciutat_agora/autors/marina_garces_12.jpg",
                    "resum" => "L’aliança dels aprenents.",
                    "text" => "<p>text Complert</p>",
                    "web" => "",
                    "facebook" => "",
                    "twitter" => "",
                    "instagram" => "",
                    "youtube" => ""
                ]
            ]);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('delMedia')
            ->with('/docs/ciutat_agora/autors/marina_garces_12.jpg')
            ->willReturn('ok');

        $this->autorsRepositori
            ->expects($this->once())
            ->method('updateAutor')
            ->with(
                (array) $aDades
            )
            ->willReturn("1");

        $this->autorsGet
            ->expects($this->once())
            ->method('get')
            ->with(['autors' => 2] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->autorsGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_error() {

        $aDadesUrl = [
            "autors" => 2
        ];

        $aDadesJson='{
                        "id" : 2,
                        "nom": "Marina Garcés",
                        "imatge": "/docs/ciutat_agora/autors/marina_garces_1.jpg",
                        "resum": "L’aliança dels aprenents.",
                        "text": "<p>text Complert</p>",
                        "web": "",
                        "facebook": "",
                        "twitter": "",
                        "instagram": "",
                        "youtube": ""
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(2)
            ->willReturn([
                "0" => [
                    "id" => 2,
                    "nom" => "Marina Garcés",
                    "imatge" => "/docs/ciutat_agora/autors/marina_garces_12.jpg",
                    "resum" => "L’aliança dels aprenents.",
                    "text" => "<p>text Complert</p>",
                    "web" => "",
                    "facebook" => "",
                    "twitter" => "",
                    "instagram" => "",
                    "youtube" => ""
                ]
            ]);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('updateAutor')
            ->with(
                (array) $aDades
            )
            ->willReturn("0");

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->autorsGet
            ->expects($this->never())
            ->method('get');

        $expected = '"ok"';

        $this->assertEquals($expected,$this->autorsGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_delete_ok() {

        $aDadesUrl = [
            "autors" => 2
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(
                2
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Marina Garcés",
                        "imatge" => "",
                        "resum" => "L’aliança dels aprenents.",
                        "text" => "<p>text Complert</p>",
                        "web" => "",
                        "facebook" => "",
                        "twitter" => "",
                        "instagram" => "",
                        "youtube" => ""
                    ],
                ]
            );

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->autorsRepositori
            ->expects($this->once())
            ->method('delAutor')
            ->with(2
            )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->autors->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_delete_img_ok() {

        $aDadesUrl = [
            "autors" => 2
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(
                2
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Marina Garcés",
                        "imatge" => "/docs/ciutat_agora/autors/marina_garces_12.jpg",
                        "resum" => "L’aliança dels aprenents.",
                        "text" => "<p>text Complert</p>",
                        "web" => "",
                        "facebook" => "",
                        "twitter" => "",
                        "instagram" => "",
                        "youtube" => ""
                    ]
                ]
            );
        $this->autorsRepositori
            ->expects($this->once())
            ->method('delMedia')
            ->with('/docs/ciutat_agora/autors/marina_garces_12.jpg')
            ->willReturn('ok');

        $this->autorsRepositori
            ->expects($this->once())
            ->method('delAutor')
            ->with(2
            )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->autors->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_no_trobat_ko() {

        $aDadesUrl = [
            "autors" => 3
        ];

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Autor no trobat");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(
                3
            )
            ->willReturn(
                []
            );

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delAutor');

        $this->autors->getResultat("delete",$aDadesUrl,[],[]);
    }

    public function test_getResultats_delete_return_exception_ko() {

        $aDadesUrl = [
            "autors" => 2
        ];

        //sortida
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Aquest autor no es pot esborrar perquè l'està fent servir algun vídeo");

        $this->autorsRepositori
            ->expects($this->once())
            ->method('getAutor')
            ->with(
                2
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 2,
                        "nom" => "Marina Garcés",
                        "imatge" => "/docs/ciutat_agora/autors/marina_garces_12.jpg",
                        "resum" => "L’aliança dels aprenents.",
                        "text" => "<p>text Complert</p>",
                        "web" => "",
                        "facebook" => "",
                        "twitter" => "",
                        "instagram" => "",
                        "youtube" => ""
                    ]
                ]
            );


        $this->autorsRepositori
            ->expects($this->once())
            ->method('delAutor')
            ->with(2)
            ->will($this->throwException(new \Exception('Error 1451 : Error Mysql',400)));

        $this->autorsRepositori
            ->expects($this->never())
            ->method('delMedia');


        $this->autors->getResultat("delete",$aDadesUrl,[],[]);
    }

}

