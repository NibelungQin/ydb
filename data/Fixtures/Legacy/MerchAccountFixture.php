<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\MerchAccount;

class MerchAccountFixture implements FixtureInterface
{
    public const MERCH_ACCOUNT_LIST = [
        2 =>
            [
                'id' => '2',
                'uniacid' => '3',
                'openid' => '',
                'merchid' => '2',
                'username' => 'test1',
                'pwd' => 'e694f12495b50ac340cde82e05b0125b',
                'salt' => 'CJ6nZBZm',
                'status' => '1',
                'perms' => 'a:0:{}',
                'isfounder' => '1',
                'lastip' => '115.150.10.237',
                'lastvisit' => '1582480134',
                'roleid' => '0',
            ]
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . MerchAccount::TABLE_NAME);
        array_map(static function ($merchAccount) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $merchAccount['id'], $merchAccount['uniacid'], $merchAccount['openid'], $merchAccount['merchid'],
                $merchAccount['username'], $merchAccount['pwd'], $merchAccount['salt'], $merchAccount['status'],
                $merchAccount['perms'], $merchAccount['isfounder'], $merchAccount['lastip'],
                $merchAccount['lastvisit'], $merchAccount['roleid']
            );
            pdo_run('INSERT INTO ' . MerchAccount::TABLE_NAME . " VALUE ($values)");
        }, self::MERCH_ACCOUNT_LIST);
    }
}