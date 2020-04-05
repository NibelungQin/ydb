<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Goods;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageGoodsCategoryControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.category';
        $this->route();
    }
}