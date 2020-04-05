<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberFavoriteControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.favorite';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'member.favorite.get_list';
        $_GET['mid'] = '125';
        $_GET['page'] = '1';
        $this->route();
    }
}