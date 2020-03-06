<?php
namespace extas\components\access\objects;

/**
 * Class ObjectRoot
 *
 * @package extas\components\access\objects
 * @author jeyroik@gmail.com
 */
class ObjectRoot extends ObjectAuthorized
{
    public const NAME = 'root';

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        $parent = new parent();
        $parent->addObject(static::NAME);

        return $parent->__toArray();
    }
}
