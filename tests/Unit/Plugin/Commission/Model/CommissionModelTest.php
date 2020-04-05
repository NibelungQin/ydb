<?php


namespace Ydb\Test\Unit\Plugin\Commission\Model;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Legacy\CommissionLevelFixture;
use Ydb\Data\Fixtures\Legacy\GoodsFixture;
use Ydb\Data\Fixtures\Legacy\GoodsOptionFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Data\Fixtures\Legacy\OrderGoodsFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;

class CommissionModelTest extends BaseUnitTest
{
    public function testCalculate(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);

        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        $result = p('commission')->calculate(OrderFixture::ORDER_LIST[4]['id']);
        $this->assertIsArray($result);
    }

    public function testGetInfo(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $member3['isagent'] = '1';
        $member3['status'] = '1';
        $member4['isagent'] = '1';
        $member4['status'] = '1';
        $member5['isagent'] = '1';
        $member5['status'] = '1';
        $member6['isagent'] = '1';
        $member6['status'] = '1';
        $member7['isagent'] = '1';
        $member7['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->getInfo($member1['openid'],
            [
                'ordercount0',
                'ordercount',
                'ordercount3',
                'current_money',
                'total',
                'ok',
                'lock',
                'apply',
                'check',
                'pay',
                'wait',
                'fail'
            ]);
        $this->assertIsArray($result);
    }

    public function testGetOrderCommission(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderList = OrderFixture::ORDER_LIST;
        $orderList[4]['agentid'] = $member0['id'];
        $orderFixture->setOrderList($orderList);
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsList = OrderGoodsFixture::ORDER_GOODS_LIST;
        $orderGoodsList[5]['nocommission'] = 0;
        $orderGoodsFixture->setOrderGoodsList($orderGoodsList);
        $orderGoodsFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        $result = p('commission')->getOrderCommissions(OrderFixture::ORDER_LIST[4]['id'],
            OrderGoodsFixture::ORDER_GOODS_LIST[5]['id']);
        $this->assertIsArray($result);
    }

    public function testGetStatistics(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);
        $member0['agentid'] = 0;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderList = OrderFixture::ORDER_LIST;
        $orderList[4]['agentid'] = $member0['id'];
        $orderFixture->setOrderList($orderList);
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsList = OrderGoodsFixture::ORDER_GOODS_LIST;
        $orderGoodsList[5]['nocommission'] = 0;
        $orderGoodsFixture->setOrderGoodsList($orderGoodsList);
        $orderGoodsFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        $result = p('commission')->getStatistics([
            'level1_agentids' => [$member4['id'], $member5['id']],
            'level2_agentids' => [$member3['id']],
            'level3_agentids' => [$member1['id']]
        ]);
        $this->assertIsArray($result);
    }

    public function testGetAgents(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $member3['isagent'] = '1';
        $member3['status'] = '1';
        $member4['isagent'] = '1';
        $member4['status'] = '1';
        $member5['isagent'] = '1';
        $member5['status'] = '1';
        $member6['isagent'] = '1';
        $member6['status'] = '1';
        $member7['isagent'] = '1';
        $member7['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderList = OrderFixture::ORDER_LIST;
        $orderList[4]['openid'] = $member7['openid'];
        $orderList[4]['agentid'] = $member7['agentid'];
        $orderFixture->setOrderList($orderList);
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->getAgents($orderList[4]['id']);
        $this->assertIsArray($result);
    }

    public function testGetAgentsByMember(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $member3['isagent'] = '1';
        $member3['status'] = '1';
        $member4['isagent'] = '1';
        $member4['status'] = '1';
        $member5['isagent'] = '1';
        $member5['status'] = '1';
        $member6['isagent'] = '1';
        $member6['status'] = '1';
        $member7['isagent'] = '1';
        $member7['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderList = OrderFixture::ORDER_LIST;
        $orderList[4]['openid'] = $member7['openid'];
        $orderList[4]['agentid'] = $member7['agentid'];
        $orderFixture->setOrderList($orderList);
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->getAgentsByMember($orderList[4]['openid']);
        $this->assertIsArray($result);
    }

    public function testGetAgentsDownNum(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $member3['isagent'] = '1';
        $member3['status'] = '1';
        $member4['isagent'] = '1';
        $member4['status'] = '1';
        $member5['isagent'] = '1';
        $member5['status'] = '1';
        $member6['isagent'] = '1';
        $member6['status'] = '1';
        $member7['isagent'] = '1';
        $member7['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->getAgentsDownNum($member1['openid']);
        $this->assertIsArray($result);
    }

    public function testIsAgent(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->isAgent($member1['openid']);
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testGetCommission(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $commissionFixture = new CommissionLevelFixture();
        $commissionFixture->load($objectManager);



        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->getCommission(GoodsFixture::GOODS_LIST[0]);
        $this->assertIsNumeric($result);
    }

    public function testCreateMyShopQrcode(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);



        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->createMyShopQrcode(1, 1);
        $this->assertIsString($result);
    }

    public function testCreateGoodsImage(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $commissionFixture = new CommissionLevelFixture();
        $commissionFixture->load($objectManager);



        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->createGoodsImage(GoodsFixture::GOODS_LIST[0]);
        $this->assertIsString($result);
    }

    public function testCreateShopImage(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets(SysSetFixture::SETS);
        $pluginSets = SysSetFixture::PLUGINS;
        $pluginSets['commission']['level'] = 3;
        $syssetFixture->setPlugins($pluginSets);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        // 会员
        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = MemberFixture::MEMBER_LIST;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];
        $member1['isagent'] = '1';   // 成为分销商
        $member1['status'] = '1';
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $commissionFixture = new CommissionLevelFixture();
        $commissionFixture->load($objectManager);

        exec(sprintf('rm -rf %s', escapeshellarg(__DIR__ . '/../../../../../addons/ewei_shopv2/data')));


        $_GET['__url_script__'] = 'app/index.php';
        $_GET['uniacid'] = SysSetFixture::UNIACID;
        require __DIR__ . '/../../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = SysSetFixture::UNIACID;
        $_W['container'] = 'test';
        $_W['openid'] = $member1['openid'];
        $_GPC['mid'] = $member1['id'];
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../../addons/ewei_shopv2/core/inc/functions.php';

        m('cache')->set('sysset');
        $result = p('commission')->createShopImage(GoodsFixture::GOODS_LIST[0]);
        $this->assertIsString($result);
    }
}