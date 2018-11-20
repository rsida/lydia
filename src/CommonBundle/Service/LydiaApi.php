<?php

namespace CommonBundle\Service;

use Psr\Http\Message\ResponseInterface;

/**
 * Class LydiaApi
 * @package CommonBundle\Service
 */
class LydiaApi
{
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

    public function sendPayment()
    {
        $response = $this->restClient->post('/api/auth/register.json', ['form_params' => [
            'vendor_token'     => $this->configuration['vendorToken'],
            'amount'           => 'Romain',
            'currency'         => 'Sida',
            'recipient'        => 'romain.sida.pro@gmail.com',
            'signature'        => '0666587089',
            'expiration_time'  => 'romainsida',
            'webhook'          => '',
            'notify_recipient' => '',
            'order_ref'        => '',
            'message'          => '',
        ]]);

        return $this->handleResponse($response);
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
