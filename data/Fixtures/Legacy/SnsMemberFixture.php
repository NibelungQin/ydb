<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsMember;

class SnsMemberFixture implements FixtureInterface
{
    public const MEMBER_LIST = [
        3 =>
            [
                'id' => 3,
                'uniacid' => 3,
                'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
                'level' => '0',
                'createtime' => '1585050378',
                'credit' => '0',
                'sign' => '',
                'isblack' => '0',
                'notupgrade' => '0',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsMember::TABLE_NAME);
        array_map(static function($member) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $member['id'], $member['uniacid'], $member['openid'], $member['level'], $member['createtime'],
                $member['credit'], $member['sign'], $member['isblack'], $member['notupgrade']
            );
            pdo_run('INSERT INTO ' . SnsMember::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::MEMBER_LIST));
    }
}