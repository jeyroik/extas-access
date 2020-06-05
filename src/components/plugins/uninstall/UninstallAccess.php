<?php
namespace extas\components\plugins\uninstall;

use extas\components\access\Access;

/**
 * Class UninstallAccess
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallAccess extends UninstallSection
{
    protected string $selfUID = Access::FIELD__ID;
    protected string $selfRepositoryClass = 'accessRepository';
    protected string $selfSection = 'access';
    protected string $selfName = 'access operation';
    protected string $selfItemClass = Access::class;
}
