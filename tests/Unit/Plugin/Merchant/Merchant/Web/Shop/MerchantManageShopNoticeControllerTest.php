<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopNoticeControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.notice';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.notice.add';
        $this->route();
    }
}