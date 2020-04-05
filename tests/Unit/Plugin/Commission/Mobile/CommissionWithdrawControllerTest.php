<?php


namespace Ydb\Test\Unit\Plugin\Commission\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class CommissionWithdrawControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.withdraw';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }
}