<?php
namespace my\extas;

use extas\components\access\AccessOperation;
use extas\components\access\objects\ObjectRoot;
use extas\components\access\operations\OperationCreate;
use extas\components\access\sections\SectionData;
use extas\components\access\subjects\SubjectAccess;

/**
 * Class CombinedAccess
 *
 * Using:
 *
 * $combined = new \my\extas\CombinedAccess;
 *
 * if ($combined->exists()) {
 *      echo 'Root can data access create';
 * }
 *
 * @package my\extas
 * @author jeyroik@gmail.com
 */
class CombinedAccess extends AccessOperation
{
    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        $object = new ObjectRoot();
        $section = new SectionData();
        $subject = new SubjectAccess();
        $operation = new OperationCreate();

        return array_merge(
            $object->__toArray(),
            $section->__toArray(),
            $subject->__toArray(),
            $operation->__toArray()
        );
    }
}
