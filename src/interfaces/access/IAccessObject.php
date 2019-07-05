<?php
namespace extas\interfaces\access;

/**
 * Interface IAccessObject
 *
 * @package extas\interfaces\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IAccessObject extends IAccessSection
{
    /**
     * @param $section
     *
     * @return bool
     */
    public function hasSection($section): bool;
}
