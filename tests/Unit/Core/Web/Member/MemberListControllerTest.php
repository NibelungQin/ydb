<?php


namespace Ydb\Test\Unit\Core\Web\Member;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class MemberListControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.list';
        $this->route();
    }
}