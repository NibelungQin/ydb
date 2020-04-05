<?php


namespace Ydb\Test\Unit\Core\Web\Member;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class MemberRankControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.rank';
        $this->route();
    }
}