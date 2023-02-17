<?php
namespace ADM_V1;
$vVersion="adm/v1/";

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

        $this->videosGet = $this->getMockBuilder(videos::class)
            ->setMethods(array('getRepositori','get','newVista','newCache','getTeCache'))
            ->getMock();

        $this->videosRepositori = $this->createMock(videosRepositori::class);

        $this->videos->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->videos->method('getTeCache')
            ->willReturn(false);

        $this->videos->method('getRepositori')
            ->willReturn($this->videosRepositori);

        $this->videosGet->method('newVista')
            ->willReturn($this->vistajsonmock);

        $this->videosGet->method('getTeCache')
            ->willReturn(false);

        $this->videosGet->method('getRepositori')
            ->willReturn($this->videosRepositori);
    }

    public function tearDown(): void
    {
        unset($this->videos);
        unset($this->videosGet);
        unset($this->videosRepositori);
        unset($this->vistajsonmock);

    }

    public function test_get_1_ok() {
        $aDadesUrl = [
            "videos" => "1"
        ];
        $aDades = [];

        // sortida
        $aSortida= [
            "id" => 1,
			"nom" => "L’aliança dels aprenents",
			"url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
			"imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
			"imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
			"resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, l'aprenentatge es posa en el centre",
			"text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
			"destacat" => 1,
			"ordre" => 1,
			"url_subtitols" => "cap",
			"url_podcast" => "cap",
			"url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
			"id_projecte" => 2,
			"durada"  => 1,
			"temes"  => [
				"0" => [
                    "id" => 1,
					"id_tema" => 10,
					"id_video" => 1
                ],
                "1" => [
                    "id" => 3,
					"id_tema" => 12,
					"id_video" => 1
                ]

			],
			"autors" => [
				"0" => [
                    "id" => 1,
					"id_video" => 1,
					"id_autor" => 2
                ]
			],
			"documents" => [
                "0" => [
                    "id" => 1,
                    "id_video" => 1,
                    "nom_document" => "prova",
                    "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
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
            ->with("1")
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "nom" => "L’aliança dels aprenents",
                        "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                        "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                        "imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
                        "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, l'aprenentatge es posa en el centre",
                        "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                        "destacat" => 1,
                        "ordre" => 1,
                        "url_subtitols" => "cap",
                        "url_podcast" => "cap",
                        "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                        "id_projecte" => 2,
                        "durada"  => 1
                    ]
                ]
            );

        $this->videosRepositori
            ->expects($this->once())
            ->method('getTemesByIdVideo')
            ->with("1")
            ->willReturn(
                [

                    "0" => [
                        "id" => 1,
                        "id_tema" => 10,
                        "id_video" => 1
                    ],
                    "1" => [
                        "id" => 3,
                        "id_tema" => 12,
                        "id_video" => 1
                    ]
                ]
            );

        $this->videosRepositori
            ->expects($this->once())
            ->method('getAutorsByIdVideo')
            ->with("1")
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "id_autor" => 2
                    ]
                ]
            );

        $this->videosRepositori
            ->expects($this->once())
            ->method('getDocumentsByIdVideo')
            ->with("1")
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                    ]
                ]
            );
        $this->assertEquals($expected,$this->videos->getResultat("get",$aDadesUrl,$aDades,[]));
    }

    public function test_get_100_no_trobat_ok() {
        $aDadesUrl = [
            "videos" => "100"
        ];
        $aDades = [];

        // sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Vídeo no trobat");

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with("100")
            ->willReturn(
                []
            );

        $this->videosRepositori
            ->expects($this->never())
            ->method('getTemesByIdVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('getAutorsByIdVideo');

        $this->videos->getResultat("get",$aDadesUrl,$aDades,[]);
    }

    public function test_get_all_ok() {
        $aDadesUrl = [
            "videos" => ""
        ];
        $aDades = [];
        $aDadesToken = [];


        // sortida
        $aSortida= [
            "0" => [
                "id" => 1,
                "nom" => "L’aliança dels aprenents",
                "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                "imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
                "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, l'aprenentatge es posa en el centre",
                "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                "destacat" => 1,
                "ordre" => 1,
                "url_subtitols" => "cap",
                "url_podcast" => "cap",
                "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                "id_projecte" => 2,
                "durada"  => 1,
                "temes"  => [
                    "0" => [
                        "id" => 1,
                        "id_tema" => 10,
                        "id_video" => 1
                    ],
                    "1" => [
                        "id" => 3,
                        "id_tema" => 12,
                        "id_video" => 1
                    ]

                ],
                "autors" => [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "id_autor" => 2
                    ]
                ],
                "documents" => [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                    ]
                ]
            ],
            "1" => [
                "id" => 2,
                "nom" => "L’aliança dels aprenents",
                "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                "imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
                "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, l'aprenentatge es posa en el centre",
                "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                "destacat" => 1,
                "ordre" => 1,
                "url_subtitols" => "cap",
                "url_podcast" => "cap",
                "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                "id_projecte" => 2,
                "durada"  => 1,
                "temes"  => [
                    "0" => [
                        "id" => 1,
                        "id_tema" => 10,
                        "id_video" => 1
                    ],
                    "1" => [
                        "id" => 3,
                        "id_tema" => 12,
                        "id_video" => 1
                    ]
                ],
                "autors" => [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "id_autor" => 2
                    ]
                ],
                "documents" => [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                    ]
                ]
            ],
        ];

        $expected = json_encode([
            "dades" => $aSortida,
            "total" => sizeof($aSortida)
        ],JSON_NUMERIC_CHECK);

        $this->videosRepositori
            ->expects($this->once())
            ->method('getAllVideos')
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "nom" => "L’aliança dels aprenents",
                        "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                        "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                        "imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
                        "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, l'aprenentatge es posa en el centre",
                        "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                        "destacat" => 1,
                        "ordre" => 1,
                        "url_subtitols" => "cap",
                        "url_podcast" => "cap",
                        "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                        "id_projecte" => 2,
                        "durada"  => 1,
                    ],
                    "1" => [
                        "id" => 2,
                        "nom" => "L’aliança dels aprenents",
                        "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                        "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                        "imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
                        "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, l'aprenentatge es posa en el centre",
                        "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                        "destacat" => 1,
                        "ordre" => 1,
                        "url_subtitols" => "cap",
                        "url_podcast" => "cap",
                        "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                        "id_projecte" => 2,
                        "durada"  => 1,
                    ],
                ]
            );
        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('getTemesByIdVideo')
            ->will(
                $this->returnValueMap(
                    array(
                        array(1,  [
                            "0" => [
                                "id" => 1,
                                "id_tema" => 10,
                                "id_video" => 1
                            ],
                            "1" => [
                                "id" => 3,
                                "id_tema" => 12,
                                "id_video" => 1
                            ]
                        ]),
                        array(2, [
                            "0" => [
                                "id" => 1,
                                "id_tema" => 10,
                                "id_video" => 1
                            ],
                            "1" => [
                                "id" => 3,
                                "id_tema" => 12,
                                "id_video" => 1
                            ]
                        ])
                    )
                )

            );

        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('getAutorsByIdVideo')
            ->will(
                $this->returnValueMap(
                    array(
                        array(1,  [
                            "0" => [
                                "id" => 1,
                                "id_video" => 1,
                                "id_autor" => 2
                            ]
                        ]),
                        array(2, [
                            "0" => [
                                "id" => 1,
                                "id_video" => 1,
                                "id_autor" => 2
                            ]
                        ])
                    )
                )

            );
        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('getDocumentsByIdVideo')
            ->will(
                $this->returnValueMap(
                    array(
                        array(1,  [
                            "0" => [
                                "id" => 1,
                                "id_video" => 1,
                                "nom_document" => "prova",
                                "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                            ]
                        ]),
                        array(2, [
                            "0" => [
                                "id" => 1,
                                "id_video" => 1,
                                "nom_document" => "prova",
                                "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                            ]
                        ])
                    )
                )

            );

        $this->assertEquals($expected,$this->videos->getResultat("get",$aDadesUrl,$aDades,$aDadesToken));
    }

    public function test_getResultats_post_add_error_ko() {

        $aDadesUrl = [
            "videos" => ""
        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [
                        {
                            "id": 1,
                            "id_tema": 10,
                            "id_video": 1
                        },
                        {
                            "id": 3,
                            "id_tema": 12,
                            "id_video": 1
                        }
                    ],
                    "autors": [
                        {
                            "id": 1,
                            "id_video": 1,
                            "id_autor": 2
                        }
                    ],
                    "documents": [
                         {
                            "id": 1,
                            "id_video": 1,
                            "nom_document": "prova",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        }
                    ]
                }';

        $aDades = json_decode($aDadesJson);
        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->videosRepositori
            ->expects($this->once())
            ->method('addVideo')
            ->with(
                (array) $aDades
            )
            ->willReturn("");

        $this->videosRepositori
            ->expects($this->never())
            ->method('addTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('addAutorVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('addDocumentVideo');

        $this->videos->getResultat("post",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_post_add_ok() {

        $aDadesUrl = [
            "videos" => ""
        ];

        $aDadesJson='{
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [
                        {
                            "id": 0,
                            "id_tema": 10,
                            "id_video": 0
                        },
                        {
                            "id": 0,
                            "id_tema": 12,
                            "id_video": 0
                        }
                    ],
                    "autors": [
                        {
                            "id": 0,
                            "id_video": 0,
                            "id_autor": 2
                        }
                    ],
                    "documents": [
                         {
                            "id": 1,
                            "id_video": 0,
                            "nom_document": "prova",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        }
                    ]
        }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->videosRepositori
            ->expects($this->once())
            ->method('addVideo')
            ->with(
                (array) $aDades
            )
            ->willReturn( ["1" => 1335]);

        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('addTemaVideo')
            ->withConsecutive(
                [[
                    "id" => 0,
                    "id_tema" => 10,
                    "id_video" => 1335
                ]],
                [[
                    "id" => 0,
                    "id_tema" => 12,
                    "id_video" => 1335
                ]]


            )
            ->willReturn("ok");

        $this->videosRepositori
            ->expects($this->exactly(1))
            ->method('addAutorVideo')
            ->withConsecutive(
                [[
                    "id" => 0,
                    "id_video" => 1335,
                    "id_autor" => 2
                ]]
            )
            ->willReturn("ok");

        $this->videosRepositori
            ->expects($this->exactly(1))
            ->method('addDocumentVideo')
            ->withConsecutive(
                [[
                    "id" => 1,
                    "id_video" => 1335,
                    "nom_document" => "prova",
                    "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                ]]
            )
            ->willReturn("ok");
        $this->videosGet
            ->expects($this->once())
            ->method('get')
            ->with(['videos' => 1335] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->videosGet->getResultat("post",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_ids_no_coincideixen_ko() {

        $aDadesUrl = [
            "videos" => 2
        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [
                        {
                            "id": 0,
                            "id_tema": 10,
                            "id_video": 0
                        },
                        {
                            "id": 0,
                            "id_tema": 12,
                            "id_video": 0
                        }
                    ],
                    "autors": [
                        {
                            "id": 0,
                            "id_video": 0,
                            "id_autor": 2
                        }
                    ],
                    "documents": [
                         {
                            "id": 1,
                            "id_video": 0,
                            "nom_document": "prova",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        }
                    ]
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Ids no coincideixen");

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');
        
        $this->videosRepositori
            ->expects($this->never())
            ->method('updateVideo');


        $this->videosGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_no_existeix_ko() {

        $aDadesUrl = [
            "videos" => 1

        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [
                        {
                            "id": 0,
                            "id_tema": 10,
                            "id_video": 0
                        },
                        {
                            "id": 0,
                            "id_tema": 12,
                            "id_video": 0
                        }
                    ],
                    "autors": [
                        {
                            "id": 0,
                            "id_video": 0,
                            "id_autor": 2
                        }
                    ],
                    "documents": [
                         {
                            "id": 1,
                            "id_video": 0,
                            "nom_document": "prova",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        }
                    ]
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Vídeo no trobat");

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(1)
            ->willReturn([]);

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');

        
        $this->videosRepositori
            ->expects($this->never())
            ->method('updateVideo');

        $this->videosGet
            ->expects($this->never())
            ->method('get');

        $this->videosGet->getResultat("put",$aDadesUrl,$aDades,[]);
    }

    public function test_getResultats_put_mod_ok() {

        $aDadesUrl = [
            "videos" => 1
        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [
                        {
                            "id": 0,
                            "id_tema": 15,
                            "id_video": 1
                        },
                        {
                            "id": -10,
                            "id_tema": 12,
                            "id_video": 1
                        }
                    ],
                    "autors": [
                        {
                            "id": 0,
                            "id_video": 1,
                            "id_autor": 2
                        },
                        {
                            "id": -15,
                            "id_video": 1,
                            "id_autor": 4
                        }
                        
                    ],
                    "documents": [
                         {
                            "id": 0,
                            "id_video": 0,
                            "nom_document": "prova afegir",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        },
                        {
                            "id": 1,
                            "id_video": 0,
                            "nom_document": "prova modificar",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        },
                        {
                            "id": -10,
                            "id_video": 0,
                            "nom_document": "prova esborrar",
                            "url_document": "/docs/ciutat_agora/documents/prova.pdf"
                        }
                    ]
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(1)
            ->willReturn([
                "0" => [
                    "id" => 1,
                    "nom" => "L’aliança dels aprenents",
                    "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" => "",
                    "imatge_v" => "",
                    "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" => 1,
                    "ordre" => 1,
                    "url_subtitols" => "cap",
                    "url_podcast" => "cap",
                    "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte" => 2,
                    "durada" => 1
                ]
            ]);

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->videosRepositori
            ->expects($this->once())
            ->method('updateVideo')
            ->with(
                (array) $aDades
            )
            ->willReturn(["1" => "ok"]);

        $this->videosRepositori
            ->expects($this->once())
            ->method('addTemaVideo')
            ->with(
                [
                    "id" => 0,
                    "id_tema" => 15,
                    "id_video" => 1
                ]
            )
            ->willReturn("ok");
        $this->videosRepositori
            ->expects($this->once())
            ->method('delTemaVideo')
            ->with( 10)
            ->willReturn("ok");

        $this->videosRepositori
            ->expects($this->once())
            ->method('addAutorVideo')
            ->with(
                [
                    "id" => 0,
                    "id_video" => 1,
                    "id_autor" => 2
                ]
            )
            ->willReturn("ok");

        $this->videosRepositori
            ->expects($this->once())
            ->method('delAutorVideo')
            ->with( 15)
            ->willReturn("ok");

        $this->videosRepositori
            ->expects($this->once())
            ->method('addDocumentVideo')
            ->with(
                [
                    "id" => 0,
                    "id_video" => 1,
                    "nom_document" => "prova afegir",
                    "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                ]
            )
            ->willReturn("ok");
        $this->videosRepositori
            ->expects($this->once())
            ->method('updateDocumentVideo')
            ->with(
                [
                    "id" => 1,
                    "id_video" => 1,
                    "nom_document" => "prova modificar",
                    "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                ]
            )
            ->willReturn("ok");


        $this->videosRepositori
            ->expects($this->once())
            ->method('delDocumentVideo')
            ->with( 10)
            ->willReturn("ok");

        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('getDocumentVideo')
            ->withConsecutive([1], [10])
            ->will(
                $this->returnValueMap(
                    array(
                        array(1,  [
                            "0" => [
                                "id" => 1,
                                "id_video" => 1,
                                "nom_document" => "prova afegir",
                                "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                            ]
                        ]),
                        array(10, [
                            "0" => [
                                "id" => 10,
                                "id_video" => 1,
                                "nom_document" => "prova afegir",
                                "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                            ]
                        ])
                    )
                )
            );

        $this->videosRepositori
            ->expects($this->once())
            ->method('delMediaDocument')
            ->with("/docs/ciutat_agora/documents/prova.pdf")
            ->willReturn("ok");

        $this->videosGet
            ->expects($this->once())
            ->method('get')
            ->with(['videos' => 1] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->videosGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_no_delete_orig_img_equal_orig_new_ok() {

        $aDadesUrl = [
            "videos" => 1
        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [],
                    "autors": [],
                    "documents": []
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(1)
            ->willReturn([
                "0" => [
                    "id" => 1,
                    "nom" => "L’aliança dels aprenents",
                    "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" => "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" => 1,
                    "ordre" => 1,
                    "url_subtitols" => "cap",
                    "url_podcast" => "cap",
                    "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte" => 2,
                    "durada" => 1
                ]
            ]);

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->videosRepositori
            ->expects($this->once())
            ->method('updateVideo')
            ->with(
                (array) $aDades
            )
            ->willReturn(["1" => "ok"]);

        $this->videosRepositori
            ->expects($this->never())
            ->method('addTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('addAutorVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delAutorVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('getDocumentVideo');


        $this->videosRepositori
            ->expects($this->never())
            ->method('addDocumentVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delDocumentVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMediaDocument');

        $this->videosGet
            ->expects($this->once())
            ->method('get')
            ->with(['videos' => 1] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->videosGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_delete_orig_img_ok() {

        $aDadesUrl = [
            "videos" => 1
        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [],
                    "autors": [],
                    "documents": []
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $expected = '"ok"';

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(1)
            ->willReturn([
                "0" => [
                    "id" => 1,
                    "nom" => "L’aliança dels aprenents",
                    "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_8.jpg",
                    "imatge_v" => "/docs/ciutat_agora/videos/marina_garces_1.jpg",
                    "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" => 1,
                    "ordre" => 1,
                    "url_subtitols" => "cap",
                    "url_podcast" => "cap",
                    "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte" => 2,
                    "durada" => 1
                ]
            ]);

        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('delMedia')
            ->withConsecutive(
                ["/docs/ciutat_agora/videos/marina_garces_1.jpg"],
                ["/docs/ciutat_agora/videos/cosmograf_8.jpg"]
            )
            ->willReturn('ok');

        $this->videosRepositori
            ->expects($this->once())
            ->method('updateVideo')
            ->with(
                (array) $aDades
            )
            ->willReturn(["1" => "ok"]);

        $this->videosRepositori
            ->expects($this->never())
            ->method('addTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('addAutorVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delAutorVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('getDocumentVideo');


        $this->videosRepositori
            ->expects($this->never())
            ->method('addDocumentVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delDocumentVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMediaDocument');

        $this->videosGet
            ->expects($this->once())
            ->method('get')
            ->with(['videos' => 1] )
            ->willReturn("ok");

        $this->assertEquals($expected,$this->videosGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_put_mod_error() {

        $aDadesUrl = [
            "videos" => 1
        ];

        $aDadesJson='{
                    "id" : 1,
                    "nom" : "L’aliança dels aprenents",
                    "url_video" : "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" : "/docs/ciutat_agora/videos/cosmograf_844.jpg",
                    "imatge_v" : "/docs/ciutat_agora/videos/marina_garces.jpg",
                    "resum" : "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text": "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" : 1,
                    "ordre" : 1,
                    "url_subtitols" : "cap",
                    "url_podcast" : "cap",
                    "url_versio_original" : "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte": 2,
                    "durada": 1,
                    "temes": [],
                    "autors": [],
                    "documents": []
                    }';

        $aDades = json_decode($aDadesJson);

        //sortida
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error inesperat");

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(1)
            ->willReturn([
                "0" => [
                    "id" => 1,
                    "nom" => "L’aliança dels aprenents",
                    "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                    "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_8.jpg",
                    "imatge_v" => "/docs/ciutat_agora/videos/marina_garce.jpg",
                    "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                    "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                    "destacat" => 1,
                    "ordre" => 1,
                    "url_subtitols" => "cap",
                    "url_podcast" => "cap",
                    "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                    "id_projecte" => 2,
                    "durada" => 1
                ]
            ]);

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->videosRepositori
            ->expects($this->once())
            ->method('updateVideo')
            ->with(
                (array) $aDades
            )
            ->willReturn("0");

        $this->videosRepositori
            ->expects($this->never())
            ->method('addTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delTemaVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('addAutorVideo');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delAutorVideo');

        $this->videosGet
            ->expects($this->never())
            ->method('get');

        $expected = '"ok"';

        $this->assertEquals($expected,$this->videosGet->getResultat("put",$aDadesUrl,$aDades,[]));
    }

    public function test_getResultats_delete_ok() {

        $aDadesUrl = [
            "videos" => 1
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(
                1
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "nom" => "L’aliança dels aprenents",
                        "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                        "imatge_h" => "",
                        "imatge_v" => "",
                        "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                        "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                        "destacat" => 1,
                        "ordre" => 1,
                        "url_subtitols" => "cap",
                        "url_podcast" => "cap",
                        "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                        "id_projecte" => 2,
                        "durada" => 1
                    ],
                ]
            );
        $this->videosRepositori
            ->expects($this->once())
            ->method('getDocumentsByIdVideo')
            ->with(
                1
            )
            ->willReturn(
                [

                ]
            );
        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMediaDocument');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delDocument');

        $this->videosRepositori
            ->expects($this->once())
            ->method('delVideo')
            ->with(1
            )
            ->willReturn(["1" => "ok"]);

        $this->assertEquals($expected,$this->videos->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_delete_img_ok() {

        $aDadesUrl = [
            "videos" => 1
        ];

        //sortida
        $aSortida= "ok";
        $expected = json_encode([
            "dades" => $aSortida,
            "total" => 1
        ],JSON_NUMERIC_CHECK);

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(
                1
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "nom" => "L’aliança dels aprenents",
                        "url_video" => "https://www.youtube.com/watch?v=l73ctbxO6_s&list=PLCtmGblXclOl7A9UcSBL66W7-YpAtmDcJ",
                        "imatge_h" => "/docs/ciutat_agora/videos/cosmograf_8.jpg",
                        "imatge_v" => "/docs/ciutat_agora/videos/marina_garces_1.jpg",
                        "resum" => "En una societat on el coneixement disponible és inabastable i la ignorància creix dia a dia, laprenentatge es posa en el centre",
                        "text" => "<p>En una societat on el coneixement disponible &eacute;s inabastable </p>",
                        "destacat" => 1,
                        "ordre" => 1,
                        "url_subtitols" => "cap",
                        "url_podcast" => "cap",
                        "url_versio_original" => "https://www.youtube.com/watch?v=xeRKXg1zOaU ",
                        "id_projecte" => 2,
                        "durada" => 1
                    ],
                ]
            );

        $this->videosRepositori
            ->expects($this->exactly(2))
            ->method('delMedia')
            ->withConsecutive(
                ["/docs/ciutat_agora/videos/marina_garces_1.jpg"],
                ["/docs/ciutat_agora/videos/cosmograf_8.jpg"]
            )
            ->willReturn('ok');

        $this->videosRepositori
            ->expects($this->once())
            ->method('getDocumentsByIdVideo')
            ->with(
                1
            )
            ->willReturn(
                [
                    "0" => [
                        "id" => 1,
                        "id_video" => 1,
                        "nom_document" => "prova",
                        "url_document" => "/docs/ciutat_agora/documents/prova.pdf"
                    ]
                ]
            );
        $this->videosRepositori
            ->expects($this->once())
            ->method('delDocument')
            ->with(1)
            ->willReturn(["1" => "ok"]);

        $this->videosRepositori
            ->expects($this->once())
            ->method('delMediaDocument')
            ->with("/docs/ciutat_agora/documents/prova.pdf")
            ->willReturn('ok');

        $this->videosRepositori
            ->expects($this->once())
            ->method('delVideo')
            ->with(1
            )
            ->willReturn(["1" => "ok"]);
        
        $this->assertEquals($expected,$this->videos->getResultat("delete",$aDadesUrl,[],[]));
    }

    public function test_getResultats_delete_no_trobat_ko() {

        $aDadesUrl = [
            "videos" => 1
        ];

        //sortida
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("Vídeo no trobat");

        $this->videosRepositori
            ->expects($this->once())
            ->method('getVideo')
            ->with(
                1
            )
            ->willReturn(
                []
            );

        $this->videosRepositori
            ->expects($this->never())
            ->method('delMedia');

        $this->videosRepositori
            ->expects($this->never())
            ->method('delVideo');

        $this->videos->getResultat("delete",$aDadesUrl,[],[]);
    }
}

