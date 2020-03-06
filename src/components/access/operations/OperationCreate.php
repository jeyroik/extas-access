<?php
namespace extas\components\access\operations;

use extas\components\access\AccessOperation;

/**
 * Class OperationCreate
 *
 * Using:
 *
 * $operation = new OperationCreate([
 *  IAccess::FIELD__OBJECT => 'jeyroik',
 *  IAccess::FIELD__SECTION => 'data',
 *  IAccess::FIELD__SUBJECT => 'player'
 * ]);
 *
 * if ($operation->exists()) {
 *      echo 'Jeyroik allowed to create the new player';
 * }
 *
 * @package extas\components\access\operations
 * @author jeyroik@gmail.com
 */
class OperationCreate extends AccessOperation
{
    public const NAME = 'create';

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
