<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Order;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageOrderDetailControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.detail';
        $_GET['id'] = '373';
        $this->route();
    }
}