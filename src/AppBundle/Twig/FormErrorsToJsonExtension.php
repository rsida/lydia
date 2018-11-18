<?php

namespace AppBundle\Twig;

use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class FormErrorsToJsonExtension
 * @package AppBundle\Twig
 */
class FormErrorsToJsonExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('formErrorsToJson', [$this, 'formErrorsToJson']),
        ];
    }

    /**
     * Convert an FormErrorIterator into JSON array of error
     *
     * @param FormErrorIterator $errorIterator
     * @return false|string
     */
    public function formErrorsToJson(FormErrorIterator $errorIterator)
    {
        $result = [];

        /** @var FormError $error */
        foreach ($errorIterator as $error) {
            $result[] = $error->getMessage();
        }

        return json_encode($result);
    }
}
