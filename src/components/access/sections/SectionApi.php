<?php
namespace extas\components\access\sections;

use extas\components\access\AccessOperation;

/**
 * Class SectionApi
 *
 * @package extas\components\access\sections
 * @author jeyroik@gmail.com
 */
class SectionApi extends AccessOperation
{
    const NAME = 'api';

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [
            static::FIELD__SECTION => static::NAME
        ];
    }
}
