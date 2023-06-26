<?php

use extas\components\access\Access;
use extas\components\access\AccessService;
use extas\components\plugins\Plugin;
use extas\components\repositories\RepoItem;
use extas\components\repositories\TSnuffRepository;
use extas\interfaces\stages\access\IStageAccessGranted;
use \PHPUnit\Framework\TestCase;
use tests\resources\PluginTestAccessGranted;

/**
 * Class AccessTest
 * @author jeyroik <jeyroik@gmail.com>
 */
class AccessTest extends TestCase
{
    use TSnuffRepository;

    protected function setUp(): void
    {
        putenv("EXTAS__CONTAINER_PATH_STORAGE_LOCK=vendor/jeyroik/extas-foundation/resources/container.dist.json");
        $this->buildBasicRepos();
        $this->buildRepo(__DIR__ . '/../../vendor/jeyroik/extas-foundation/resources/', [
            'access' => [
                "namespace" => "tests\\tmp",
                "item_class" => "extas\\components\\access\\Access",
                "pk" => "id",
                "aliases" => ["access"],
                "hooks" => [],
                "code" => [
                    'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                      .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'object\',\'section\',\'subject\',\'operation\']);'
                ]
            ]
        ]);
    }

    protected function tearDown(): void
    {
        $this->dropDatabase(__DIR__);
        $this->deleteRepo('plugins');
        $this->deleteRepo('extensions');
        $this->deleteRepo('access');
    }

    public function testBasicMethods(): void
    {
        $access = new Access([
            Access::FIELD__OBJECT => 'user',
            Access::FIELD__SECTION => 'data',
            Access::FIELD__SUBJECT => 'profile',
            Access::FIELD__OPERATION => 'view'
        ]);

        $this->assertEquals('user', $access->getObject());
        $this->assertEquals('data', $access->getSection());
        $this->assertEquals('profile', $access->getSubject());
        $this->assertEquals('view', $access->getOperation());
    }

    public function testService(): void
    {
        $access = new Access([
            Access::FIELD__OBJECT => 'user',
            Access::FIELD__SECTION => 'data',
            Access::FIELD__SUBJECT => 'profile',
            Access::FIELD__OPERATION => 'view'
        ]);

        $accessService = new AccessService();
        $accessService->plugins()->create(new Plugin([
            Plugin::FIELD__CLASS => PluginTestAccessGranted::class,
            Plugin::FIELD__STAGE => IStageAccessGranted::NAME
        ]));

        $this->assertFalse($accessService->isGranted($access));
        $this->assertFalse(PluginTestAccessGranted::$granted);
        $this->assertTrue($accessService->grant($access));
        $this->assertTrue(PluginTestAccessGranted::$granted);
        $this->assertTrue($accessService->isGranted($access));
        $this->assertTrue($accessService->forbid($access));
        $this->assertFalse($accessService->isGranted($access));
    }
}
