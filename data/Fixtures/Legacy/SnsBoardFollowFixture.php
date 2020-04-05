<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsBoardFollow;

class SnsBoardFollowFixture implements FixtureInterface
{
    public const BOARD_FOLLOW_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => 3,
                'bid' => '1',
                'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
                'createtime' => '1585219871',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsBoardFollow::TABLE_NAME);
        array_map(static function($complainCate) {
            $values = sprintf("'%s','%s','%s','%s','%s'",
                $complainCate['id'], $complainCate['uniacid'], $complainCate['name'],
                $complainCate['status'], $complainCate['displayorder']
            );
            pdo_run('INSERT INTO ' . SnsBoardFollow::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::BOARD_FOLLOW_LIST));
    }
}