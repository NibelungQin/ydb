<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Sale;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageSaleIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale';
        $this->route();
    }
}