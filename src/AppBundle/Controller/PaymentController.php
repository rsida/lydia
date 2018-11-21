<?php

namespace AppBundle\Controller;

use AppBundle\Form\PaymentRequestType;
use CommonBundle\Entity\PaymentRequest;
use CommonBundle\Service\LydiaApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PaymentController
 * @package AppBundle\Controller
 * @Route("/payment")
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
        $form = $this->createForm(PaymentRequestType::class, new PaymentRequest(), [
            'action' => $this->generateUrl('payment_request_validate'),
            'method' => Request::METHOD_POST,
        ]);

        return $this->render('AppBundle:Payment:request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Validate form
     *
     * @param Request  $request
     * @param LydiaApi $lydiaApi
     * @return JsonResponse
     *
     * @Route("/request", name="payment_request_validate", methods={"POST"})
     */
    public function requestValidateAction(Request $request, LydiaApi $lydiaApi)
    {
        /** @var array $notifications */
        $notifications = [];

        $paymentRequest = new PaymentRequest();
        $paymentRequest
            ->setAmount(floatval(sprintf('%s.%s', mt_rand(10, 100), mt_rand(0, 99))))
            ->setType('email')
            ->setMessage('Test RS');

        $form = $this->createForm(PaymentRequestType::class, $paymentRequest, [
            'action' => $this->generateUrl('payment_request_validate'),
            'method' => Request::METHOD_POST,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $lydiaApi->sendPayment($paymentRequest);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($paymentRequest);
                $entityManager->flush();

                return new JsonResponse([
                    'state' => true,
                    'data'  => $this->renderView('AppBundle:Payment:success.html.twig', [
                        'message' => $paymentRequest->getMessage(),
                    ]),
                ], JsonResponse::HTTP_CREATED);
            } catch (\Exception $ex) {
                $notifications[] = ['type' => 'error', 'message' => 'An error occurred while saving data.'.$ex->getMessage()];
            }
        }

        return new JsonResponse([
            'state'         => false,
            'notifications' => $notifications,
            'data'          => $this->renderView('AppBundle:Payment:request.form.html.twig',[
                'form' => $form->createView(),
            ])
        ]);
    }
}
