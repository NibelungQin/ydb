<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Perm;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManagePermIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'perm';
        $this->route();
    }
}