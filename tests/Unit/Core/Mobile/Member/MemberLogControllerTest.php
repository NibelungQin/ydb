<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberLogControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.log';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'member.log.get_list';
        $_GET['mid'] = '125';
        $_GET['page'] = '1';
        $_GET['type'] = '0';
        $this->route();
    }
}