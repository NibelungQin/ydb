<?php


namespace Ydb\Test\Unit\Engine\Web\Account;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class AccountDisplayControllerTest extends BaseUnitTest
{
    public function testDisplay(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;
        global $state;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);

        $_GET['c'] = 'account';
        $_GET['a'] = 'display';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=account&a=display&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testSwitch(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;
        global $state;

        $this->expectExceptionMessage('');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);

        $_GET['c'] = 'account';
        $_GET['a'] = 'display';
        $_GET['do'] = 'switch';
        $_GET['uniacid'] = '1';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=account&a=display&';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }
}