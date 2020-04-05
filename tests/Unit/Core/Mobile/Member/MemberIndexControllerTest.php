<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberIndexControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member';
        $this->route();
    }
}