<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Goods;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageGoodsVirtualDataControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.virtual.data';
        $_GET['typeid'] = '1';
        $this->route();
    }
}