<?php


namespace Ydb\Test\Unit\Com;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;

class SaleComTest extends BaseUnitTest
{
    /**
     * 测试营销模块的自动回复功能
     */
    public function testSaleVirtual(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SysSetFixture();
        $syssetFixture->setSets([
            'pay' => SysSetFixture::SETS['pay'],
            'area_config' => SysSetFixture::SETS['area_config'],
            'shop' => SysSetFixture::SETS['shop'],
            'close' => SysSetFixture::SETS['close'],
            'wap' => SysSetFixture::SETS['wap'],
            'category' => SysSetFixture::SETS['category'],
            'wxpaycert_view' => SysSetFixture::SETS['wxpaycert_view'],
            'notice_redis' => SysSetFixture::SETS['notice_redis'],
            'sale' => SysSetFixture::SETS['sale'],
            'share' => SysSetFixture::SETS['share'],
            'template' => SysSetFixture::SETS['template'],
            'trade' => SysSetFixture::SETS['trade'],
            'printer' => SysSetFixture::SETS['printer'],
            'verify' => SysSetFixture::SETS['verify'],
            'rank' => SysSetFixture::SETS['rank'],
            'notice' => SysSetFixture::SETS['notice'],
            'app' => SysSetFixture::SETS['app']
        ]);
        $syssetFixture->load($objectManager);
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
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
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/receiver.php';

        $receiver = new \Receiver();
        $receiver->message = array(
            'tousername' => 'gh_5a2c328b8246',
            'fromusername' => 'oMW005r75BsJIO7Zojrtk_5kOF_0',
            'createtime' => '1578393852',
            'msgtype' => 'event',
            'event' => 'subscribe',
            'eventkey' => '',
            'from' => 'oMW005r75BsJIO7Zojrtk_5kOF_0',
            'to' => 'gh_5a2c328b8246',
            'time' => '1578393852',
            'type' => 'subscribe',
        );
        $receiver->params = array(
            'rule' => -2,
            'module' => '',
            'message' =>
                array(
                    'tousername' => 'gh_5a2c328b8246',
                    'fromusername' => 'oMW005r75BsJIO7Zojrtk_5kOF_0',
                    'createtime' => '1578393852',
                    'msgtype' => 'event',
                    'event' => 'subscribe',
                    'eventkey' => '',
                    'from' => 'oMW005r75BsJIO7Zojrtk_5kOF_0',
                    'to' => 'gh_5a2c328b8246',
                    'time' => '1578393852',
                    'type' => 'text',
                    'redirection' => true,
                    'source' => 'subscribe',
                ),
        );
        $receiver->response = false;
        $receiver->keyword = null;
        $receiver->module = array (
            'mid' => '12',
            'name' => 'ewei_shopv2',
            'type' => 'business',
            'title' => '一道宝',
            'version' => '3.12.35',
            'ability' => '一道宝(分销),多用户分权，淘宝商品一键转换，多种插件支持。',
            'description' => '一道宝(分销)，多项信息模板，强大的自定义规格设置',
            'author' => '一道宝科技',
            'url' => 'http://wesambo.taobao.com',
            'settings' => '0',
            'subscribes' =>
                array (
                    0 => 'text',
                    1 => 'image',
                    2 => 'voice',
                    3 => 'video',
                    4 => 'shortvideo',
                    5 => 'location',
                    6 => 'link',
                    7 => 'subscribe',
                    8 => 'unsubscribe',
                    9 => 'qr',
                    10 => 'trace',
                    11 => 'click',
                    12 => 'view',
                    13 => 'merchant_order',
                ),
            'handles' =>
                array (
                    0 => 'text',
                    1 => 'image',
                    2 => 'voice',
                    3 => 'video',
                    4 => 'shortvideo',
                    5 => 'location',
                    6 => 'link',
                    7 => 'subscribe',
                    8 => 'qr',
                    9 => 'trace',
                    10 => 'click',
                    11 => 'merchant_order',
                ),
            'isrulefields' => '0',
            'issystem' => '0',
            'target' => '0',
            'iscard' => '0',
            'permissions' => 'a:0:{}',
            'title_initial' => 'Y',
            'wxapp_support' => '1',
            'app_support' => '2',
            'welcome_support' => '0',
            'oauth_type' => '1',
            'webapp_support' => '0',
            'phoneapp_support' => '0',
            'id' => NULL,
            'modulename' => NULL,
            'isdisplay' => 1,
            'logo' => 'http://yidaodianshang.yidaoit.net/addons/ewei_shopv2/icon-custom.jpg?v=1578383613',
            'main_module' => false,
            'plugin_list' =>
                array (
                ),
            'is_relation' => false,
            'config' =>
                array (
                ),
            'enabled' => 1,
            'shortcut' => NULL,
        );
        $receiver->uniacid = $_W['uniacid'];

        $receiver->saleVirtual();
        $this->assertNotNull($receiver);
    }
}