<?php

namespace AdminBundle\Controller;

use CommonBundle\Service\LydiaApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PaymentController
 * @package AdminBundle\Controller
 * @Route("/payment")
 */
class PaymentController extends Controller
{
    /**
     * @Route("/request", name="admin_payment_request")
     */
    public function indexAction(LydiaApi $lydiaApi)
    {
        return $this->render('AdminBundle:Payment:Request/list.html.twig');
    }
}
