<?php
namespace extas\interfaces\access;

/**
 * Interface IAccessSubject
 *
 * @package extas\interfaces\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IAccessSubject extends IAccess
{
    /**
     * @param $operation
     * @param string $subject
     * @param string $section
     *
     * @return bool
     */
    public function hasOperation($operation, $subject = '', $section = ''): bool;
}
