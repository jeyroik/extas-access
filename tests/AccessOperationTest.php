<?php

use PHPUnit\Framework\TestCase;
use extas\components\access\AccessOperation;
use extas\components\SystemContainer;
use extas\interfaces\access\IAccessRepository;
use extas\components\access\AccessRepository;
use extas\components\access\Access;
use extas\interfaces\repositories\IRepository;
use extas\components\access\objects\ObjectAuthorized;
use extas\components\access\objects\ObjectPublic;
use extas\components\access\objects\ObjectRoot;
use extas\components\access\operations\OperationCreate;
use extas\components\access\operations\OperationDelete;
use extas\components\access\operations\OperationOwn;
use extas\components\access\operations\OperationRead;
use extas\components\access\operations\OperationShare;
use extas\components\access\operations\OperationUpdate;
use extas\components\access\sections\SectionApi;
use extas\components\access\sections\SectionData;
use extas\components\access\subjects\SubjectAccess;

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

        $operation->addSection('test2');
        $this->assertEquals(['test', 'test2'], $operation->getSection());

        $operation->addSection(['test', 'test3']);
        $this->assertEquals(['test', 'test2', 'test3'], $operation->getSection());

        $operation->addSubject('test');
        $this->assertEquals(['players', 'test'], $operation->getSubject());

        $operation->addSubject(['test', 'test2']);
        $this->assertEquals(['players', 'test', 'test2'], $operation->getSubject());

        $operation->addOperation('test');
        $this->assertEquals(['index', 'test'], $operation->getOperation());

        $operation->addOperation(['test', 'test2']);
        $this->assertEquals(['index', 'test', 'test2'], $operation->getOperation());

        $operation->addObject('test');
        $this->assertEquals(['admin', 'test'], $operation->getObject());

        $operation->addObject(['test', 'test2']);
        $this->assertEquals(['admin', 'test', 'test2'], $operation->getObject());
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

    public function testHelpers()
    {
        $op = new ObjectAuthorized();
        $this->assertEquals(ObjectAuthorized::NAME, $op->getObject());

        $op = new ObjectPublic();
        $this->assertEquals(ObjectPublic::NAME, $op->getObject());

        $op = new ObjectRoot();
        $this->assertEquals([ObjectAuthorized::NAME, ObjectRoot::NAME], $op->getObject());

        $op = new OperationCreate();
        $this->assertEquals(OperationCreate::NAME, $op->getOperation());

        $op = new OperationDelete();
        $this->assertEquals(OperationDelete::NAME, $op->getOperation());

        $op = new OperationOwn();
        $this->assertEquals(OperationOwn::NAME, $op->getOperation());

        $op = new OperationRead();
        $this->assertEquals(OperationRead::NAME, $op->getOperation());

        $op = new OperationShare();
        $this->assertEquals(OperationShare::NAME, $op->getOperation());

        $op = new OperationUpdate();
        $this->assertEquals(OperationUpdate::NAME, $op->getOperation());

        $op = new SectionApi();
        $this->assertEquals(SectionApi::NAME, $op->getSection());

        $op = new SectionData();
        $this->assertEquals(SectionData::NAME, $op->getSection());

        $op = new SubjectAccess();
        $this->assertEquals(SubjectAccess::NAME, $op->getSubject());
    }
}
