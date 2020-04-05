<?php


namespace Ydb\Test\Unit\Engine\Web\Site;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class SiteEntryControllerTest extends BaseUnitTest
{
    public function testEntry(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);
        $_GET['__test_web__'] = true;
        $_GET['__url_script__'] = 'web/index.php';
        $_GET['c'] = 'site';
        $_GET['a'] = 'entry';
        $_GET['m'] = 'ewei_shopv2';
        $_GET['do'] = 'web';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=account&a=display&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '1';
        $_COOKIE['679f___uniacid'] = '1';
        $_COOKIE['679f___switch'] = 'PjOOI';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        $cache_key = cache_system_key(CACHE_KEY_ACCOUNT_SWITCH, $_COOKIE['679f___switch']);
        cache_write($cache_key, ['account' => '1']);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

}