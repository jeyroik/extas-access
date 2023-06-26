<?php
namespace extas\components\access;

use extas\components\Item;
use extas\interfaces\access\IAccess;
use extas\interfaces\access\IAccessService;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\stages\access\IStageAccessGranted;

/**
 * @method IRepository access()
 */
class AccessService extends Item implements IAccessService
{
    public function isGranted(IAccess $access): bool
    {
        $granted = $this->access()->all($access->__toArray());

        return !empty($granted);
    }

    public function grant(IAccess $access): bool
    {
        if ($this->isGranted($access)) {
            return true;
        }

        try {
            $this->access()->create($access);

            foreach ($this->getPluginsByStage(IStageAccessGranted::NAME) as $plugin) {
                /**
                 * @var IStageAccessGranted $plugin
                 */
                $plugin($access);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function forbid(IAccess $access): bool
    {
        if (!$this->isGranted($access)) {
            return true;
        }

        $deleted = $this->access()->delete($access->__toArray());

        return $deleted ? true : false;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
