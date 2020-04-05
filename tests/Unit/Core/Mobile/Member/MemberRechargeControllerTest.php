<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberRechargeControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.recharge';
        $_GET['mid'] = '125';
        $this->route();
    }
}