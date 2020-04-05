<?php


namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\McGroupsFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Engine\UniSettingsFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class AccountModelTest extends BaseUnitTest
{

    public function testAccountOwner(): void
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
        $expected = array(
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
            'qq_openid' => null,
            'wechat_openid' => null,
            'mobile' => null,
        );
        $accountOwner = account_owner(ConstantFixture::UNIACID);

        $this->assertIsArray($accountOwner);
        $this->assertCount(count($expected), $accountOwner);
    }

    public function testUniSettingLoad(): void
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
        $uniSettingsFixture = new UniSettingsFixture();
        $uniSettingsFixture->load($objectManager);

        $expected = [
            'uniacid' => '3',
            'passport' => '',
            'oauth' =>
                [
                    'host' => '',
                    'account' => '3',
                ],
            'jsauth_acid' => '0',
            'uc' => '',
            'notify' => '',
            'creditnames' =>
                [
                    'credit1' =>
                        [
                            'title' => '积分',
                            'enabled' => 1,
                        ],
                    'credit2' =>
                        [
                            'title' => '余额',
                            'enabled' => 1,
                        ],
                ],
            'creditbehaviors' =>
                [
                    'activity' => 'credit1',
                    'currency' => 'credit2',
                ],
            'welcome' => '',
            'default' => '',
            'default_message' => '',
            'payment' =>
                [
                    0 => 'A',
                    'credit' =>
                        [
                            'switch' => false,
                        ],
                    'mix' =>
                        [
                            'switch' => true,
                        ],
                    'wechat' =>
                        [
                            'switch' => '1',
                            'version' => '2',
                            'account' => '3',
                            'signkey' => '',
                        ],
                ],
            'stat' => '',
            'default_site' => '3',
            'sync' => '1',
            'recharge' => '',
            'tplnotice' => '',
            'grouplevel' => '0',
            'mcplugin' => '',
            'exchange_enable' => '0',
            'coupon_type' => '0',
            'menuset' => '',
            'statistics' => '',
            'bind_domain' => '',
        ];
        $account = uni_setting_load();
        $this->assertIsArray($account);
        $this->assertCount(count($expected), $account);
    }

    public function testUniSetting(): void
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
        $uniSettingsFixture = new UniSettingsFixture();
        $uniSettingsFixture->load($objectManager);
        $expected = [
            'uniacid' => '3',
            'passport' => '',
            'oauth' =>
                [
                    'host' => '',
                    'account' => '3',
                ],
            'jsauth_acid' => '0',
            'uc' => '',
            'notify' => '',
            'creditnames' =>
                [
                    'credit1' =>
                        [
                            'title' => '积分',
                            'enabled' => 1,
                        ],
                    'credit2' =>
                        [
                            'title' => '余额',
                            'enabled' => 1,
                        ],
                ],
            'creditbehaviors' =>
                [
                    'activity' => 'credit1',
                    'currency' => 'credit2',
                ],
            'welcome' => '',
            'default' => '',
            'default_message' => '',
            'payment' =>
                [
                    0 => 'A',
                    'credit' =>
                        [
                            'switch' => false,
                        ],
                    'mix' =>
                        [
                            'switch' => true,
                        ],
                    'wechat' =>
                        [
                            'switch' => '1',
                            'version' => '2',
                            'account' => '3',
                            'signkey' => '',
                        ],
                ],
            'stat' => '',
            'default_site' => '3',
            'sync' => '1',
            'recharge' => '',
            'tplnotice' => '',
            'grouplevel' => '0',
            'mcplugin' => '',
            'exchange_enable' => '0',
            'coupon_type' => '0',
            'menuset' => '',
            'statistics' => '',
            'bind_domain' => '',
        ];
        $uniSetting = uni_setting(ConstantFixture::UNIACID);
        $this->assertIsArray($uniSetting);
        $this->assertCount(count($expected), $uniSetting);
    }

    public function testUniSetmeal(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        $expected = [
            'uid' => -1,
            'username' => '创始人',
            'timelimit' => '未设置',
            'groupid' => '-1',
            'groupname' => '所有服务',
        ];
        $uniSetmeal = uni_setmeal(ConstantFixture::UNIACID);
        $this->assertIsArray($uniSetmeal);
        $this->assertCount(count($expected), $uniSetmeal);
    }

    public function testUniFetch(): void
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
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);
        $uniSettingsFixture = new UniSettingsFixture();
        $uniSettingsFixture->load($objectManager);
        $mcGroupsFixture = new McGroupsFixture();
        $mcGroupsFixture->load($objectManager);

        $expected = array(
            'acid' => '3',
            'uniacid' => '3',
            'token' => 'jZyombMrYu88GlUx8a8yRmYpO1eX8bA2',
            'encodingaeskey' => 'mrrnc79719c1315F9xKnp9Cg951iMPXXM7p9lnpKN1N',
            'level' => '4',
            'name' => '一道电商服务',
            'account' => '731539803@qq.com',
            'original' => 'gh_5a2c328b8246',
            'signature' => '',
            'country' => '',
            'province' => '',
            'city' => '',
            'username' => '',
            'password' => '',
            'lastupdate' => '0',
            'key' => 'wxca6b753bc095e372',
            'secret' => 'f5bdcd15c8dc991b47c9605024e8797d',
            'styleid' => '0',
            'subscribeurl' => '',
            'auth_refresh_token' => '',
            'encrypt_key' => 'wxca6b753bc095e372',
            'type' => '1',
            'isconnect' => '1',
            'isdeleted' => '0',
            'endtime' => '0',
            'uid' => '1',
            'starttime' => '0',
            'groups' =>
                array(
                    3 =>
                        array(
                            'groupid' => '3',
                            'uniacid' => '3',
                            'title' => '默认会员组',
                            'credit' => '0',
                            'isdefault' => '1',
                        ),
                ),
            'setting' =>
                array(
                    'uniacid' => '3',
                    'passport' => '',
                    'oauth' =>
                        array(
                            'host' => '',
                            'account' => '3',
                        ),
                    'jsauth_acid' => '0',
                    'uc' => '',
                    'notify' => '',
                    'creditnames' =>
                        array(
                            'credit1' =>
                                array(
                                    'title' => '积分',
                                    'enabled' => 1,
                                ),
                            'credit2' =>
                                array(
                                    'title' => '余额',
                                    'enabled' => 1,
                                ),
                        ),
                    'creditbehaviors' =>
                        array(
                            'activity' => 'credit1',
                            'currency' => 'credit2',
                        ),
                    'welcome' => '',
                    'default' => '',
                    'default_message' => '',
                    'payment' =>
                        array(
                            0 => 'A',
                            'credit' =>
                                array(
                                    'switch' => false,
                                ),
                            'mix' =>
                                array(
                                    'switch' => true,
                                ),
                            'wechat' =>
                                array(
                                    'switch' => '1',
                                    'version' => '2',
                                    'account' => '3',
                                    'signkey' => '',
                                ),
                        ),
                    'stat' => '',
                    'default_site' => '3',
                    'sync' => '1',
                    'recharge' => '',
                    'tplnotice' => '',
                    'grouplevel' => '0',
                    'mcplugin' => '',
                    'exchange_enable' => '0',
                    'coupon_type' => '0',
                    'menuset' => '',
                    'statistics' => '',
                    'bind_domain' => '',
                ),
            'grouplevel' => '0',
            'logo' => 'http://yidaodianshang.yidaoit.net/attachment/headimg_3.jpg?time=1577084488',
            'qrcode' => 'http://yidaodianshang.yidaoit.net/attachment/qrcode_3.jpg?time=1577084488',
            'switchurl' => './index.php?c=account&a=display&do=switch&uniacid=3',
            'sms' => 0,
            'setmeal' =>
                array(
                    'uid' => -1,
                    'username' => '创始人',
                    'timelimit' => '未设置',
                    'groupid' => '-1',
                    'groupname' => '所有服务',
                ),
        );

        $account = uni_fetch();
        $this->assertIsArray($account);
        // 带有时间戳，无法测试，需要排除
        unset($expected['logo'], $expected['qrcode'], $account['logo'], $account['qrcode']);
        $this->assertEquals(var_export($expected, true), var_export($account, true));
    }
}