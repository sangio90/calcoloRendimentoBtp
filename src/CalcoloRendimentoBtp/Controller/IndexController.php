<?php

namespace CalcoloRendimentoBtp\Controller;

use CalcoloRendimentoBtp\Calcolo;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{

    /** @var  Application */
    protected $app;

    public function indexAction()
    {
        return $this->app['twig']->render('index/index.twig');
    }

    public function readAction($request)
    {
        $params = $request;
        $capitale = $params['capitale'];
        $cedola = $params['cedola'];
        $costo = $params['costo'];
        $scadenza = $params['scadenza'];

        $calcolo = new Calcolo();
        $calcolo->setDataDiScadenza($scadenza);
        $calcolo->setCapitale($capitale);
        $calcolo->setCedolaLordaAnnuale($cedola);
        $calcolo->setCosto($costo);

        $calcolo->calculate();

        return new JsonResponse([
            'residuo' => round($calcolo->getResiduo(), 2),
            'nettoAnnuale' => round($calcolo->getGuadagnoNettoAnnuale(), 2),
            'nettoPercentuale' => round($calcolo->getGuadagnoNettoPercentualeAnnuo(), 2),
        ]);
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }


}