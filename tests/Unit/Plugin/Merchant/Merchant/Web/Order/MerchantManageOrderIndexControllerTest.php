<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Order;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageOrderIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order';
        $this->route();
    }

    public function testAjaxOrder(): void
    {
        $_GET['r'] = 'order.ajaxorder';
        $_GET['day'] = '30';
        $this->route();
    }

    public function testAjaxTransaction(): void
    {
        $_GET['r'] = 'order.ajaxtransaction';
        $this->route();
    }
}