<?php


namespace Ydb\Test\Unit\Core\Web\Member;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class MemberLevelControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.level';
        $this->route();
    }
}