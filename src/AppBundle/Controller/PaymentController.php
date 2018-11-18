<?php

namespace AppBundle\Controller;

use AppBundle\Form\PaymentRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PaymentController
 * @package AppBundle\Controller
 */
class PaymentController extends Controller
{
    /**
     * Display payment request form
     *
     * @Route("/request", name="payment_request", methods={"GET"})
     */
    public function requestAction()
    {
        $form = $this->createForm(PaymentRequestType::class, null, [
            'action' => $this->generateUrl('payment_request_validate'),
            'method' => Request::METHOD_POST
        ]);

        return $this->render('AppBundle:Payment:request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Validate form
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/request", name="payment_request_validate", methods={"POST"})
     */
    public function requestValidateAction(Request $request)
    {
        $form = $this->createForm(PaymentRequestType::class, null, [
            'action' => $this->generateUrl('payment_request_validate'),
            'method' => Request::METHOD_POST
        ]);
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return new JsonResponse([
                'state' => false,
                'data'  => $this->renderView('AppBundle:Payment:request.form.html.twig',[
                    'form' => $form->createView(),
                ])
            ]);
        }

        return new JsonResponse([
            'state'   => true,
            'message' => 'Request has been successfully sent !'
        ], JsonResponse::HTTP_CREATED);
    }
}
