<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsLevel;

class SnsLevelFixture implements FixtureInterface
{
    public const LEVEL_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => '3',
                'levelname' => '行业专家',
                'credit' => '0',
                'enabled' => '1',
                'post' => '0',
                'color' => '#6d9eeb',
                'bg' => '#6aa84f',
            ],
        2 =>
            [
                'id' => 2,
                'uniacid' => '3',
                'levelname' => '健康达人',
                'credit' => '200',
                'enabled' => '1',
                'post' => '0',
                'color' => '#333',
                'bg' => '#999',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsLevel::TABLE_NAME);
        array_map(static function($level) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s'",
                $level['id'], $level['uniacid'], $level['levelname'], $level['credit'],
                $level['enabled'], $level['post'], $level['color'], $level['bg']
            );
            pdo_run('INSERT INTO ' . SnsLevel::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::LEVEL_LIST));
    }
}