<?php
namespace extas\components\access\operations;

use extas\components\access\AccessOperation;

/**
 * Class OperationOwn
 *
 * @package extas\components\access\operations
 * @author jeyroik@gmail.com
 */
class OperationOwn extends AccessOperation
{
    public const NAME = 'own';

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
