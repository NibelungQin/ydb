<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ModulesFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE `ims_modules`');
        pdo_run("INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (1, 'basic', 'system', '基本文字回复', '1.0', '和您进行简单对话',
                        '一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.',
                        'WEB7 Club', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 0, 0, 0, 0);
        ");
        pdo_run("INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (2, 'news', 'system', '基本混合图文回复', '1.0', '为你提供生动的图文资讯',
                        '一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.',
                        'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 0, 0, 0, 0);
        ");
        pdo_run("INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (3, 'music', 'system', '基本音乐回复', '1.0', '提供语音、音乐等音频类回复',
                        '在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。',
                        'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 0, 0, 0, 0);
        ");
        pdo_run("INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (4, 'userapi', 'system', '自定义接口回复', '1.1', '更方便的第三方接口设置',
                        '自定义接口又称第三方接口，可以让开发者更方便的接入一道宝系统，高效的与微信公众平台进行对接整合。',
                        'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 0, 0, 0, 0);
        ");
        pdo_run("INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (5, 'recharge', 'system', '会员中心充值模块', '1.0', '提供会员充值功能', '', 'We7 CC',
                        'http://www.yidaoit.cn/', 0, '', '', 0, 1, 0, 0, '', '', 1, 2, 0, 0, 0, 0);
        ");
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (6, \'custom\', \'system\', \'多客服转接\', \'1.0.0\', \'用来接入腾讯的多客服系统\', \'\',
                        \'We7 CC\', \'http://www.yidaoit.cn\', 0, \'a:0:{}\',
                        \'a:6:{i:0;s:5:\"image\";i:1;s:5:\"voice\";i:2;s:5:\"video\";i:3;s:8:\"location\";i:4;s:4:\"link\";i:5;s:4:\"text\";}\',
                        1, 1, 0, 0, \'\', \'\', 1, 2, 0, 0, 0, 0);
        ');
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (7, \'images\', \'system\', \'基本图片回复\', \'1.0\', \'提供图片回复\',
                        \'在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。\',
                        \'We7 CC\', \'http://www.yidaoit.cn/\', 0, \'\', \'\', 1, 1, 0, 0, \'\', \'\', 1, 2, 0, 0, 0,
                        0);
        ');
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (8, \'video\', \'system\', \'基本视频回复\', \'1.0\', \'提供图片回复\',
                        \'在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。\',
                        \'We7 CC\', \'http://www.yidaoit.cn/\', 0, \'\', \'\', 1, 1, 0, 0, \'\', \'\', 1, 2, 0, 0, 0,
                        0);
        ');
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (9, \'voice\', \'system\', \'基本语音回复\', \'1.0\', \'提供语音回复\',
                        \'在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。\',
                        \'We7 CC\', \'http://www.yidaoit.cn/\', 0, \'\', \'\', 1, 1, 0, 0, \'\', \'\', 1, 2, 0, 0, 0,
                        0);
        ');
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (10, \'chats\', \'system\', \'发送客服消息\', \'1.0\',
                        \'公众号可以在粉丝最后发送消息的48小时内无限制发送消息\', \'\', \'We7 CC\',
                        \'http://www.yidaoit.cn/\', 0, \'\', \'\', 0, 1, 0, 0, \'\', \'\', 1, 2, 0, 0, 0, 0);
        ');
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (11, \'wxcard\', \'system\', \'微信卡券回复\', \'1.0\', \'微信卡券回复\', \'微信卡券回复\',
                        \'We7 CC\', \'http://www.yidaoit.cn/\', 0, \'\', \'\', 1, 1, 0, 0, \'\', \'\', 1, 2, 0, 0, 0,
                        0);
        ');
        pdo_run('INSERT INTO `ims_modules`(`mid`, `name`, `type`, `title`, `version`, `ability`, `description`,
                          `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`,
                          `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`, `welcome_support`,
                          `oauth_type`, `webapp_support`, `phoneapp_support`)
                VALUES (12, \'ewei_shopv2\', \'business\', \'一道宝\', \'3.12.35\',
                        \'一道宝(分销),多用户分权，淘宝商品一键转换，多种插件支持。\',
                        \'一道宝(分销)，多项信息模板，强大的自定义规格设置\', \'一道宝科技\',
                        \'http://wesambo.taobao.com\', 0,
                        \'a:14:{i:0;s:4:\"text\";i:1;s:5:\"image\";i:2;s:5:\"voice\";i:3;s:5:\"video\";i:4;s:10:\"shortvideo\";i:5;s:8:\"location\";i:6;s:4:\"link\";i:7;s:9:\"subscribe\";i:8;s:11:\"unsubscribe\";i:9;s:2:\"qr\";i:10;s:5:\"trace\";i:11;s:5:\"click\";i:12;s:4:\"view\";i:13;s:14:\"merchant_order\";}\',
                        \'a:12:{i:0;s:4:\"text\";i:1;s:5:\"image\";i:2;s:5:\"voice\";i:3;s:5:\"video\";i:4;s:10:\"shortvideo\";i:5;s:8:\"location\";i:6;s:4:\"link\";i:7;s:9:\"subscribe\";i:8;s:2:\"qr\";i:9;s:5:\"trace\";i:10;s:5:\"click\";i:11;s:14:\"merchant_order\";}\',
                        0, 0, 0, 0, \'a:0:{}\', \'Y\', 1, 2, 0, 1, 0, 0);
        ');
    }
}