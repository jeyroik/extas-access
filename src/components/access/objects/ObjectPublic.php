<?php
namespace extas\components\access\objects;

use extas\components\access\AccessOperation;

/**
 * Class ObjectPublic
 *
 * @package extas\components\access\objects
 * @author jeyroik@gmail.com
 */
class ObjectPublic extends AccessOperation
{
    const NAME = 'public';

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [
            static::FIELD__OBJECT => static::NAME
        ];
    }
}
