<?php
namespace extas\components\access;

use extas\interfaces\access\IAccess;
use extas\interfaces\access\IAccessObject;

/**
 * Class AccessObject
 *
 * @package extas\components\access
 * @author jeyroik@gmail.com
 */
class AccessObject extends AccessSection implements IAccessObject
{
    protected $object = '';

    /**
     * AccessObject constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->object && ($config[IAccess::FIELD__OBJECT] = $this->object);

        parent::__construct($config);
    }

    /**
     * @param $section
     *
     * @return bool
     */
    public function hasSection($section): bool
    {
        $repo = $this->getRepo();
        $subject = $repo->one([
            IAccess::FIELD__OBJECT => $this->getObject(),
            IAccess::FIELD__SECTION => $section,
        ]);

        return $subject ? true : false;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.access.object';
    }
}
