<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\LiveAdv;

class LiveAdvFixture implements FixtureInterface
{
    public const LIVE_ADV_LIST = [
        0 =>
            [
                'id' => '1',
                'uniacid' => '3',
                'merchid' => '0',
                'advname' => '测试幻灯片',
                'link' => 'http://yidaodianshang.yidaoit.net//app/index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=goods&ishot=1',
                'thumb' => 'images/3/2019/12/qbzDvaBd1vxa1Ja88sCj1akbdV4j4v.jpg',
                'displayorder' => '0',
                'enabled' => '1',
            ],
    ];

    public function load(ObjectManager $manager):void
    {
        pdo_run('TRUNCATE TABLE ' . LiveAdv::TABLE_NAME);
        array_map(static function ($liveAdv) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s'",
                $liveAdv['id'], $liveAdv['uniacid'], $liveAdv['merchid'], $liveAdv['advname'], $liveAdv['link'],
                $liveAdv['thumb'], $liveAdv['displayorder'], $liveAdv['enabled']
            );
            pdo_run('INSERT INTO ' . LiveAdv::TABLE_NAME . " VALUE ($values)");
        }, self::LIVE_ADV_LIST);
    }
}