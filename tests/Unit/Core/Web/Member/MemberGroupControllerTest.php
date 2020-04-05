<?php


namespace Ydb\Test\Unit\Core\Web\Member;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class MemberGroupControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.group';
        $this->route();
    }
}