<?php


namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class UserModelTest extends BaseUnitTest
{
    public function testUserSingle(): void
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
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);
        $expected = array (
            'uid' => '1',
            'owner_uid' => '0',
            'groupid' => '1',
            'founder_groupid' => '0',
            'username' => 'admin',
            'password' => 'd9e115761ca612f9936718a97295856cf0383563',
            'salt' => 'e00fe98d',
            'type' => '0',
            'status' => '0',
            'joindate' => '1560758443',
            'joinip' => '',
            'lastvisit' => '1578280613',
            'lastip' => '122.231.164.86',
            'remark' => '',
            'starttime' => '0',
            'endtime' => '0',
            'register_type' => '0',
            'openid' => '',
            'name' => 'admin',
            'clerk_id' => '1',
            'store_id' => 0,
            'clerk_type' => '2',
            'qq_openid' => NULL,
            'wechat_openid' => NULL,
            'mobile' => NULL,
        );
        load()->model('user');
        $user = user_single(ConstantFixture::ADMIN_UID);

        $this->assertIsArray($user);
        $this->assertCount(count($expected), $user);
    }
}