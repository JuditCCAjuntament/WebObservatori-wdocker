<?php

require_once('app/include/testApiComponent.php');

use PHPUnit\Framework\TestCase;

class testApiComponentTest extends TestCase
{
    public function setUp(): void
    {
        // creem una aplicacio ficticia que tornara els gets, pots,...
        $this->aplicacionsStub =  $this->createMock(\pub\v3\controladors\aplicacions::class);

        $this->aplicacionsStub
            ->method('tePermis')
            ->willReturn(true);

        $this->aplicacionsStubWithoutPermis =  $this->createMock(\pub\v3\controladors\aplicacions::class);

        $this->aplicacionsStubWithoutPermis
            ->method('tePermis')
            ->willReturn(false);

        $this->usuarisStub =  $this->createMock(\pub\v3\controladors\usuaris::class);

        $this->usuarisStub
            ->method('tePermis')
            ->willReturn(true);

        $this->apimock = $this->getMockBuilder(USUARIS\PUB\V3\testApìComponent::class)
            ->setConstructorArgs(array(""))
            ->setMethods(array('getMethod','getControlador','getHeaderToken','decodeToken','validateToken'))
            ->getMock();

        $_GET=[];
        // dades de la url

    }

    public function tearDown(): void
    {
        unset($this->aplicacionsStub);
        unset($this->aplicacionsStubWithoutPermis);
        unset($this->usuarisStub);
        unset($this->apimock);
        unset($_GET);
    }

