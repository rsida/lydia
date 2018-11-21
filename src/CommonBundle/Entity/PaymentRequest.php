<?php

namespace CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentRequest
 *
 * @ORM\Table(name="payment_request")
 * @ORM\Entity(repositoryClass="CommonBundle\Repository\PaymentRequestRepository")
 */
class PaymentRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="recipient", type="string", length=255)
     */
    private $recipient;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     */
    private $message;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=3)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="requestId", type="integer")
     */
    private $requestId;

    /**
     * @var string
     *
     * @ORM\Column(name="requestUuid", type="string", length=255)
     */
    private $requestUuid;

    /**
     * @var string
     *
     * @ORM\Column(name="mobileUrl", type="string", length=255)
     */
    private $mobileUrl;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * PaymentRequest constructor.
     */
    public function __construct()
    {
        $this->currency = 'EUR';
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recipient
     *
     * @param string $recipient
     *
     * @return PaymentRequest
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return PaymentRequest
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $recipient
     *
     * @return PaymentRequest
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return PaymentRequest
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return PaymentRequest
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return PaymentRequest
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return PaymentRequest
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set requestId
     *
     * @param int $requestId
     *
     * @return PaymentRequest
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Get requestId
     *
     * @return int
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Set requestUuid
     *
     * @param string $requestUuid
     *
     * @return PaymentRequest
     */
    public function setRequestUuid($requestUuid)
    {
        $this->requestUuid = $requestUuid;

        return $this;
    }

    /**
     * Get requestUuid
     *
     * @return int
     */
    public function getRequestUuid()
    {
        return $this->requestUuid;
    }

    /**
     * Set mobileUrl
     *
     * @param string $mobileUrl
     *
     * @return PaymentRequest
     */
    public function setMobileUrl($mobileUrl)
    {
        $this->mobileUrl = $mobileUrl;

        return $this;
    }

    /**
     * Get mobileUrl
     *
     * @return int
     */
    public function getMobileUrl()
    {
        return $this->mobileUrl;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return PaymentRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PaymentRequest
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
