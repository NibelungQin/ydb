<?php


namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\McGroupsFixture;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class McModelTest extends BaseUnitTest
{
    public function testMCGroups(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $mcGroupsFixture = new McGroupsFixture();
        $mcGroupsFixture->load($objectManager);

        $expected = [
            3 => [
                'groupid' => '3',
                'uniacid' => '3',
                'title' => '默认会员组',
                'credit' => '0',
                'isdefault' => '1',
            ]
        ];

        load()->model('mc');
        $mcGroup = mc_groups(ConstantFixture::UNIACID);

        $this->assertIsArray($mcGroup);
        $this->assertCount(count($expected), $mcGroup);
    }

    public function testMcOauthUserInfo(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $expected = ['subscribe' => true, 'nickname' => 'madhatter'];

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        $_SESSION['userinfo'] = base64_encode(iserializer($expected));

        load()->model('mc');

        $userInfo = mc_oauth_userinfo(ConstantFixture::ACID);

        $this->assertIsArray($userInfo);
        $this->assertEquals(var_export($expected, true), var_export($userInfo, true));
    }

    public function testMcOpenid2uid(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        load()->model('mc');

        $expected = McMappingFansFixture::MC_MAPPING_FANS[0]['uid'];
        $result = mc_openid2uid(McMappingFansFixture::MC_MAPPING_FANS[0]['openid']);
        $this->assertEquals($expected, $result);

        $expected = array_map(static function ($mcMappingFans) {
            return (int)$mcMappingFans['uid'];
        }, array_values(McMappingFansFixture::MC_MAPPING_FANS));
        $openidList = array_map(static function ($mcMappingFans) {
            return $mcMappingFans['openid'];
        }, array_values(McMappingFansFixture::MC_MAPPING_FANS));
        $result = mc_openid2uid($openidList);
        $this->assertEquals(var_export($expected, true), var_export($result, true));
    }

    public function testMcCurrentRealUniacid(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        load()->model('mc');
        $result = mc_current_real_uniacid();
        $this->assertEquals(ConstantFixture::UNIACID, $result);

        $_W['account'] = array(
            'uniacid' => '1',
        );
        $result = mc_current_real_uniacid();
        $this->assertEquals($_W['account']['uniacid'], $result);
    }

    public function testMcCreditUpdate(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);

        load()->model('mc');
        $result = mc_credit_update(McMembersFixture::MC_MEMBER_LIST[0]['id'], 'credit1', 100);
        $this->assertTrue($result);
    }
}