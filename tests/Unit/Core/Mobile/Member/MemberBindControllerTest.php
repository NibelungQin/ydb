<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberBindControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.bind';
        $this->route();
    }
}