<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Advertisement;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageAdvertisementIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'advertisement';
        $this->route();
    }

    public function testSelectedAdv(): void
    {
        $_GET['r'] = 'advertisement.selected_adv';
        $this->route();
    }

    public function testBindAdvGoodsOrder(): void
    {
        $_GET['r'] = 'advertisement.bind_adv_goods_order';
        $this->route();
    }
}