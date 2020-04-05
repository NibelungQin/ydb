<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Legacy\PaymentFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;

class CommonModelTest extends BaseUnitTest
{
    /**
     * 获取版权信息
     */
    public function testGetCopyright(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $redis = redis();
        $redis->flushAll();
        $result = m('common')->getCopyright(true);
        $this->assertEquals(false, $result);
    }

    public function testGetSysset(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);


        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $sysset = m('common')->getSysset();
        $this->assertIsArray($sysset);
        $this->assertEquals(var_export(SysSetFixture::SETS, true), var_export($sysset, true));
    }

    public function testUpdateSysset(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);

        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $sets['pay']['credit'] = 1;
        m('common')->updateSysset($sets);
        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $sysset = m('common')->getSysset();
        $this->assertIsArray($sysset);
        $this->assertEquals($sets['pay']['credit'], $sysset['pay']['credit']);

        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $sets['pay']['credit'] = 0;
        m('common')->updateSysset($sets);
        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $sysset = m('common')->getSysset();
        $this->assertIsArray($sysset);
        $this->assertEquals($sets['pay']['credit'], $sysset['pay']['credit']);
    }

    public function testGetPluginSet(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $shopSet = m('common')->getPluginSet();
        $this->assertIsArray($shopSet);
    }

    public function testUpdatePluginSet(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        m('common')->updatePluginSet(['commission' => ['become_goodsid' => 1]]);
        $shopSet = m('common')->getPluginSet(['commission']);
        $this->assertIsArray($shopSet);
        $this->assertEquals(1, $shopSet['commission']['become_goodsid']);
    }

    /**
     * 测试获取公众号账号
     */
    public function testGetAccount(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);


        $_GET['uniacid'] = 3;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 3;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $result = m('common')->getAccount();
        $this->assertInstanceOf(\WeiXinAccount::class, $result);
        $this->assertEquals(3, $result->uniacid);
    }

    /**
     * 生成订单微信支付信息
     */
    public function testWechatBuild(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = 3;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 3;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        $params = [
            'tid' => 'SH20191114180737536622',
            'user' => 'oMW005lDg8xacovx279GSHDCMetM',
            'fee' => 100,
            'title' => '一道电商订单'
        ];
        $options = [
            'switch' => '1',
            'version' => '2',
            'account' => '3',
            'signkey' => '',
            'appid' => 'wxca6b753bc095e372',
            'secret' => 'f5bdcd15c8dc991b47c9605024e8797d'
        ];
        // 返回的数据格式
        // {
        //      "appId":"wxca6b753bc095e372",
        //      "nonceStr":"JDUf7dUQd3quq98FqghYU87G887DW8l8",
        //      "package":"prepay_id=wx141851155388974f56b9aa291816343600",
        //      "signType":"MD5",
        //      "timeStamp":"1573728675",
        //      "paySign":"3F0457CD02B1DCC77270FCB972B663B6"
        // }
        $wechatPayInfo = m('common')->wechat_build($params, $options, 0);
        $this->assertIsArray($wechatPayInfo);
    }

    public function testGetSec(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);


        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $secret = m('common')->getSec();
        $this->assertIsArray($secret);
    }

    public function testPublicBuild(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);

        $paymentFixture = new PaymentFixture();
        $paymentFixture->load($objectManager);


        $_GET['uniacid'] = 3;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 3;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        $result = m('common')->public_build();
        $this->assertIsArray($result);
    }

    public function testGetSetData(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $setData = m('common')->getSetData();
        $this->assertIsArray($setData);
        $this->assertEquals(serialize(SysSetFixture::SETS), $setData['sets']);
        $this->assertEquals(serialize(SysSetFixture::PLUGINS), $setData['plugins']);
    }

    public function testSetGlobalSet(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        m('cache')->del('sysset', SysSetFixture::UNIACID);
        $globalSet = m('common')->setGlobalSet();
        $this->assertIsArray($globalSet);
        $this->assertEquals(var_export(
            array_merge(SysSetFixture::SETS, SysSetFixture::PLUGINS), true),
            var_export($globalSet, true));
    }
}