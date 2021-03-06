<?php
namespace extas\components\access;

use extas\components\repositories\Repository;
use extas\interfaces\access\IAccessRepository;

/**
 * Class AccessRepository
 *
 * @package extas\components\access
 * @author Jeyroik <jeyroik@gmail.com>
 */
class AccessRepository extends Repository implements IAccessRepository
{
    protected string $pk = Access::FIELD__ID;
    protected string $name = 'access';
    protected string $scope = 'extas';
    protected string $itemClass = Access::class;
}
