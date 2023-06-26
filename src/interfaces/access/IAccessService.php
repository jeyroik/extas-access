<?php
namespace extas\interfaces\access;

use extas\interfaces\IItem;

interface IAccessService extends IItem
{
    public const SUBJECT = 'extas.access.service';

    public function isGranted(IAccess $access): bool;
    public function grant(IAccess $access): bool;
    public function forbid(IAccess $access): bool;
}
