<?php


namespace Ydb\Test\Unit\MessageProcessor;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\AccountFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\UniAccountFixture;
use Ydb\Data\Fixtures\Engine\UniAccountModulesFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Util\MockPhpStream;

class WeEngineTest extends BaseUnitTest
{
    /**
     * 微信公众号服务器配置的token验证流程
     * https://developers.weixin.qq.com/doc/offiaccount/Getting_Started/Getting_Started_Guide.html
     */
    public function testTokenValidation(): void
    {
        global $container;
        global $_W;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountModulesFixture = new UniAccountModulesFixture();
        $uniAccountModulesFixture->load($objectManager);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);
        $coreSettingFixture = new CoreSettingsFixture();
        $coreSettingFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        $_GET = [
            'id' => '3',
            'signature' => 'e0803ce0c7c9eb717ba17fcb484587cf64bdebf3',
            'echostr' => '6186046028540082925',
            'timestamp' => '1578645605',
            'nonce' => '4344459',
        ];
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GPC['id'] = $_GET['id'];

        include __DIR__ . '/../../../api.php';

        $output = $this->getActualOutput();
        $this->assertNotNull($output);
    }

    public function testMessageProcess(): void
    {
        global $container;
        global $_W;

        $_GET['timestamp'] = '1576079038';
        $_GET['nonce'] = 'DFnWW';
        $_GET['signature'] = 'b3751592f9ece6ac93469feb75ba41d0360dd157';
        $_GPC['id'] = 3;
        $_SERVER['REQUEST_METHOD'] = 'post';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountModulesFixture = new UniAccountModulesFixture();
        $uniAccountModulesFixture->load($objectManager);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);
        $coreSettingFixture = new CoreSettingsFixture();
        $coreSettingFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        stream_wrapper_unregister('php');
        stream_wrapper_register('php', MockPhpStream::class);
        file_put_contents('php://input',
            '<xml>
                <ToUserName><![CDATA[toUser]]></ToUserName>
                <FromUserName><![CDATA[fromUser]]></FromUserName>
                <CreateTime>1576075153</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[测试内容]]></Content>
                <MsgId>1234567890123456</MsgId>
            </xml>
        ');

        include __DIR__ . '/../../../api.php';

        stream_wrapper_restore('php');

        $output = $this->getActualOutput();
        $this->assertNotNull($output);
    }

    public function testEncryptMessageProcess(): void
    {
        global $container;
        global $_W;

        $_GET['id'] = '3';
        $_GET['openid'] = 'oMW005lDg8xacovx279GSHDCMetM';
        $_GET['timestamp'] = '1577086368';
        $_GET['nonce'] = '1141949550';
        $_GET['signature'] = 'f1bf94cf1ffd818b887c15a465364fa2c517bd22';
        $_GET['msg_signature'] = 'f5dc93bda88f9de6a2dd609d4ff12130880867ce';
        $_GET['encrypt_type'] = 'aes';
        $_GPC['id'] = 3;
        $_SERVER['REQUEST_METHOD'] = 'post';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $accountFixture = new AccountFixture();
        $accountFixture->load($objectManager);
        $uniAccountFixture = new UniAccountFixture();
        $uniAccountFixture->load($objectManager);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);
        $uniAccountModulesFixture = new UniAccountModulesFixture();
        $uniAccountModulesFixture->load($objectManager);
        $modulesFixture = new ModulesFixture();
        $modulesFixture->load($objectManager);
        $coreSettingFixture = new CoreSettingsFixture();
        $coreSettingFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);
        $coreSettingFixture = new CoreSettingsFixture();
        $coreSettingFixture->load($objectManager);

        stream_wrapper_unregister('php');
        stream_wrapper_register('php', MockPhpStream::class);
        file_put_contents('php://input',
            '<xml>
                <ToUserName><![CDATA[gh_5a2c328b8246]]></ToUserName>
                <FromUserName><![CDATA[oMW005lDg8xacovx279GSHDCMetM]]></FromUserName>
                <CreateTime>1577086368</CreateTime>
                <MsgType><![CDATA[event]]></MsgType>
                <Event><![CDATA[subscribe]]></Event>
                <EventKey><![CDATA[]]></EventKey>
                <Encrypt><![CDATA[rIqfkmHYjexNUDdK/MKQA1nd5sM2NHHnDaCLqz/zWlzF6m2LQDpkXvOWh392wkk1Jbb4QxCSQA+YSaNgFcFHo67AWywdmuCkKBzYLeH0su3AbV2nDKslmA20gmeApCrtCsS0MH3vJjOaDdnu0RsalDRXodg7jUQh4xDOM8PVM9DDbi3/MTnyxm1tBqbCiTNyCjfI0xmNvi4HuZXsvxeyEryf6p0mKJ77vfUe76BAcphZgBWTjZ3aM+5pVBjEEie0u8Ab/oQ2tyBKBl8+A0ydaIIz6JqFKc86UmNt08qH0cllPVPCeWVX/lXR/Xrx2cPH2Tpfdh3uO9wuvCCv3oTbYb9WRTnhkI3E6SlZDu779xjxrI2La1vgd+/OCAt0FikxTKQq7FKY9BmX95BB/RkDWC2sXjSkIFhbDY2nB0XMgB0=]]></Encrypt>
            </xml>
        ');

        include __DIR__ . '/../../../api.php';

        stream_wrapper_restore('php');

        $output = $this->getActualOutput();
        $this->assertNotNull($output);
    }
}