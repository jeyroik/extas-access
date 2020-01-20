<?php
namespace extas\components\plugins;

use extas\components\access\Access;
use extas\components\access\AccessOperation;
use extas\interfaces\access\IAccessRepository;
use extas\interfaces\IItem;

/**
 * Class PluginInstallAccess
 *
 * @package extas\components\plugins\access
 * @author jeyroik@gmail.com
 */
class PluginInstallAccess extends PluginInstallDefault
{
    protected $selfUID = '';
    protected $selfRepositoryClass = IAccessRepository::class;
    protected $selfSection = 'access';
    protected $selfName = 'access operation';
    protected $selfItemClass = Access::class;

    /**
     * @param $item
     * @param $packageConfig
     *
     * @return string
     */
    public function getUidValue(&$item, $packageConfig): string
    {
        $operation = new AccessOperation($item);

        return $operation->getObject() . '.' .
            $operation->getSection() . '.' .
            $operation->getSubject() . '.' .
            $operation->getOperation();
    }

    /**
     * @param array $item
     * @param array $serviceConfig
     * @param \extas\interfaces\repositories\IRepository $repo
     *
     * @return IItem|null
     */
    protected function findItem($item, $serviceConfig, $repo): ?IItem
    {
        $operation = new AccessOperation($item);

        return $operation->exists() ? $operation : null;
    }
}
