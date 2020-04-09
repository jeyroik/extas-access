<?php
namespace extas\components\access;

use extas\components\THasId;
use extas\interfaces\access\IAccess;
use extas\components\Item;

/**
 * Class Access
 *
 * @package extas\components\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
class Access extends Item implements IAccess
{
    use THasId;

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->config[static::FIELD__OBJECT] ?? '';
    }

    /**
     * @return string|array
     */
    public function getSection()
    {
        return $this->config[static::FIELD__SECTION] ?? '';
    }

    /**
     * @return string|array
     */
    public function getSubject()
    {
        return $this->config[static::FIELD__SUBJECT] ?? '';
    }

    /**
     * @return string|array
     */
    public function getOperation()
    {
        return $this->config[static::FIELD__OPERATION] ?? '';
    }

    /**
     * @param $object
     *
     * @return IAccess
     */
    public function setObject($object)
    {
        $this->config[static::FIELD__OBJECT] = $object;

        return $this;
    }

    /**
     * @param $section
     *
     * @return IAccess
     */
    public function setSection($section)
    {
        $this->config[static::FIELD__SECTION] = $section;

        return $this;
    }

    /**
     * @param $subject
     *
     * @return IAccess
     */
    public function setSubject($subject)
    {
        $this->config[static::FIELD__SUBJECT] = $subject;

        return $this;
    }

    /**
     * @param $operation
     *
     * @return IAccess
     */
    public function setOperation($operation)
    {
        $this->config[static::FIELD__OPERATION] = $operation;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
