<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopCommentControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.comment';
        $this->route();
    }
}