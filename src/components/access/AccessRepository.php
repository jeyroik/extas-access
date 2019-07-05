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
    protected $pk = '_id';
    protected $name = 'access';
    protected $scope = 'extas';
    protected $idAs = '_id';
    protected $itemClass = Access::class;
}
