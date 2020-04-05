<?php


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

class ModuleModelTest extends BaseUnitTest
{
    public function testModuleFetch(): void
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

        $expected = array (
            'mid' => '12',
            'name' => 'ewei_shopv2',
            'type' => 'business',
            'title' => '一道宝',
            'version' => '3.12.35',
            'ability' => '一道宝(分销),多用户分权，淘宝商品一键转换，多种插件支持。',
            'description' => '一道宝(分销)，多项信息模板，强大的自定义规格设置',
            'author' => '一道宝科技',
            'url' => 'http://wesambo.taobao.com',
            'settings' => '0',
            'subscribes' =>
                array (
                    0 => 'text',
                    1 => 'image',
                    2 => 'voice',
                    3 => 'video',
                    4 => 'shortvideo',
                    5 => 'location',
                    6 => 'link',
                    7 => 'subscribe',
                    8 => 'unsubscribe',
                    9 => 'qr',
                    10 => 'trace',
                    11 => 'click',
                    12 => 'view',
                    13 => 'merchant_order',
                ),
            'handles' =>
                array (
                    0 => 'text',
                    1 => 'image',
                    2 => 'voice',
                    3 => 'video',
                    4 => 'shortvideo',
                    5 => 'location',
                    6 => 'link',
                    7 => 'subscribe',
                    8 => 'qr',
                    9 => 'trace',
                    10 => 'click',
                    11 => 'merchant_order',
                ),
            'isrulefields' => '0',
            'issystem' => '0',
            'target' => '0',
            'iscard' => '0',
            'permissions' => 'a:0:{}',
            'title_initial' => 'Y',
            'wxapp_support' => '1',
            'app_support' => '2',
            'welcome_support' => '0',
            'oauth_type' => '1',
            'webapp_support' => '0',
            'phoneapp_support' => '0',
            'id' => NULL,
            'modulename' => NULL,
            'isdisplay' => 1,
            'logo' => 'http://yidaodianshang.yidaoit.net/addons/ewei_shopv2/icon-custom.jpg?v=1577511331',
            'main_module' => false,
            'plugin_list' =>
                array (
                ),
            'is_relation' => false,
            'config' =>
                array (
                ),
            'enabled' => 1,
            'shortcut' => NULL,
        );
        $module = module_fetch('ewei_shopv2');
        $this->assertIsArray($module);
        unset($expected['logo'], $module['logo']);
        $this->assertEquals(var_export($expected, true), var_export($module, true));
    }
}