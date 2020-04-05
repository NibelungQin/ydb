<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberHistoryControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.history';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'member.history.get_list';
        $_GET['mid'] = '125';
        $_GET['page'] = '1';
        $this->route();
    }
}