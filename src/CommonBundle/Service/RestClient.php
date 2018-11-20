<?php

namespace CommonBundle\Service;

/**
 * Class RestClient
 * @package CommonBundle\Service
 */
class RestClient extends \GuzzleHttp\Client
{
    /**
     * RestClient constructor.
     *
     * @param string $baseUri
     */
    public function __construct(string $baseUri)
    {
        $options = [
            'base_uri' => $baseUri,
        ];

        parent::__construct($options);
    }
}
