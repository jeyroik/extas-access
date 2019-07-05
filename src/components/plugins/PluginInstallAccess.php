<?php
namespace extas\components\plugins\access;

use extas\components\access\AccessOperation;
use extas\components\plugins\TInstallMessages;
use extas\interfaces\packages\IInstaller;
use extas\components\plugins\Plugin;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PluginInstallAccess
 *
 * @package extas\components\plugins\access
 * @author jeyroik@gmail.com
 */
class PluginInstallAccess extends Plugin
{
    use TInstallMessages;

    const FIELD__ACCESS = 'access';

    /**
     * @param $installer IInstaller
     * @param $output OutputInterface
     *
     * @throws
     */
    public function __invoke($installer, $output)
    {
        $config = $installer->getPackageConfig();
        $accessOperations = $config[static::FIELD__ACCESS] ?? [];

        foreach ($accessOperations as $accessOperation) {
            $operation = new AccessOperation($accessOperation);
            if (!$operation->exists()) {
                $operation->create();
                $accessString = $operation->getObject() . '.'
                    . $operation->getSection() . '.'
                    . $operation->getSubject() . '.'
                    . $operation->getOperation();

                $this->installed($accessString, 'access', $output);
            }
        }
    }
}