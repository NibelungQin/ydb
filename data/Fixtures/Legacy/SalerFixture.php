<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Saler;

class SalerFixture implements FixtureInterface
{
    public const SALER_LIST = array (
        7 =>
            array (
                'id' => '7',
                'storeid' => '3',
                'uniacid' => '3',
                'openid' => 'oMW005r75BsJIO7Zojrtk_5kOF_0',
                'status' => '1',
                'salername' => 'liner',
                'username' => '',
                'pwd' => '',
                'salt' => '',
                'lastvisit' => '',
                'lastip' => '',
                'isfounder' => '0',
                'mobile' => '15201010001',
                'getmessage' => '0',
                'getnotice' => '0',
                'roleid' => '0',
            ),
    );

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . Saler::TABLE_NAME);
        array_map(static function($saler) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s'",
                $saler['id'], $saler['storeid'], $saler['uniacid'], $saler['openid'], $saler['status'],
                $saler['salername'], $saler['username'], $saler['pwd'], $saler['salt'], $saler['lastvisit'],
                $saler['lastip'], $saler['isfounder'], $saler['mobile'], $saler['getmessage'],
                $saler['getnotice'], $saler['roleid']
            );
            pdo_run('INSERT INTO ' . Saler::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::SALER_LIST));
    }
}