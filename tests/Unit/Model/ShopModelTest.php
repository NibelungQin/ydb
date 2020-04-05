<?php


namespace Ydb\Test\Unit\Model;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Legacy\CategoryFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;

class ShopModelTest extends BaseUnitTest
{
    public function testCheckClose(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $_S;


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        $_S['close'] = SysSetFixture::SETS['close'];
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $result = m('shop')->checkClose();
        $this->assertEquals(NULL, $result);
    }

    public function testGetCategory(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $_S;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $categoryFixture = new CategoryFixture();
        $categoryFixture->load($objectManager);


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $result = m('shop')->getCategory();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);
        $this->assertCount(6, $result['parent']);
        $this->assertCount(6, $result['children']);
    }
}