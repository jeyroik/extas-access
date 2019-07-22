<?php
namespace my\extas;

use extas\components\access\AccessOperation;
use extas\components\access\objects\ObjectRoot;
use extas\components\access\operations\OperationCreate;
use extas\components\access\sections\SectionData;
use extas\components\access\subjects\SubjectAccess;

/**
 * Class CombinedAccessByMethods
 *
 * @package my\extas
 * @author jeyroik@gmail.com
 */
class CombinedAccessByMethods extends AccessOperation
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

        $object->addSection($section->getSection())
            ->addSubject($subject->getSubject())
            ->addOperation($operation->getOperation());

        return $object->__toArray();
    }
}
