<?php
namespace extas\components\access;

use extas\interfaces\access\IAccess;
use extas\components\Item;
use extas\components\THasStringId;

/**
 * Class Access
 *
 * @package extas\components\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
class Access extends Item implements IAccess
{
    use THasStringId;

    public function getObject(): string
    {
        return $this->config[static::FIELD__OBJECT] ?? '';
    }

    public function getSection(): string
    {
        return $this->config[static::FIELD__SECTION] ?? '';
    }

    public function getSubject(): string
    {
        return $this->config[static::FIELD__SUBJECT] ?? '';
    }

    public function getOperation(): string
    {
        return $this->config[static::FIELD__OPERATION] ?? '';
    }

    public function setObject(string $object): static
    {
        $this->config[static::FIELD__OBJECT] = $object;

        return $this;
    }

    public function setSection(string $section): static
    {
        $this->config[static::FIELD__SECTION] = $section;

        return $this;
    }

    public function setSubject(string $subject): static
    {
        $this->config[static::FIELD__SUBJECT] = $subject;

        return $this;
    }

    public function setOperation(string $operation): static
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
