<?php


namespace Ydb\Test\Unit\Model;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Legacy\GoodsFixture;
use Ydb\Data\Fixtures\Legacy\GoodsOptionFixture;
use Ydb\Data\Fixtures\Legacy\OrderGoodsFixture;
use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Entity\Manual\GoodsOption;
use Ydb\Test\Unit\BaseUnitTest;

class OrderModelTest extends BaseUnitTest
{
    public function testCheckPeerPay(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        $result = m('order')->checkPeerPay(OrderFixture::ORDER_LIST[359]['id']);
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testCheckOrderGoods(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $result = m('order')->checkOrderGoods(OrderFixture::ORDER_LIST[346]['id']);
        $this->assertIsArray($result);
    }

    public function testCheckGoodsStock(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $result = m('order')->checkoodsStock(OrderFixture::ORDER_LIST[346]['id'], 1);
        $this->assertIsBool($result);
    }

    public function  testSetStocksAndCredits(): void
    {
        global $container;
        global $_W;
        global $_GPC;


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $expectedGoodsStock = OrderGoodsFixture::ORDER_GOODS_LIST[362]['total'] + GoodsOptionFixture::GOODS_OPTION_LIST[96]['stock'];
        m('order')->SetStocksAndCredits(OrderFixture::ORDER_LIST[346]['id'], 2);
        $result = pdo_fetch('SELECT * FROM ' . GoodsOption::TABLE_NAME . ' WHERE id = ' . GoodsOptionFixture::GOODS_OPTION_LIST[96]['id']);
        $this->assertEquals($expectedGoodsStock, $result['stock']);
    }
}