    public function test_apicomponent_getdades_sense_params_ko() {
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Url mal formatada");

        $paramUrl = "";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->never())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->apimock->callApi();
    }

    public function test_usuaris_pub_getdades_controlador_noexisteix_ko() {
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Url mal formatada");

        $paramUrl = "noexisteix";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->never())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->apimock->callApi();
    }

    public function test_usuaris_pub_getdades_exception_controlador_ko() {
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("Error a l'iniciar el controlador");

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->will($this->throwException(new Exception()));

        $this->apimock->callApi();
    }

    public function test_usuaris_pub_getdades_no_controlador_ko() {
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("No hi ha controlador");

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn("");

        $this->apimock->callApi();
    }

    public function test_apiComponent_getdades_crida_Get_sense_params_get_ok() {

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "aplicacions" => ""
                ],
                [],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->assertEquals($expected,$this->apimock->callApi());
    }

    public function test_apiComponent_getdades_crida_Get_amb_params_get_ok() {

        $paramUrl = "usuaris/1/aplicacions";

        $_GET['ordre'] ='DESC';

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->exactly(2))
            ->method('getControlador')
            ->will (
                $this->returnValueMap(
                    array(
                        array("aplicacions",  $this->aplicacionsStub),
                        array("usuaris", $this->usuarisStub)
                    )
                )
            );

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "usuaris" => 1,
                    "aplicacions" => ""
                ],
                [ "ordre" => "DESC" ],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->assertEquals($expected,$this->apimock->callApi());
    }

    public function test_apiComponent_getdades_crida_accions_amb_params_get_ok() {

        $paramUrl = "usuaris/@login";

        $_GET['usuari'] = "user";
        $_GET['contrasenya'] = "pass";
        $_GET['idApp'] = "1";
        $_GET['debug'] = "0";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("usuaris")
            ->willReturn($this->usuarisStub);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->usuarisStub
            ->expects($this->once())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "usuaris" => "@login"
                ],
                [
                    "usuari" => "user",
                    "contrasenya" => "pass",
                    "idApp" => "1",
                    "debug" => "0"
                ],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->assertEquals($expected,$this->apimock->callApi());
    }

    public function test_apiComponent_getdades_crida_get_validat_ok() {
        $this->expectExceptionCode(401);
        $this->expectExceptionMessage("Requereix token");

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(true);

        $this->aplicacionsStub
            ->expects($this->never())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "usuaris" => "@login"
                ],
                [
                    "usuari" => "user",
                    "contrasenya" => "pass",
                    "idApp" => "1",
                    "debug" => "0"
                ],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->apimock->callApi();
    }

    public function test_apiComponent_getdades_crida_get_validat_sense_permis_sense_token_ko() {
        $this->expectExceptionCode(401);
        $this->expectExceptionMessage("Requereix token");

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("");

        $this->apimock
            ->expects($this->never())
            ->method('decodeToken');

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStubWithoutPermis);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->aplicacionsStubWithoutPermis
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(true);

        $this->aplicacionsStubWithoutPermis
            ->expects($this->never())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "usuaris" => "@login"
                ],
                [
                    "usuari" => "user",
                    "contrasenya" => "pass",
                    "idApp" => "1",
                    "debug" => "0"
                ],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->apimock->callApi();
    }

    public function test_apiComponent_getdades_crida_get_validat_sense_permis_amb_token_ko() {
        $this->expectExceptionCode(403);
        $this->expectExceptionMessage("No tens permis");

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("qqqqqqqqqqqqqqq");

        $this->apimock
            ->expects($this->once())
            ->method('decodeToken')
            ->with("qqqqqqqqqqqqqqq")
            ->willReturn([
                "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                "nom" => "nom",
                "isAdmin" => "1",
                "idUsuari" => "1",
                "permisos" => [
                    "root" => []
                ],
                "debug" => 0
            ]);

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStubWithoutPermis);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->aplicacionsStubWithoutPermis
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(true);

        $this->aplicacionsStubWithoutPermis
            ->expects($this->never())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "usuaris" => "@login"
                ],
                [
                    "usuari" => "user",
                    "contrasenya" => "pass",
                    "idApp" => "1",
                    "debug" => "0"
                ],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->apimock->callApi();
    }

    public function test_apiComponent_getdades_crida_get_validat_amb_token_ok() {


        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("qqqqqqqqqqqqqqq");

        $this->apimock
            ->expects($this->once())
            ->method('decodeToken')
            ->with("qqqqqqqqqqqqqqq")
            ->willReturn([
                    "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                    "nom" => "nom",
                    "isAdmin" => "1",
                    "idUsuari" => "1",
                    "permisos" => [
                        "root" => []
                    ],
                    "debug" => 0
                ]);

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);



        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(true);

        $this->apimock
            ->expects($this->once())
            ->method('validateToken')
            ->with("qqqqqqqqqqqqqqq")
            ->willReturn([
                    "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                    "nom" => "nom",
                    "isAdmin" => "1",
                    "idUsuari" => "1",
                    "permisos" => [
                        "root" => []
                    ],
                    "debug" => 0
                ]

            );

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');


        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "aplicacions" => ""
                ],
                [
                ],
                [
                    "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                    "nom" => "nom",
                    "isAdmin" => "1",
                    "idUsuari" => "1",
                    "permisos" => [
                        "root" => []
                    ],
                    "debug" => 0,
                    "token" => "qqqqqqqqqqqqqqq"
                ]
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->assertEquals($expected,$this->apimock->callApi());
    }

    public function test_apiComponent_getdades_crida_get_validat_token_erroni_ko() {
        $this->expectExceptionCode(403);
        $this->expectExceptionMessage("Token invalid");

        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("qqqqqqqqqqqqqqq");

        $this->apimock
            ->expects($this->once())
            ->method('decodeToken')
            ->with("qqqqqqqqqqqqqqq")
            ->willReturn([
                "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                "nom" => "nom",
                "isAdmin" => "1",
                "idUsuari" => "1",
                "permisos" => [
                    "root" => []
                ],
                "debug" => 0
            ]);

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');


        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(true);

        $this->apimock
            ->expects($this->once())
            ->method('validateToken')
            ->with("qqqqqqqqqqqqqqq")
            ->will($this->throwException(new Exception("Token invalid",403)));

        $this->aplicacionsStub
            ->expects($this->never())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "usuaris" => "@login"
                ],
                [
                    "usuari" => "user",
                    "contrasenya" => "pass",
                    "idApp" => "1",
                    "debug" => "0"
                ],
                []
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->apimock->callApi();
    }

    public function test_apiComponent_getdades_crida_get_sense_validat_amb_token_ok() {


        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("qqqqqqqqqqqqqqq");

        $this->apimock
            ->expects($this->once())
            ->method('decodeToken')
            ->with("qqqqqqqqqqqqqqq")
            ->willReturn([
                "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                "nom" => "nom",
                "isAdmin" => "1",
                "idUsuari" => "1",
                "permisos" => [
                    "root" => []
                ],
                "debug" => 0
            ]);

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(false);



        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->apimock
            ->expects($this->never())
            ->method('validateToken');

        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "aplicacions" => ""
                ],
                [
                ],
                [
                    "sessio" => "a747d0874fabfb282db3d35aed5ad30d",
                    "nom" => "nom",
                    "isAdmin" => "1",
                    "idUsuari" => "1",
                    "permisos" => [
                        "root" => []
                    ],
                    "debug" => 0,
                    "token" => "qqqqqqqqqqqqqqq"
                ]
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->assertEquals($expected,$this->apimock->callApi());
    }

    public function test_apiComponent_getdades_crida_get_sense_validat_amb_token_erroni_ok() {


        $paramUrl = "aplicacions";

        $this->apimock->setParamsUrl($paramUrl);

        $this->apimock
            ->expects($this->once())
            ->method('getHeaderToken')
            ->willReturn("qqqqqqqqqqqqqqq");

        $this->apimock
            ->expects($this->once())
            ->method('decodeToken')
            ->with("qqqqqqqqqqqqqqq")
            ->willReturn([]);

        $this->apimock
            ->expects($this->once())
            ->method('getControlador')
            ->with("aplicacions")
            ->willReturn($this->aplicacionsStub);

        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getValidat')
            ->willReturn(false);

        $this->apimock
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');


        $this->aplicacionsStub
            ->expects($this->once())
            ->method('getResultat')
            ->with(
                "get",
                [
                    "aplicacions" => ""
                ],
                [
                ],
                [
                    "token" => "qqqqqqqqqqqqqqq"
                ]
            )
            ->willReturn('{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}');

        $expected = '{"dades":[{"id_aplicacio":1,"nom_aplicacio":"Webs","url":"https:\/\/admin.manresa.cat\/web","icona":""},{"id_aplicacio":2,"nom_aplicacio":"PAM","url":"","icona":""},{"id_aplicacio":4,"nom_aplicacio":"Regals i obsequis","url":"","icona":""}],"total":1}';

        $this->assertEquals($expected,$this->apimock->callApi());
    }
}