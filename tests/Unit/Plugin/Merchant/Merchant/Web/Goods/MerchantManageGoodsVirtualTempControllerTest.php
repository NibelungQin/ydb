<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Goods;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageGoodsVirtualTempControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.virtual.temp';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'goods.virtual.temp.add';
        $this->route();
    }
}