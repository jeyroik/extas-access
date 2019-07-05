<?php
namespace extas\components\access;

use extas\interfaces\access\IAccess;
use extas\interfaces\access\IAccessRepository;
use extas\interfaces\access\IAccessSubject;
use extas\components\SystemContainer;

/**
 * Class AccessSubject
 *
 * @package extas\components\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
class AccessSubject extends AccessOperation implements IAccessSubject
{
    protected $subject = '';

    /**
     * AccessSection constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->subject && ($config[IAccess::FIELD__SUBJECT] = $this->subject);

        parent::__construct($config);
    }

    /**
     * @param $operation
     * @param string $subject
     * @param string $section
     *
     * @return bool
     */
    public function hasOperation($operation, $subject = '', $section = ''): bool
    {
        $repo = $this->getRepo();

        $operation = $repo->one([
            IAccess::FIELD__OBJECT => $this->getObject(),
            IAccess::FIELD__SECTION => $section ?: $this->getSection(),
            IAccess::FIELD__SUBJECT => $subject ?: $this->getSubject(),
            IAccess::FIELD__OPERATION => $operation
        ]);

        return $operation ? true : false;
    }

    /**
     * @return IAccessRepository
     */
    protected function getRepo(): IAccessRepository
    {
        return SystemContainer::getItem(IAccessRepository::class);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.access.subject';
    }
}
