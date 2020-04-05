<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopCubeControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.cube';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['r'] = 'shop.cube';
        $this->post();
        $this->route();
    }
}