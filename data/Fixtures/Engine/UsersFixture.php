<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\Engine\Users;

class UsersFixture implements FixtureInterface
{
    public const USER_LIST = [
        [
            'uid' => 1,
            'owner_uid' => 0,
            'groupid' => 1,
            'founder_groupid' => 0,
            'username' => 'admin',
            'password' => '38c57d53263cac712ac61af2009227c247c4b159',
            'salt' => 'e00fe98d',
            'type' => 0,
            'status' => 0,
            'joindate' => 1560758443,
            'joinip' => '',
            'lastvisit' => '1578280613',
            'lastip' => '122.231.164.86',
            'remark' => '',
            'starttime' => 0,
            'endtime' => 0,
            'register_type' => 0,
            'openid' => ''
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . Users::TABLE_NAME);
        array_map(static function ($user) {
            $values = sprintf("'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s', '%s'",
                $user['uid'], $user['owner_uid'], $user['groupid'], $user['founder_groupid'], $user['username'],
                $user['password'], $user['salt'], $user['type'], $user['status'], $user['joindate'], $user['joinip'],
                $user['lastvisit'], $user['lastip'], $user['remark'], $user['starttime'], $user['endtime'],
                $user['register_type'], $user['openid']
            );
            pdo_run('INSERT INTO ' . Users::TABLE_NAME . " VALUE ($values)");
        }, self::USER_LIST);
    }
}