<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\Engine\McGroups;

class McGroupsFixture implements FixtureInterface
{
    public const MC_GROUP_LIST = [
        [
            'groupid' => 3,
            'uniacid' => 3,
            'title' => '默认会员组',
            'credit' => 0,
            'isdefault' => 1
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . McGroups::TABLE_NAME);
        array_map(static function ($mcGroup) {
            $values = sprintf("'%s', '%s', '%s', '%s', '%s'",
                $mcGroup['groupid'], $mcGroup['uniacid'], $mcGroup['title'], $mcGroup['credit'], $mcGroup['isdefault']
            );
            pdo_run('INSERT INTO ' . McGroups::TABLE_NAME . " VALUE ($values)");
        }, self::MC_GROUP_LIST);
    }
}