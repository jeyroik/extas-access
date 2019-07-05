<?php
namespace extas\interfaces\access;

/**
 * Interface IAccessSection
 *
 * @package extas\interfaces\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IAccessSection extends IAccessSubject
{
    /**
     * @param $subject
     * @param string $section
     *
     * @return bool
     */
    public function hasSubject($subject, $section = ''): bool;
}
