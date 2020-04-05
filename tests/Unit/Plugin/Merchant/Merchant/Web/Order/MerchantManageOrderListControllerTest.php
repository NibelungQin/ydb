<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Order;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageOrderListControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.list';
        $this->route();
    }

    public function testStatus4(): void
    {
        $_GET['r'] = 'order.list.status4';
        $this->route();
    }
}