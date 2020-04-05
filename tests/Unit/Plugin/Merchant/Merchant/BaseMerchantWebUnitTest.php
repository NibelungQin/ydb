<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Test\Unit\Core\BaseShopUnitTest;
use Ydb\Test\Unit\Plugin\TraitPluginUnitTest;

abstract class BaseMerchantWebUnitTest extends BaseShopUnitTest
{
    use TraitPluginUnitTest;

    protected function route(\Closure $setup = null): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        $this->loadFixture($objectManager, $setup);
        $this->loadPluginFixture($setup);

        $_GET['__test_web__'] = true;
        $_GET['__url_script__'] = 'web/merchant.php';
        $_GET['c'] = 'site';
        $_GET['a'] = 'entry';
        $_GET['m'] = 'ewei_shopv2';
        $_GET['do'] = 'web';
        $_SERVER['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['SCRIPT_NAME'] = '/web/merchant.php';
        $_SERVER['SCRIPT_FILENAME'] = '/opt/app-root/src/web/merchant.php';
        $_SESSION['__merch_uniacid'] = '3';
        $_COOKIE['679f___uniacid'] = '3';
        $_COOKIE['679f___merch_3_session'] = 'eyJpZCI6IjIiLCJ1bmlhY2lkIjoiMyIsIm9wZW5pZCI6IiIsIm1lcmNoaWQiOiIyIiwidXNlcm5hbWUiOiJ0ZXN0MSIsInB3ZCI6ImU2OTRmMTI0OTViNTBhYzM0MGNkZTgyZTA1YjAxMjViIiwic2FsdCI6IkNKNm5aQlptIiwic3RhdHVzIjoiMSIsInBlcm1zIjoiYTowOnt9IiwiaXNmb3VuZGVyIjoiMSIsImxhc3RpcCI6IjExNS4xNTAuMTAuMjM3IiwibGFzdHZpc2l0IjoiMTU4MjQ4MDEzNCIsInJvbGVpZCI6IjAiLCJoYXNoIjoiMDZkZDYxYjY2OWEwMDY5NzJhZWZkZDJmZjEyMDM0YjcifQ==';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/merchant.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }
}