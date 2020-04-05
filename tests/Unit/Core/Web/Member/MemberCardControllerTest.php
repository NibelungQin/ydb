<?php


namespace Ydb\Test\Unit\Core\Web\Member;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class MemberCardControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.card';
        $this->route();
    }
}