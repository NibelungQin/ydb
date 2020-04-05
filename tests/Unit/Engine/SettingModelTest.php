<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Test\Unit\BaseUnitTest;

class SettingModelTest extends BaseUnitTest
{
    public function testSettingLoad(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $coreSettingsFixture = new CoreSettingsFixture();
        $coreSettingsFixture->load($objectManager);
        $coreCacheFixture = new CoreCacheFixture();
        $coreCacheFixture->load($objectManager);

        $expected = array (
            'copyright' =>
                array (
                    'status' => 0,
                    'verifycode' => 0,
                    'reason' => '',
                    'sitename' => '',
                    'url' => 'http://',
                    'statcode' => '',
                    'footerleft' => '',
                    'footerright' => '',
                    'icon' => '',
                    'flogo' => '',
                    'background_img' => '',
                    'slides' => 'a:4:{i:0;s:58:"https://img.alicdn.com/tps/TB1pfG4IFXXXXc6XXXXXXXXXXXX.jpg";i:1;s:58:"https://img.alicdn.com/tps/TB1sXGYIFXXXXc5XpXXXXXXXXXX.jpg";i:2;s:58:"https://img.alicdn.com/tps/TB1h9xxIFXXXXbKXXXXXXXXXXXX.jpg";i:3;s:48:"images/global/fQ716Cq66546WeueU76U5yc7c4Xz7Z.png";}',
                    'notice' => '',
                    'blogo' => 'images/global/fQ716Cq66546WeueU76U5yc7c4Xz7Z.png',
                    'baidumap' =>
                        array (
                            'lng' => '',
                            'lat' => '',
                        ),
                    'company' => '',
                    'companyprofile' => '',
                    'address' => '',
                    'person' => '',
                    'phone' => '',
                    'qq' => '',
                    'email' => '',
                    'keywords' => '',
                    'description' => '',
                    'showhomepage' => 0,
                    'leftmenufixed' => 0,
                    'mobile_status' => '0',
                    'login_type' => '0',
                    'icp' => '',
                    'bind' => '',
                ),
            'authmode' => 1,
            'close' =>
                array (
                    'status' => '0',
                    'reason' => '',
                ),
            'register' =>
                array (
                    'open' => 1,
                    'verify' => 0,
                    'code' => 1,
                    'groupid' => 1,
                ),
            'platform' =>
                array (
                    'token' => 'nNDssO9P55Oh5EZZE9CQhKekhqRePC1e',
                    'encodingaeskey' => 'VtfCGZgcggcYCgEO5cXGTTcMoGesU29TOEtTmVTRbgV',
                    'appsecret' => '',
                    'appid' => '',
                    'authstate' => 1,
                ),
            'module_receive_ban' =>
                array (
                ),
            'thirdlogin' =>
                array (
                    'system' =>
                        array (
                            'appid' => '',
                            'appsecret' => '',
                            'authstate' => '',
                        ),
                    'qq' =>
                        array (
                            'appid' => '',
                            'appsecret' => '',
                            'authstate' => '',
                        ),
                    'wechat' =>
                        array (
                            'appid' => '',
                            'appsecret' => '',
                            'authstate' => '',
                        ),
                    'mobile' =>
                        array (
                            'appid' => '',
                            'appsecret' => '',
                            'authstate' => '',
                        ),
                ),
            'basic' =>
                array (
                    'template' => 'default',
                ),
            'module_ban' =>
                array (
                ),
            'module_upgrade' =>
                array (
                ),
            'qr_status' =>
                array (
                    'status' => 0,
                ),
        );
        $setting = setting_load();
        $this->assertIsArray($setting);
        $this->assertEquals(var_export($expected, true), var_export($setting, true));
    }
}