<?php
namespace extas\components\access\operations;

use extas\components\access\AccessOperation;

/**
 * Class OperationDelete
 *
 * @package extas\components\access\operations
 * @author jeyroik@gmail.com
 */
class OperationDelete extends AccessOperation
{
    public const NAME = 'delete';

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
