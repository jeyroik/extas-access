<?php
namespace extas\components\access\operations;

use extas\components\access\AccessOperation;

/**
 * Class OperationUpdate
 *
 * @package extas\components\access\operations
 * @author jeyroik@gmail.com
 */
class OperationUpdate extends AccessOperation
{
    public const NAME = 'update';

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [
            static::FIELD__OPERATION => [
                static::NAME,
                OperationOwn::NAME
            ]
        ];
    }
}
