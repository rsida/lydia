<?php

namespace CommonBundle\Repository;

/**
 * PaymentRequestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PaymentRequestRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Allow filters on default findAll
     *
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function findAll(array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->findBy([], $orderBy, $limit, $offset);
    }
}
