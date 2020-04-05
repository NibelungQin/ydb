<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsManage;

class SnsManageFixture implements FixtureInterface
{
    public const MANAGE_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => 3,
                'bid' => '1',
                'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
                'enabled' => '0',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsManage::TABLE_NAME);
        array_map(static function($manage) {
            $values = sprintf("'%s','%s','%s','%s','%s'",
                $manage['id'], $manage['uniacid'], $manage['bid'], $manage['openid'], $manage['enabled']
            );
            pdo_run('INSERT INTO ' . SnsManage::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::MANAGE_LIST));
    }
}