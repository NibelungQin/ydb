<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopVerifySalerControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.verify.saler';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.verify.saler.add';
        $this->route();
    }
}