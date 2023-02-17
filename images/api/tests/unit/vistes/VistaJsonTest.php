<?php

require_once('app/vistes/VistaJson.php');

use DB\usuarisDB;
use PHPUnit\Framework\TestCase;

class vistaJsonTest extends TestCase {

    public function test_imprimir_ok() {


        $vistajsonmock = $this->getMockBuilder(VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $cuerpo =
            [
              "estado" => 200,
              "dades" => "prova"
            ];

        $expected = '{"dades":"prova"}';

        $aResult = $vistajsonmock->imprimir($cuerpo);
        $this->assertEquals($expected,$aResult);
    }

    public function test_impirmir_param_no_array_ko() {


        $vistajsonmock = $this->getMockBuilder(VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $cuerpo = "prova";

        $expected = '"prova"';

        $aResult = $vistajsonmock->imprimir($cuerpo);
        $this->assertEquals($expected,$aResult);
    }

    public function test_imprimir_definir_var_retorn_ok() {


        $vistajsonmock = $this->getMockBuilder(VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $cuerpo =
            [
                "estado" => 200,
                "dades" => "prova"
            ];

        $expected = '"prova"';

        $aResult = $vistajsonmock->imprimir($cuerpo,'dades');
        $this->assertEquals($expected,$aResult);
    }

    public function test_imprimir_definir_var_retorn_sense_params_ok() {


        $vistajsonmock = $this->getMockBuilder(VistaJson::class)
            ->setMethods(array('createHeaders'))
            ->getMock();

        $cuerpo = "prova";


        $expected = '"prova"';

        $aResult = $vistajsonmock->imprimir($cuerpo,'dades');
        $this->assertEquals($expected,$aResult);
    }
}