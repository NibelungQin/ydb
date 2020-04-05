<?php


namespace Ydb\Test\Unit\Core\Mobile\Member;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Legacy\MemberAddressFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class MemberAddressControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'member.address';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['r'] = 'member.address.post';
        $_GET['id'] = '44';
        $_GET['mid'] = '125';
        $this->route(function () {
            $this->memberAddressList[0]['datavalue'] = '';
        });
    }

    public function testSubmit(): void
    {
        $_GET['r'] = 'member.address.submit';
        $_GET['mid'] = '125';
        $_POST['id'] = '44';
        $_POST['addressdata'] = [
            'realname' => '杨',
            'mobile' => '15201010001',
            'areas' => '浙江省 杭州市 上城区',
            'street' => '清波街道',
            'streetdatavalue' => '330102001',
            'datavalue' => '330000 330100 330102',
            'isdefault' => '0'
        ];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route(function () {
            $this->memberAddressList[0]['datavalue'] = '';
        });
    }

    public function testSetDefault(): void
    {
        $_GET['r'] = 'member.address.setdefault';
        $_GET['mid'] = '125';
        $_POST['id'] = '44';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'member.address.delete';
        $_GET['mid'] = '125';
        $_POST['id'] = '44';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route();
    }

    public function testSelector(): void
    {
        $_GET['r'] = 'member.address.selector';
        $_GET['mid'] = '125';
        $this->route();
    }

    public function  testGetSelector(): void
    {
        $_GET['r'] = 'member.address.getselector';
        $_GET['mid'] = '125';
        $_POST['keywords'] = '杭州';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route();
    }
}