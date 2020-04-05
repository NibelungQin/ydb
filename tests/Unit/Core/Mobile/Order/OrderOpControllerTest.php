<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderOpControllerTest extends BaseShopMobileUnitTest
{
    public function testCancelOrder(): void
    {
        $_GET['r'] = 'order.op.cancel';
        $_POST['id'] = '346';
        $this->post();
        $this->route();
    }

    public function testFinishOrder(): void
    {
        $_GET['r'] = 'order.op.finish';
        $_POST['id'] = OrderFixture::ORDER_LIST[359]['id'];
        $this->post();
        $this->route();
    }

    public function testDeleteOrder(): void
    {
        $_GET['r'] = 'order.op.delete';
        $_POST['id'] = OrderFixture::ORDER_LIST[356]['id'];
        $this->post();
        $this->route();
    }
}