<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopRecommendControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.recommand';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['r'] = 'shop.recommand';
        $this->post();
        $this->route();
    }
}