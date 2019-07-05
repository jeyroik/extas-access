<?php
namespace extas\interfaces\access;

use extas\interfaces\IItem;

/**
 * Interface IAccess
 *
 * @package extas\interfaces\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IAccess extends IItem
{
    const SUBJECT = 'extas.access';

    const FIELD__OBJECT = 'object';
    const FIELD__SECTION = 'section';
    const FIELD__SUBJECT = 'subject';
    const FIELD__OPERATION = 'operation';

    /**
     * @return mixed
     */
    public function getObject();

    /**
     * @return string|array
     */
    public function getSection();

    /**
     * @return string|array
     */
    public function getSubject();

    /**
     * @return string|array
     */
    public function getOperation();

    /**
     * @param $object
     *
     * @return $this
     */
    public function setObject($object);

    /**
     * @param $section
     *
     * @return $this
     */
    public function setSection($section);

    /**
     * @param $subject
     *
     * @return $this
     */
    public function setSubject($subject);

    /**
     * @param $operation
     *
     * @return $this
     */
    public function setOperation($operation);
}
