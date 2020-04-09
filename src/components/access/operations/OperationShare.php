<?php
namespace extas\components\access\operations;

use extas\components\access\AccessOperation;

/**
 * Class OperationShare
 *
 * @package extas\components\access\operations
 * @author jeyroik@gmail.com
 */
class OperationShare extends AccessOperation
{
    public const NAME = 'share';

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [
            static::FIELD__OPERATION => static::NAME
        ];
    }
}
