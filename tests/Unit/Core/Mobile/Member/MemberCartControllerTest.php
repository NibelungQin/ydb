<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Legacy\GoodsFixture;
use Ydb\Data\Fixtures\Legacy\GoodsOptionFixture;
use Ydb\Data\Fixtures\Legacy\MemberCartFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Data\Fixtures\Legacy\OrderGoodsFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberCartControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.cart';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'member.cart.get_list';
        $_GET['mid'] = '125';
        $this->route();
    }
}