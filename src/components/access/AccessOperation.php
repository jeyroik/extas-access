<?php
namespace extas\components\access;

use extas\interfaces\access\IAccess;
use extas\interfaces\access\IAccessOperation;
use extas\interfaces\access\IAccessRepository;
use extas\components\SystemContainer;

/**
 * Class AccessOperation
 *
 * @package extas\components\access
 * @author jeyroik@gmail.com
 */
class AccessOperation extends Access implements IAccessOperation
{
    protected $operation = '';

    /**
     * AccessSection constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->operation && ($config[IAccess::FIELD__OPERATION] = $this->operation);

        parent::__construct($config);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function create(): bool
    {
        $repo = $this->getRepo();
        $operation = $this->getOne();

        if (!$operation) {
            $operation = $repo->create($this->__toArray());
            return $operation ? true : false;
        }

        throw new \Exception('Operation already exists');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function update(): bool
    {
        $operation = $this->getOne();

        if ($operation) {
            $updated = $this->getRepo()->update($operation);
            return $updated ? true : false;
        }

        throw new \Exception('Unknown operation');
    }

    /**
     * @return bool
     * @throws
     */
    public function delete(): bool
    {
        $operation = $this->getOne();

        if ($operation) {
            $deleted = $this->getRepo()->delete([
                IAccess::FIELD__SECTION => $operation->getSection(),
                IAccess::FIELD__OBJECT => $operation->getObject(),
                IAccess::FIELD__SUBJECT => $operation->getSubject(),
                IAccess::FIELD__OPERATION => $operation->getOperation()
            ]);
            return $deleted ? true : false;
        }

        throw new \Exception('Unknown operation');
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        $operation = $this->getOne();

        return $operation ? true : false;
    }

    /**
     * @return mixed|IAccess
     */
    protected function getOne()
    {
        $repo = $this->getRepo();
        $where = [
            IAccess::FIELD__OBJECT => $this->getObject()
        ];

        $this->getSection() && ($where[IAccess::FIELD__SECTION] = $this->getSection());
        $this->getSubject() && ($where[IAccess::FIELD__SUBJECT] = $this->getSubject());
        $this->getOperation() && ($where[IAccess::FIELD__OPERATION] = $this->getOperation());

        return $repo->one($where);
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
        return 'extas.access.operation';
    }
}
