<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberRankControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.rank';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testAjaxPage(): void
    {
        $_GET['r'] = 'member.rank.ajaxpage';
        $_GET['mid'] = '125';
        $_GET['page'] = '1';
        $this->route();
    }

    public function testOrderRank(): void
    {
        $_GET['r'] = 'member.rank.order_rank';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testAjaxOrderPage(): void
    {
        $_GET['r'] = 'member.rank.ajaxorderpage';
        $_GET['mid'] = '125';
        $_GET['page'] = '1';
        $this->route();
    }
}