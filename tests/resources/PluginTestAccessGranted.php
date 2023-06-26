<?php
namespace tests\resources;

use extas\components\plugins\Plugin;
use extas\interfaces\access\IAccess;
use extas\interfaces\stages\access\IStageAccessGranted;

class PluginTestAccessGranted extends Plugin implements IStageAccessGranted
{
    public static bool $granted = false;

    public function __invoke(IAccess $access): void
    {
        self::$granted = true;
    }
}
