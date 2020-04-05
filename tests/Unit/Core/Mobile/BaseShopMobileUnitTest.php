<?php


namespace Ydb\Test\Unit\Core\Mobile;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Test\Unit\Core\BaseShopUnitTest;

abstract class BaseShopMobileUnitTest extends BaseShopUnitTest
{
    protected $controllerOutput;
    protected $actualOutput;

    protected function route(\Closure $setup = null): void
    {
        global $container;
        global $_W;
        global $_GPC;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);


        $this->loadFixture($objectManager, $setup);

        $_GET['__url_script__'] = 'app/index.php';
        $_GET['i'] = '3';
        $_GET['c'] = 'entry';
        $_GET['m'] = 'ewei_shopv2';
        $_GET['do'] = 'mobile';
        $_SERVER['REQUEST_METHOD'] = empty($_SERVER['REQUEST_METHOD']) ? 'GET' : $_SERVER['REQUEST_METHOD'];
        $_SERVER['HTTP_HOST'] = '192.168.200.128:28181';
        $_SERVER['HTTP_USER_AGENT'] = empty($_SERVER['HTTP_USER_AGENT']) ? 'MicroMessenger' : $_SERVER['HTTP_USER_AGENT'];
        $_SERVER['SCRIPT_NAME'] = '/app/index.php';
        $_SERVER['SCRIPT_FILENAME'] = '/opt/app-root/src/app/index.php';
        $_SESSION['openid'] = $this->members[125]['openid'];
        $_SESSION['oauth_openid'] = $this->members[125]['openid'];
        $_SESSION['userinfo'] = base64_encode(iserializer(['subscribe' => true, 'nickname' => 'madhatter']));
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        require __DIR__ . '/../../../../app/index.php';
        $this->controllerOutput = file_get_contents('/tmp/php-output.txt');
        $this->actualOutput = $this->getActualOutput();
        $this->assertNotNull($this->actualOutput);
    }
}