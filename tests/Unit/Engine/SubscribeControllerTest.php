<?php


namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\ModulesPluginFixture;
use Ydb\Data\Fixtures\Engine\ModulesRecycleFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Engine\UniAccountModulesFixture;
use Ydb\Test\Unit\BaseUnitTest;

class SubscribeControllerTest extends BaseUnitTest
{
    /**
     * 接收到关注事件
     * https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Receiving_event_pushes.html
     */
    public function testReceiveSubscribeEvent(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $controller;
        global $action;
        global $do;

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
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        $_GPC = array (
            'c' => 'utility',
            'a' => 'subscribe',
            'do' => 'receive',
            'i' => '3',
            'modulename' => 'ewei_shopv2',
            'request' => '{&quot;rule&quot;:-2,&quot;module&quot;:&quot;&quot;,&quot;message&quot;:{&quot;tousername&quot;:&quot;gh_5a2c328b8246&quot;,&quot;fromusername&quot;:&quot;oMW005r75BsJIO7Zojrtk_5kOF_0&quot;,&quot;createtime&quot;:&quot;1578408704&quot;,&quot;msgtype&quot;:&quot;event&quot;,&quot;event&quot;:&quot;subscribe&quot;,&quot;eventkey&quot;:&quot;&quot;,&quot;from&quot;:&quot;oMW005r75BsJIO7Zojrtk_5kOF_0&quot;,&quot;to&quot;:&quot;gh_5a2c328b8246&quot;,&quot;time&quot;:&quot;1578408704&quot;,&quot;type&quot;:&quot;text&quot;,&quot;redirection&quot;:true,&quot;source&quot;:&quot;subscribe&quot;}}',
            'response' => 'false',
            'message' => '{&quot;tousername&quot;:&quot;gh_5a2c328b8246&quot;,&quot;fromusername&quot;:&quot;oMW005r75BsJIO7Zojrtk_5kOF_0&quot;,&quot;createtime&quot;:&quot;1578408704&quot;,&quot;msgtype&quot;:&quot;event&quot;,&quot;event&quot;:&quot;subscribe&quot;,&quot;eventkey&quot;:&quot;&quot;,&quot;from&quot;:&quot;oMW005r75BsJIO7Zojrtk_5kOF_0&quot;,&quot;to&quot;:&quot;gh_5a2c328b8246&quot;,&quot;time&quot;:&quot;1578408704&quot;,&quot;type&quot;:&quot;subscribe&quot;}',
        );
        $controller = $_GPC['c'];
        $action = $_GPC['a'];
        $do = $_GPC['do'];
        require __DIR__ . '/../../../web/source/utility/subscribe.ctrl.php';
        set_time_limit(0);  // subscribe.ctrl.php 将事件设置为 30 秒，导致覆盖率执行超时，需要重置
        $this->assertEquals(1, 1);
    }
}