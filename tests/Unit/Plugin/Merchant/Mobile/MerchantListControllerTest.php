<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class MerchantListControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'merch.list';
        $this->route();
    }

    public function testMerchUser(): void
    {
        $_GET['r'] = 'merch.list.merchuser';
        $this->route();
    }
}