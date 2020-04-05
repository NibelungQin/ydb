<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CoreSettingsFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE `ims_core_settings`');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`)
                        VALUES (\'copyright\',
                                \'a:30:{s:6:\"status\";i:0;s:10:\"verifycode\";i:0;s:6:\"reason\";s:0:\"\";s:8:\"sitename\";s:0:\"\";s:3:\"url\";s:7:\"http://\";s:8:\"statcode\";s:0:\"\";s:10:\"footerleft\";s:0:\"\";s:11:\"footerright\";s:0:\"\";s:4:\"icon\";s:0:\"\";s:5:\"flogo\";s:0:\"\";s:14:\"background_img\";s:0:\"\";s:6:\"slides\";s:276:\"a:4:{i:0;s:58:\"https://img.alicdn.com/tps/TB1pfG4IFXXXXc6XXXXXXXXXXXX.jpg\";i:1;s:58:\"https://img.alicdn.com/tps/TB1sXGYIFXXXXc5XpXXXXXXXXXX.jpg\";i:2;s:58:\"https://img.alicdn.com/tps/TB1h9xxIFXXXXbKXXXXXXXXXXXX.jpg\";i:3;s:48:\"images/global/fQ716Cq66546WeueU76U5yc7c4Xz7Z.png\";}\";s:6:\"notice\";s:0:\"\";s:5:\"blogo\";s:48:\"images/global/fQ716Cq66546WeueU76U5yc7c4Xz7Z.png\";s:8:\"baidumap\";a:2:{s:3:\"lng\";s:0:\"\";s:3:\"lat\";s:0:\"\";}s:7:\"company\";s:0:\"\";s:14:\"companyprofile\";s:0:\"\";s:7:\"address\";s:0:\"\";s:6:\"person\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:2:\"qq\";s:0:\"\";s:5:\"email\";s:0:\"\";s:8:\"keywords\";s:0:\"\";s:11:\"description\";s:0:\"\";s:12:\"showhomepage\";i:0;s:13:\"leftmenufixed\";i:0;s:13:\"mobile_status\";s:1:\"0\";s:10:\"login_type\";s:1:\"0\";s:3:\"icp\";s:0:\"\";s:4:\"bind\";s:0:\"\";}\');
        ');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'authmode\', \'i:1;\');');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'close\',
                                                        \'a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:0:\"\";}\');
        ');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'register\',
                                                        \'a:4:{s:4:\"open\";i:1;s:6:\"verify\";i:0;s:4:\"code\";i:1;s:7:\"groupid\";i:1;}\');
        ');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'platform\',
                                                        \'a:5:{s:5:\"token\";s:32:\"nNDssO9P55Oh5EZZE9CQhKekhqRePC1e\";s:14:\"encodingaeskey\";s:43:\"VtfCGZgcggcYCgEO5cXGTTcMoGesU29TOEtTmVTRbgV\";s:9:\"appsecret\";s:0:\"\";s:5:\"appid\";s:0:\"\";s:9:\"authstate\";i:1;}\');
        ');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'module_receive_ban\', \'a:0:{}\');');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'thirdlogin\',
                                                        \'a:4:{s:6:\"system\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:2:\"qq\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:6:\"wechat\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:6:\"mobile\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}}\');
        ');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`)VALUES (\'basic\',
                                                       \'a:1:{s:8:\"template\";s:7:\"default\";}\');
        ');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'module_ban\', \'a:0:{}\');');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'module_upgrade\', \'a:0:{}\');');
        pdo_run('INSERT INTO `ims_core_settings`(`key`, `value`) VALUES (\'qr_status\', \'a:1:{s:6:\"status\";i:0;}\');');
    }
}