<?php
namespace extas\components\plugins\init;

use extas\components\access\Access;

/**
 * Class InitAccess
 *
 * @package extas\components\plugins\init
 * @author jeyroik@gmail.com
 */
class InitAccess extends InitSection
{
    protected string $selfUID = Access::FIELD__ID;
    protected string $selfRepositoryClass = 'accessRepository';
    protected string $selfSection = 'access';
    protected string $selfName = 'access operation';
    protected string $selfItemClass = Access::class;
}
