<?php

namespace AdminBundle\Enum;

/**
 * Class LydiaPaymentRequestStatusEnum
 * @package AdminBundle\Enum
 */
class LydiaPaymentRequestStatusEnum
{
    const REQUEST_ACCEPTED = 1;
    const REQUEST_WAITING_TO_BE_ACCEPTED = 0;
    const REQUEST_REFUSED = 5;
    const REQUEST_CANCELED = 6;
    const REQUEST_UNKNOWN = -1;

    /**
     * Return the list of available constant
     *
     * @return array
     */
    public static function getData()
    {
        return [
            self::REQUEST_ACCEPTED => 'Request accepted',
            self::REQUEST_WAITING_TO_BE_ACCEPTED => 'Waiting to be accepted',
            self::REQUEST_REFUSED => 'Refused by the payer',
            self::REQUEST_CANCELED => 'Cancelled by the owner',
            self::REQUEST_UNKNOWN => 'Unknown',
        ];
    }

    /**
     * Return the value of given key
     *
     * @param $key
     * @return string|null
     */
    public static function getValue($key)
    {
        $data = self::getData();

        return isset($data[$key]) ? $data[$key] : null;
    }
}
