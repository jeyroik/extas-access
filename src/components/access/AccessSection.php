<?php
namespace extas\components\access;

use extas\interfaces\access\IAccess;
use extas\interfaces\access\IAccessSection;

/**
 * Class AccessSection
 *
 * @package extas\components\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
class AccessSection extends AccessSubject implements IAccessSection
{
    protected $section = '';

    /**
     * AccessSection constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->section && ($config[IAccess::FIELD__SECTION] = $this->section);

        parent::__construct($config);
    }

    /**
     * @param $subject
     * @param string $section
     *
     * @return bool
     */
    public function hasSubject($subject, $section = ''): bool
    {
        $repo = $this->getRepo();
        $subject = $repo->one([
            IAccess::FIELD__OBJECT => $this->getObject(),
            IAccess::FIELD__SECTION => $section ?: $this->getSection(),
            IAccess::FIELD__SUBJECT => $subject
        ]);

        return $subject ? true : false;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.access.section';
    }
}
