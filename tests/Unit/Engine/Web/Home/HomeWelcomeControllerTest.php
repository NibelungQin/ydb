<?php


namespace Ydb\Test\Unit\Engine\Web\Home;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class HomeWelcomeControllerTest extends BaseUnitTest
{
    public function testWelcomeAfterSwitch(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        //$this->expectExceptionMessage('');

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);

        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';

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

    public function testPlatform(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        $this->expectExceptionMessage('');

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'platform';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testSystem(): void
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


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'system';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testExt(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        $this->expectExceptionMessage('');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'ext';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testGetFansKpi(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        $this->expectExceptionMessage('jing_num');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'get_fans_kpi';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testGetLastModules(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        $this->expectExceptionMessage('message');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'get_last_modules';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testGetSystemUpgrade(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        $this->expectExceptionMessage('message');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'get_system_upgrade';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testGetUpgradeModules(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        $this->expectExceptionMessage('message');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);


        $_GET['c'] = 'home';
        $_GET['a'] = 'welcome';
        $_GET['do'] = 'get_upgrade_modules';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=home&a=welcome&do=system&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }
}