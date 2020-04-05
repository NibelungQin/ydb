<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberFullbackControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.fullback';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'member.fullback.get_list';
        $_GET['page'] = '1';
        $_GET['type'] = '0';
        $this->route();
    }
}