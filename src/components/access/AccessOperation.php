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
    /**
     * AccessSection constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->applyDefaults($config);
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
            $operation = $repo->create($this);
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
     * @param array|string $object
     *
     * @return $this
     */
    public function addObject($object)
    {
        return $this->add(static::FIELD__OBJECT, $object);
    }

    /**
     * @param array|string $section
     *
     * @return $this
     */
    public function addSection($section)
    {
        return $this->add(static::FIELD__SECTION, $section);
    }

    /**
     * @param array|string $subject
     *
     * @return $this
     */
    public function addSubject($subject)
    {
        return $this->add(static::FIELD__SUBJECT, $subject);
    }

    /**
     * @param array|string $operation
     *
     * @return $this
     */
    public function addOperation($operation)
    {
        return $this->add(static::FIELD__OPERATION, $operation);
    }

    /**
     * @param string $field
     * @param array|string $value
     *
     * @return $this
     */
    protected function add($field, $value)
    {
        $getMethod = 'get' . ucfirst($field);
        $setMethod = 'set' . ucfirst($field);

        $items = $this->$getMethod();
        $items = is_string($items) ? [$items] : $items;

        if (is_array($value)) {
            $items = array_merge($items, $value);
        } elseif (is_string($value)) {
            $items[] = $value;
        }

        $this->$setMethod($items);

        return $this;
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
     * @param $config
     */
    protected function applyDefaults(&$config)
    {
        $defaults = $this->getDefaults();

        foreach ($defaults as $field => $value) {
            $config[$field] = $value;
        }
    }

    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.access.operation';
    }
}
