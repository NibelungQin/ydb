<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopAdvControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.adv';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.adv.add';
        $this->route();
    }
}