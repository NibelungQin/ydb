<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Perm;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManagePermUserControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'perm.user';
        $this->route();
    }
}