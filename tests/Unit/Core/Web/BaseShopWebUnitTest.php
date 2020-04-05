<?php


namespace Ydb\Test\Unit\Core\Web;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Test\Unit\Core\BaseShopUnitTest;

abstract class BaseShopWebUnitTest extends BaseShopUnitTest
{
    protected $controllerOutput;
    protected $actualOutput;

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

        $_GET['__test_web__'] = true;
        $_GET['__url_script__'] = 'web/index.php';
        $_GET['c'] = 'site';
        $_GET['a'] = 'entry';
        $_GET['m'] = 'ewei_shopv2';
        $_GET['do'] = 'web';
        $_SERVER['REQUEST_METHOD'] = empty($_SERVER['REQUEST_METHOD']) ? 'GET' : $_SERVER['REQUEST_METHOD'];
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=account&a=display&';
        $_SERVER['SCRIPT_NAME'] = '/web/index.php';
        $_SERVER['SCRIPT_FILENAME'] = '/opt/app-root/src/web/index.php';
        $_COOKIE['679f___session'] = '655ek7RrR3fNH5Zq8gcWxb/u5StUhGm5ThMLYRcNgX7Ty+B8ovhblw4+iqlPhhtikL7X9Yk+w1j9tsLvr/BIKBPvYNjiMxL2KJDJZgv2MbYh2Tb581IVskYzINDIm3ZzwefHAVzYYfU4HqMKONb6ZYeFCOe5K7XcaOJnglPA31nL1CS90Q';
        $_COOKIE['679f___uid'] = '1';
        $_COOKIE['679f___uniacid'] = '3';
        $_COOKIE['679f___switch'] = 'PjOOI';
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        $cache_key = cache_system_key(CACHE_KEY_ACCOUNT_SWITCH, $_COOKIE['679f___switch']);
        cache_write($cache_key, ['account' => '1']);
        require __DIR__ . '/../../../../web/index.php';
        $this->controllerOutput = file_get_contents('/tmp/php-output.txt');
        $this->actualOutput = $this->getActualOutput();
        $this->assertNotNull($this->actualOutput);
    }
}