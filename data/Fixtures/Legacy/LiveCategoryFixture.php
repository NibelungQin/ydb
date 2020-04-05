<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\LiveCategory;

class LiveCategoryFixture implements FixtureInterface
{
    public const LIVE_CATEGORY_LIST = [
        0 =>
            [
                'id' => '1',
                'uniacid' => '3',
                'name' => '测试直播分类',
                'thumb' => 'images/3/2019/11/IQjd70bc81zC37Ivd08D85j6R8c3d9.jpg',
                'displayorder' => '0',
                'enabled' => '1',
                'advimg' => '',
                'advurl' => '',
                'isrecommand' => '1',
            ],
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . LiveCategory::TABLE_NAME);
        array_map(static function ($liveCategory) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $liveCategory['id'], $liveCategory['uniacid'], $liveCategory['name'], $liveCategory['thumb'],
                $liveCategory['displayorder'], $liveCategory['enabled'], $liveCategory['advimg'],
                $liveCategory['advurl'], $liveCategory['isrecommand']
            );
            pdo_run('INSERT INTO ' . LiveCategory::TABLE_NAME . " VALUE ($values)");
        }, self::LIVE_CATEGORY_LIST);
    }
}