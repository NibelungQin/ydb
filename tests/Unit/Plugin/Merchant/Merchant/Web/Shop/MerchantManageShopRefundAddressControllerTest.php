<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopRefundAddressControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.refundaddress';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.refundaddress.add';
        $this->route();
    }
}