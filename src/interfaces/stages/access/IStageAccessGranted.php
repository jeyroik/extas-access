<?php
namespace extas\interfaces\stages\access;

use extas\interfaces\access\IAccess;

interface IStageAccessGranted
{
    public const NAME = 'extas.access.granted';

    public function __invoke(IAccess $access): void;
}
