<?php
namespace extas\components\access\subjects;

use extas\components\access\AccessOperation;

/**
 * Class SubjectAccess
 *
 * Using:
 * $accessCreating = new SubjectAccess([
 *      IAccess::FIELD__OBJECT => 'jeyroik',
 *      IAccess::FIELD__SECTION => 'data',
 *      IAccess::FIELD__OPERATION => OperationCreate::NAME
 * ]);
 *
 * if ($accessCreating->exists()) {
 *      echo 'Jeyroik may create an access';
 * }
 *
 * @package extas\components\access\subjects
 * @author jeyroik@gmail.com
 */
class SubjectAccess extends AccessOperation
{
    const NAME = 'access';

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [
            static::FIELD__SUBJECT => static::NAME
        ];
    }
}
