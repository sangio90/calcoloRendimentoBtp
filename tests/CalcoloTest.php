<?php

use CalcoloRendimentoBtp\Calcolo;

class CalcoloTest extends \PHPUnit_Framework_TestCase
{
    public function testOnePercentSimpleCase()
    {
        $calcolo = new Calcolo();
        $calcolo->setCosto(125);
        $calcolo->setDataDiScadenza('20460901');
        $calcolo->setCedolaLordaAnnuale(3.25);
        $calcolo->setCapitale(100000);


        $calcolo->calculate();
        $this->assertEquals(1.608, round($calcolo->getGuadagnoNettoPercentualeAnnuo(), 3));
    }
}