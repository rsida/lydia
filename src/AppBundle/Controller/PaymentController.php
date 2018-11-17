<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PaymentController
 * @package AppBundle\Controller
 */
class PaymentController extends Controller
{
    /**
     * @Route("/request")
     */
    public function requestAction()
    {
        return $this->render('AppBundle:Payment:request.html.twig');
    }

}
