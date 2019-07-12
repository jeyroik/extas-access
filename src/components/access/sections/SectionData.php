<?php
namespace extas\components\access\sections;

use extas\components\access\AccessOperation;

/**
 * Class SectionData
 *
 * @package extas\components\access\sections
 * @author jeyroik@gmail.com
 */
class SectionData extends AccessOperation
{
    const NAME = 'data';

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
