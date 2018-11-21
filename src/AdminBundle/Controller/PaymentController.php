<?php

namespace AdminBundle\Controller;

use CommonBundle\Repository\PaymentRequestRepository;
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
    public function indexAction()
    {
        /** @var PaymentRequestRepository $repository */
        $repository = $this
            ->getDoctrine()
            ->getRepository('CommonBundle:PaymentRequest');

        $paymentRequests = $repository->findAll(['createdAt' => 'DESC']);

        return $this->render('AdminBundle:Payment:Request/list.html.twig', [
            'paymentRequests'=> $paymentRequests,
        ]);
    }
}
