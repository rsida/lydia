<?php

namespace AppBundle\Controller;

use AppBundle\Form\PaymentRequestType;
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
        $form = $this->createForm(PaymentRequestType::class);

        return $this->render('AppBundle:Payment:request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
