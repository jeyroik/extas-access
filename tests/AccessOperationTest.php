<?php

use PHPUnit\Framework\TestCase;
use extas\components\access\AccessOperation;
use extas\components\SystemContainer;
use extas\interfaces\access\IAccessRepository;
use extas\components\access\AccessRepository;
use extas\components\access\Access;
use extas\interfaces\repositories\IRepository;

/**
 * Class AccessOperationTest
 *
 * @author jeyroik@gmail.com
 */
class AccessOperationTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $accessRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->accessRepo = new AccessRepository();
        SystemContainer::addItem(
            IAccessRepository::class,
            AccessRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->accessRepo->delete([Access::FIELD__SECTION => 'test']);
    }

    public function testCreate()
    {
        $operation = new AccessOperation([
            AccessOperation::FIELD__SECTION => 'test',
            AccessOperation::FIELD__SUBJECT => 'players',
            AccessOperation::FIELD__OPERATION => 'index',
            AccessOperation::FIELD__OBJECT => 'admin'
        ]);

        $this->assertFalse($operation->exists());
        $this->assertTrue($operation->create());
        $this->assertTrue($operation->exists());
        $this->expectExceptionMessage('Operation already exists');
        $operation->create();
    }

    public function testDelete()
    {
        $operation = new AccessOperation([
            AccessOperation::FIELD__SECTION => 'test',
            AccessOperation::FIELD__SUBJECT => 'players',
            AccessOperation::FIELD__OPERATION => 'index',
            AccessOperation::FIELD__OBJECT => 'admin'
        ]);
        $operation->create();
        $operation->delete();
        $this->assertFalse($operation->exists());

        $this->expectExceptionMessage('Unknown operation');
        $operation->delete();
    }

    public function testExists()
    {
        $operation = new AccessOperation([
            AccessOperation::FIELD__SECTION => 'test',
            AccessOperation::FIELD__SUBJECT => 'players',
            AccessOperation::FIELD__OPERATION => 'index',
            AccessOperation::FIELD__OBJECT => 'admin'
        ]);
        $this->assertFalse($operation->exists());
        $operation->create();
        $this->assertTrue($operation->exists());
    }

    public function testAdd()
    {
        $operation = new AccessOperation([
            AccessOperation::FIELD__SECTION => 'test',
            AccessOperation::FIELD__SUBJECT => 'players',
            AccessOperation::FIELD__OPERATION => 'index',
            AccessOperation::FIELD__OBJECT => 'admin'
        ]);

        $operation->addObject('test');
        $this->assertEquals(['admin', 'test'], $operation->getObject());

        $operation->addObject(['test', 'test2']);
        $this->assertEquals(['admin', 'test', 'test2'], $operation->getObject());

        $operation->addSubject('test');
        $this->assertEquals(['players', 'test'], $operation->getSubject());

        $operation->addSubject(['test', 'test2']);
        $this->assertEquals(['players', 'test', 'test2'], $operation->getSubject());

        $operation->addOperation('test');
        $this->assertEquals(['index', 'test'], $operation->getOperation());

        $operation->addOperation(['test', 'test2']);
        $this->assertEquals(['index', 'test', 'test2'], $operation->getOperation());
    }

    public function testApplyDefaults()
    {
        $definedAccess = new class([
            AccessOperation::FIELD__OBJECT => 'admin'
        ]) extends AccessOperation {
            protected function getDefaults(): array
            {
                return [
                    AccessOperation::FIELD__OBJECT => $this->getSubjectForExtension()
                ];
            }
        };

        $this->assertEquals('extas.access.operation', $definedAccess->getObject());
    }
}
