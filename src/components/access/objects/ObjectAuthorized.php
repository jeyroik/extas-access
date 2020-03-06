<?php
namespace extas\components\access\objects;

use extas\components\access\AccessOperation;

/**
 * Class ObjectAuthorized
 *
 * @package extas\components\access\objects
 * @author jeyroik@gmail.com
 */
class ObjectAuthorized extends AccessOperation
{
    public const NAME = 'authorized';

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
