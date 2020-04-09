<?php
namespace extas\components\plugins;

use extas\components\access\Access;
use extas\interfaces\access\IAccessRepository;

/**
 * Class PluginInstallAccess
 *
 * @package extas\components\plugins\access
 * @author jeyroik@gmail.com
 */
class PluginInstallAccess extends PluginInstallDefault
{
    protected string $selfUID = Access::FIELD__ID;
    protected string $selfRepositoryClass = IAccessRepository::class;
    protected string $selfSection = 'access';
    protected string $selfName = 'access operation';
    protected string $selfItemClass = Access::class;
}
