<?php

namespace AdminBundle\Twig;

use AdminBundle\Enum\LydiaPaymentRequestStatusEnum;
use CommonBundle\Entity\PaymentRequest;
use CommonBundle\Service\LydiaApi;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class PaymentRequestExtension
 * @package AdminBundle\Twig
 */
class PaymentRequestExtension extends AbstractExtension
{
    /** @var LydiaApi $lydiaApi */
    private $lydiaApi;

    /**
     * PaymentRequestExtension constructor.
     *
     * @param LydiaApi $lydiaApi
     */
    public function __construct(LydiaApi $lydiaApi)
    {
        $this->lydiaApi = $lydiaApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('paymentCurrentStatus', [$this, 'currentStatus']),
            new TwigFilter('paymentStatusLabel', [$this, 'getLabel']),
        ];
    }

    /**
     * @param PaymentRequest $paymentRequest
     * @return string
     */
    public function currentStatus(PaymentRequest $paymentRequest)
    {
        try {
            $this->lydiaApi->getPaymentStatus($paymentRequest);

            return $paymentRequest->getStatus();
        } catch (\Exception $ex) {
            return 'Can\'t get status from Lydia API';
        }
    }

    /**
     * @param $status
     * @return null|string
     */
    public function getLabel($status)
    {
        return LydiaPaymentRequestStatusEnum::getValue($status);
    }
}
