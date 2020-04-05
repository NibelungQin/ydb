<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Goods;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageGoodsVirtualCategoryControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.virtual.category';
        $this->route();
    }
}