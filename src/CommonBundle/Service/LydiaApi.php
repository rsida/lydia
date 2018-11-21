<?php

namespace CommonBundle\Service;

use CommonBundle\Entity\PaymentRequest;
use CommonBundle\Exception\LydiaApiRequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class LydiaApi
 * @package CommonBundle\Service
 */
class LydiaApi
{
    const REQUEST_OK = 0;

    /** @var RestClient $restClient */
    private $restClient;
    /** @var array $configuration */
    private $configuration;

    /**
     * LydiaApi constructor.
     *
     * @param RestClient $restClient
     * @param array $configuration
     */
    public function __construct(RestClient $restClient, array $configuration)
    {
        $this->restClient    = $restClient;
        $this->configuration = $configuration;
    }

    /**
     * Send a payment request to Lydia API
     *
     * @param PaymentRequest $paymentRequest
     * @throws LydiaApiRequestException|\RuntimeException
     */
    public function sendPayment(PaymentRequest $paymentRequest)
    {
        $rawResponse = $this->restClient->post('/api/request/do.json', ['form_params' => [
            'vendor_token' => $this->configuration['vendorToken'],
            'user_token'   => $this->configuration['userToken'],
            'recipient'    => $paymentRequest->getRecipient(),
            'message'      => $paymentRequest->getMessage(),
            'amount'       => $paymentRequest->getAmount(),
            'currency'     => $paymentRequest->getCurrency(),
            'type'         => $paymentRequest->getType(),
        ]]);

        $response = $this->handleResponse($rawResponse);

        if (!isset($response['error'])) {
            throw new \RuntimeException('Unknown Lydia API error');
        } elseif ($response['error'] != self::REQUEST_OK) {
            throw new LydiaApiRequestException($response['message'], $response['error']);
        }

        $paymentRequest
            ->setRequestId($response['request_id'])
            ->setRequestUuid($response['request_uuid'])
            ->setMobileUrl($response['mobile_url'])
            ->setMessage($response['message'])
        ;
    }

    /**
     * @param PaymentRequest $paymentRequest
     * @throws LydiaApiRequestException
     */
    public function getPaymentStatus(PaymentRequest $paymentRequest)
    {
        $rawResponse = $this->restClient->post('/api/request/state.json', ['form_params' => [
            'vendor_token' => $this->configuration['vendorToken'],
            'request_uuid'    => $paymentRequest->getRequestUuid(),
        ]]);

        $response = $this->handleResponse($rawResponse);

        if (!isset($response['state'])) {
            throw new \RuntimeException('Unknown Lydia API error');
        } elseif (isset($response['error']) && $response['error'] != self::REQUEST_OK) {
            throw new LydiaApiRequestException($response['message'], $response['error']);
        }

        $paymentRequest->setStatus($response['state']);
    }

    /**
     * This method manage the response to transform it into readable type for current application
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }
}
