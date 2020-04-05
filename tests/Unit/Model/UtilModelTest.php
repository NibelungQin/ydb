<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;

class UtilModelTest extends BaseUnitTest
{
    /**
     * 获取物流信息
     */
    public function testGetExpressList(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $result = m('util')->getExpressList('shentong', '776001395668291');
        $this->assertIsArray($result);
    }

    public function testGetAreaConfigSet(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(['pay' => SysSetFixture::SETS['pay'],
            'area_config' => SysSetFixture::SETS['area_config'],
            'shop' => SysSetFixture::SETS['shop'],
            'close' => SysSetFixture::SETS['close'],
            'wap' => SysSetFixture::SETS['wap'],
            'category' => SysSetFixture::SETS['category'],
            'wxpaycert_view' => SysSetFixture::SETS['wxpaycert_view'],
            'notice_redis' => SysSetFixture::SETS['notice_redis'],
            'sale' => SysSetFixture::SETS['sale'],
            'share' => SysSetFixture::SETS['share'],
            'template' => SysSetFixture::SETS['template'],
            'trade' => SysSetFixture::SETS['trade'],
            'printer' => SysSetFixture::SETS['printer'],
            'verify' => SysSetFixture::SETS['verify'],
            'rank' => SysSetFixture::SETS['rank'],
            'notice' => SysSetFixture::SETS['notice'],
            'app' => SysSetFixture::SETS['app']]);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);

        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $result = m('util')->get_area_config_set();
        $this->assertIsArray($result);
    }
}