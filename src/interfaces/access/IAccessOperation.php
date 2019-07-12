<?php
namespace extas\interfaces\access;

/**
 * Interface IAccessOperation
 *
 * @package extas\interfaces\access
 * @author jeyroik@gmail.com
 */
interface IAccessOperation extends IAccess
{
    /**
     * @return bool
     */
    public function create(): bool;

    /**
     * @return bool
     */
    public function update(): bool;

    /**
     * @return bool
     */
    public function delete(): bool;

    /**
     * @return bool
     */
    public function exists(): bool;

    /**
     * @param array|string $operation
     *
     * @return $this
     */
    public function addOperation($operation);

    /**
     * @param array|string $subject
     *
     * @return $this
     */
    public function addSubject($subject);

    /**
     * @param array|string $section
     *
     * @return $this
     */
    public function addSection($section);

    /**
     * @param array|string $object
     *
     * @return $this
     */
    public function addObject($object);
}
