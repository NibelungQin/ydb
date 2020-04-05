<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Order;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageOrderOpRefundControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.op.refund';
        $_GET['id'] = '374';
        $this->route();
    }
}