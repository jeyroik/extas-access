<?php
namespace extas\interfaces\access;

use extas\interfaces\IHaveUUID;
use extas\interfaces\IItem;

/**
 * Interface IAccess
 *
 * @package extas\interfaces\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IAccess extends IItem, IHaveUUID
{
    public const SUBJECT = 'extas.access';

    public const FIELD__OBJECT = 'object';
    public const FIELD__SECTION = 'section';
    public const FIELD__SUBJECT = 'subject';
    public const FIELD__OPERATION = 'operation';

    public function getObject(): string;

    public function getSection(): string;

    public function getSubject(): string;

    public function getOperation(): string;

    public function setObject(string $object): static;

    public function setSection(string $section): static;

    public function setSubject(string $subject): static;

    public function setOperation(string $operation): static;
}
