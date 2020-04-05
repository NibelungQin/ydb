<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsAdv;

class SnsAdvFixture implements FixtureInterface
{
    public const ADV_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => 3,
                'advname' => '健康饮食',
                'link' => '',
                'thumb' => 'images/3/2020/03/dVM5xfGfiOXGF81SZIOuom81ZOoUgs.jpg',
                'displayorder' => '2222222',
                'enabled' => '1',
            ],
        2 =>
            [
                'id' => 2,
                'uniacid' => 3,
                'advname' => '爱生活爱健康',
                'link' => '',
                'thumb' => 'images/3/2020/03/eOdq47WssSqz1kXHtDSJ7WzSI4HL3Q.jpg',
                'displayorder' => '2147483647',
                'enabled' => '1',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsAdv::TABLE_NAME);
        array_map(static function($adv) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s'",
                $adv['id'], $adv['uniacid'], $adv['advname'], $adv['link'], $adv['thumb'],
                $adv['displayorder'], $adv['enabled']
            );
            pdo_run('INSERT INTO ' . SnsAdv::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::ADV_LIST));
    }
}