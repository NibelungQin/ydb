<?php


namespace Ydb\Test\Unit\Core\Web\Member;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class MemberIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member';
        $this->route();
    }

    public function testQuery(): void
    {
        $_GET['r'] = 'member.query';
        $_GET['keyword'] = 'madhatter';
        $this->route();
    }
}