<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Engine\UniSettings;

class UniSettingsFixture implements FixtureInterface
{
    public const UNI_SETTINGS_LIST = [
        3 =>
            [
                'uniacid' => 3,
                'passport' => '',
                'oauth' => 'a:2:{s:4:\"host\";s:0:\"\";s:7:\"account\";s:1:\"3\";}',
                'jsauth_acid' => 0,
                'uc' => '',
                'notify' => '',
                'creditnames' => 'a:2:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}}',
                'creditbehaviors' => 'a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}',
                'welcome' => '',
                'default' => '',
                'default_message' => '',
                'payment' => 'a:4:{i:0;s:1:\"A\";s:6:\"credit\";a:1:{s:6:\"switch\";b:0;}s:3:\"mix\";a:1:{s:6:\"switch\";b:1;}s:6:\"wechat\";a:4:{s:6:\"switch\";s:1:\"1\";s:7:\"version\";s:1:\"2\";s:7:\"account\";s:1:\"3\";s:7:\"signkey\";s:0:\"\";}}',
                'stat' => '',
                'default_site' => 3,
                'sync' => 1,
                'recharge' => '',
                'tplnotice' => '',
                'grouplevel' => 0,
                'mcplugin' => '',
                'exchange_enable' => 0,
                'coupon_type' => 0,
                'menuset' => '',
                'statistics' => '',
                'bind_domain' => ''
            ]

    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . UniSettings::TABLE_NAME);
        array_map(static function ($uniSettings) {
            $values = sprintf("'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'",
                $uniSettings['uniacid'], $uniSettings['passport'], $uniSettings['oauth'], $uniSettings['jsauth_acid'],
                $uniSettings['uc'], $uniSettings['notify'], $uniSettings['creditnames'],
                $uniSettings['creditbehaviors'], $uniSettings['welcome'], $uniSettings['default'],
                $uniSettings['default_message'], $uniSettings['payment'], $uniSettings['stat'],
                $uniSettings['default_site'], $uniSettings['sync'], $uniSettings['recharge'],
                $uniSettings['tplnotice'], $uniSettings['grouplevel'], $uniSettings['mcplugin'],
                $uniSettings['exchange_enable'], $uniSettings['coupon_type'], $uniSettings['menuset'],
                $uniSettings['statistics'], $uniSettings['bind_domain']
            );
            pdo_run('INSERT INTO ' . UniSettings::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::UNI_SETTINGS_LIST));
    }
}