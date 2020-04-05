<?php


namespace Ydb\Test\Unit\Core\Web\Shop;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class ShopRefundaddressControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.refundaddress';
        $this->route();
    }
}