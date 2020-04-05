<?php


namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Test\Unit\BaseUnitTest;

class WeAccountTest extends BaseUnitTest
{
    public function testCreate(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        load()->classs('weixin.account');

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

        $expected = \WeiXinAccount::__set_state(array(
            'tablename' => 'account_wechats',
            'apis' =>
                array(),
            'types' =>
                array(
                    0 => 'view',
                    1 => 'click',
                    2 => 'scancode_push',
                    3 => 'scancode_waitmsg',
                    4 => 'pic_sysphoto',
                    5 => 'pic_photo_or_album',
                    6 => 'pic_weixin',
                    7 => 'location_select',
                    8 => 'media_id',
                    9 => 'view_limited',
                ),
            'account' =>
                array(
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
                ),
            'uniacid' => '3',
            'menuFrame' => 'account',
            'type' => 1,
            'typeName' => '公众号',
            'typeTempalte' => null,
            'uniaccount' =>
                array(
                    'acid' => '3',
                    'uniacid' => '3',
                    'hash' => 'nqE3UzII',
                    'type' => '1',
                    'isconnect' => '1',
                    'isdeleted' => '0',
                    'endtime' => '0',
                    'groupid' => '0',
                    'name' => '一道电商服务',
                    'description' => '',
                    'default_acid' => '3',
                    'rank' => null,
                    'title_initial' => 'Y',
                ),
        ));

        $weiXinAccount = \WeiXinAccount::create(ConstantFixture::ACID);
        $this->assertNotNull($weiXinAccount);
        $this->assertEquals(var_export($expected, true), var_export($weiXinAccount, true));
    }

    public function testCreateFromGlobalVariable(): void
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

        $_W['account'] = array(
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
                    '3' =>
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
                            '0' => 'A',
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

        load()->classs('account');

        $account = \WeAccount::create();
        $this->assertNotNull($account);
    }

    public function testIncludes(): void
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
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);

        load()->classs('account');
        load()->classs('weixin.account');

        $expected = \WeiXinAccount::__set_state(array(
            'tablename' => 'account_wechats',
            'apis' =>
                array(),
            'types' =>
                array(
                    0 => 'view',
                    1 => 'click',
                    2 => 'scancode_push',
                    3 => 'scancode_waitmsg',
                    4 => 'pic_sysphoto',
                    5 => 'pic_photo_or_album',
                    6 => 'pic_weixin',
                    7 => 'location_select',
                    8 => 'media_id',
                    9 => 'view_limited',
                ),
            'account' =>
                array(
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
                ),
            'uniacid' => '3',
            'menuFrame' => 'account',
            'type' => 1,
            'typeName' => '公众号',
            'typeTempalte' => null,
            'uniaccount' =>
                array(
                    'acid' => '3',
                    'uniacid' => '3',
                    'hash' => 'nqE3UzII',
                    'type' => '1',
                    'isconnect' => '1',
                    'isdeleted' => '0',
                    'endtime' => '0',
                    'groupid' => '0',
                    'name' => '一道电商服务',
                    'description' => '',
                    'default_acid' => '3',
                    'rank' => null,
                    'title_initial' => 'Y',
                ),
        ));

        $uniAccount = [
            'acid' => '3',
            'uniacid' => '3',
            'hash' => 'nqE3UzII',
            'type' => '1',
            'isconnect' => '1',
            'isdeleted' => '0',
            'endtime' => '0',
            'groupid' => '0',
            'name' => '一道电商服务',
            'description' => '',
            'default_acid' => '3',
            'rank' => null,
            'title_initial' => 'Y',
        ];
        $account = \WeAccount::includes($uniAccount);
        $this->assertNotNull($account);
        $this->assertIsObject($account);
        $this->assertEquals(var_export($expected, true), var_export($account, true));
    }
}