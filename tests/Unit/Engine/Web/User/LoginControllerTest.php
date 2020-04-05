<?php


namespace Ydb\Test\Unit\Engine\Web\User;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;

class LoginControllerTest extends BaseUnitTest
{
    public function testRedirectLoginPage(): void
    {
        global $container;

        $this->expectExceptionMessage('');
        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../../web/index.php';
    }

    public function testLoginPage(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['c'] = 'user';
        $_GET['a'] = 'login';
        require __DIR__ . '/../../../../../web/index.php';

        $result = $this->getActualOutput();
        $this->assertNotNull($result);
    }

    public function testLoginRequest(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $this->expectExceptionMessage('redirect');

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $usersFixture = new UsersFixture();
        $usersFixture->load($objectManager);

        $_GET['__test_web__'] = true;
        $_GET['__url_script__'] = 'web/index.php';
        $_GET['c'] = 'user';
        $_GET['a'] = 'login';
        $_POST['username'] = 'admin';
        $_POST['password'] = 'admin';
        $_POST['submit'] = '登录';
        $_POST['token'] = '0c0bc8c6';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_REFERER'] = 'http://192.168.200.128:28181/web/index.php?c=user&a=login&';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        require __DIR__ . '/../../../../../web/index.php';
        $this->assertNotNull($this->getActualOutput());
    }
}