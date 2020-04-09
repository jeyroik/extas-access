<?php
namespace extas\components\access\operations;

use extas\components\access\AccessOperation;

/**
 * Class OperationRead
 *
 * @package extas\components\access\operations
 * @author jeyroik@gmail.com
 */
class OperationRead extends AccessOperation
{
    public const NAME = 'read';

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
