<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\ModulesPluginFixture;
use Ydb\Data\Fixtures\Engine\ModulesRecycleFixture;
use Ydb\Data\Fixtures\Engine\UniAccountModulesFixture;
use Ydb\Test\Unit\BaseUnitTest;

class WeUtilityTest extends BaseUnitTest
{
    /**
     * 创建应用
     */
    public function testCreateModuleSite(): void
    {
        // Ewei_shopv2ModuleSite
        $site = \WeUtility::createModuleSite('ewei_shopv2');
        $this->assertNotNull($site);
    }

    /**
     * 创建模块的消息处理器 ModuleReceiver
     */
    public function testCreateModuleReceiver(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);
        $modulesPluginFixture = new ModulesPluginFixture();
        $modulesPluginFixture->load($objectManager);
        $modulesRecycleFixture = new ModulesRecycleFixture();
        $modulesRecycleFixture->load($objectManager);
        $uniAccountModulesFixture = new UniAccountModulesFixture();
        $uniAccountModulesFixture->load($objectManager);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);


        $moduleReceiver = \WeUtility::createModuleReceiver('ewei_shopv2');
        $this->assertNotNull($moduleReceiver);
        $this->assertIsObject($moduleReceiver);
        $this->assertInstanceOf(\Ewei_shopv2ModuleReceiver::class, $moduleReceiver);
    }
}