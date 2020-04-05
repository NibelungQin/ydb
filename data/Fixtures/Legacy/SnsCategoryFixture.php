<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsCategory;

class SnsCategoryFixture implements FixtureInterface
{
    public const CATEGORY_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => 3,
                'name' => '健康养生',
                'thumb' => 'images/3/2020/03/UOP040O4EgzYyyhop9p69OR96SsPHG.jpg',
                'displayorder' => '0',
                'enabled' => '1',
                'advimg' => '',
                'advurl' => '',
                'isrecommand' => '1',
            ],
        2 =>
            [
                'id' => 2,
                'uniacid' => 3,
                'name' => '科学育儿',
                'thumb' => 'images/3/2020/03/J61x4CjJ5Xq44996Y1p58cCeJ3F1Y3.jpg',
                'displayorder' => '0',
                'enabled' => '1',
                'advimg' => '',
                'advurl' => '',
                'isrecommand' => '1',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsCategory::TABLE_NAME);
        array_map(static function($category) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $category['id'], $category['uniacid'], $category['name'], $category['thumb'],
                $category['displayorder'], $category['enabled'], $category['advimg'],
                $category['advurl'], $category['isrecommand']
            );
            pdo_run('INSERT INTO ' . SnsCategory::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::CATEGORY_LIST));
    }
}