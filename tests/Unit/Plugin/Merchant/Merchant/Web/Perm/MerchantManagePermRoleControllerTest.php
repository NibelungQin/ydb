<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Perm;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManagePermRoleControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'perm.role';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'perm.role.add';
        $this->route();
    }
}