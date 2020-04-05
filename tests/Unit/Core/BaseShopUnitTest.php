<?php


namespace Ydb\Test\Unit\Core;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\CorePaylogFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Data\Fixtures\Legacy\CategoryFixture;
use Ydb\Data\Fixtures\Legacy\GoodsFixture;
use Ydb\Data\Fixtures\Legacy\GoodsOptionFixture;
use Ydb\Data\Fixtures\Legacy\GoodsSpecItemFixture;
use Ydb\Data\Fixtures\Legacy\MemberAddressFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Data\Fixtures\Legacy\MerchAccountFixture;
use Ydb\Data\Fixtures\Legacy\MerchUserFixture;
use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Data\Fixtures\Legacy\OrderGoodsFixture;
use Ydb\Data\Fixtures\Legacy\OrderRefundFixture;
use Ydb\Data\Fixtures\Legacy\OrderSingleRefundFixture;
use Ydb\Data\Fixtures\Legacy\PackageFixture;
use Ydb\Data\Fixtures\Legacy\PackageGoodsFixture;
use Ydb\Data\Fixtures\Legacy\PackageGoodsOptionFixture;
use Ydb\Data\Fixtures\Legacy\SalerFixture;
use Ydb\Data\Fixtures\Legacy\StoreFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Data\Fixtures\Legacy\VerifyGoodsFixture;
use Ydb\Data\Fixtures\Legacy\VerifyGoodsLogFixture;
use Ydb\Test\Unit\BaseUnitTest;

abstract class BaseShopUnitTest extends BaseUnitTest
{
    /**
     * @var array
     */
    protected $shopSets;

    /**
     * @var array
     */
    protected $pluginSets;

    /**
     * @var array
     */
    protected $secrets;

    /**
     * @var array
     */
    protected $members;

    /**
     * @var array
     */
    protected $memberAddressList;

    /**
     * @var array
     */
    protected $orders;

    protected function loadFixture(ObjectManager $objectManager, ?\Closure $setup): void
    {
        $this->shopSets = SysSetFixture::SETS;
        $this->pluginSets = SysSetFixture::PLUGINS;
        $this->secrets = SysSetFixture::SEC;

        // 会员
        $this->members = MemberFixture::MEMBER_LIST;
        $this->members[56]['id'] = 0;
        $this->members[66]['agentid'] = $this->members[56]['id'];
        $this->members[88]['agentid'] = $this->members[56]['id'];
        $this->members[90]['agentid'] = $this->members[66]['id'];
        $this->members[91]['agentid'] = $this->members[90]['id'];
        $this->members[92]['agentid'] = $this->members[90]['id'];
        $this->members[97]['agentid'] = $this->members[91]['id'];
        $this->members[125]['agentid'] = $this->members[92]['id'];

        $this->memberAddressList = MemberAddressFixture::MEMBER_ADDRESS_LIST;

        $this->orders = OrderFixture::ORDER_LIST;

        !empty($setup) && $setup();

        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);

        // 公众号
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);

        // 商城设置
        $syssetFixture = new SyssetFixture();
        $syssetFixture->setSets($this->shopSets);
        $syssetFixture->setPlugins($this->pluginSets);
        $syssetFixture->setSec($this->secrets);
        $syssetFixture->load($objectManager);

        // 商品分类
        $categoryFixture = new CategoryFixture();
        $categoryFixture->load($objectManager);

        // 商品
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsSpecFixture = new GoodsSpecItemFixture();
        $goodsSpecFixture->load($objectManager);
        $goodsSpecItemFixture = new GoodsSpecItemFixture();
        $goodsSpecItemFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        // 套餐
        $packageFixture = new PackageFixture();
        $packageFixture->load($objectManager);
        $packageGoodsFixture = new PackageGoodsFixture();
        $packageGoodsFixture->load($objectManager);
        $packageGoodsOptionFixture = new PackageGoodsOptionFixture();
        $packageGoodsOptionFixture->load($objectManager);

        // 会员
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList($this->members);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        $memberAddressFixture = new MemberAddressFixture();
        $memberAddressFixture->setMemberAddressLIst($this->memberAddressList);
        $memberAddressFixture->load($objectManager);

        // 订单
        $orderFixture = new OrderFixture();
        $orderFixture->setOrderList($this->orders);
        $orderFixture->load($objectManager);

        // ordergoods
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);

        $corePaylogFixture = new CorePaylogFixture();
        $corePaylogFixture->load($objectManager);

        $orderRefundFixture = new OrderRefundFixture();
        $orderRefundFixture->load($objectManager);

        $orderSingleRefundFixture = new OrderSingleRefundFixture();
        $orderSingleRefundFixture->load($objectManager);

        $salerFixture = new SalerFixture();
        $salerFixture->load($objectManager);
        $storeFixture = new StoreFixture();
        $storeFixture->load($objectManager);
        $verifyGoodsFixture = new VerifyGoodsFixture();
        $verifyGoodsFixture->load($objectManager);
        $verifyGoodsLogFixture = new VerifyGoodsLogFixture();
        $verifyGoodsLogFixture->load($objectManager);
    }

    public function post(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
    }
}