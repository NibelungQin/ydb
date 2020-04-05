<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Order;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageOrderOpControllerTest extends BaseMerchantWebUnitTest
{
    public function testClose(): void
    {
        $_GET['r'] = 'order.op.close';
        $_GET['id'] = '373';
        $this->route();
    }

    public function testClosePost(): void
    {
        $_GET['r'] = 'order.op.close';
        $_POST['id'] = '373';
        $this->post();
        $this->route();
    }
}